<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Contracts\Repositories\CourseRepositoryInterface;
use App\Contracts\Repositories\ProgressRepositoryInterface;
use App\Services\CourseService;
use App\Services\UploadService;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    protected $courseRepository;
    protected $courseService;
    protected $uploadService;
    protected $progressRepository;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        CourseService $courseService,
        UploadService $uploadService,
        ProgressRepositoryInterface $progressRepository
    ) {
        $this->courseRepository = $courseRepository;
        $this->courseService = $courseService;
        $this->uploadService = $uploadService;
        $this->progressRepository = $progressRepository;
    }

    public function index(Request $request)
    {
        $categorySlug = $request->query('category');
        $courses = $this->courseRepository->getAllApproved($categorySlug);
        $categories = \App\Models\Category::all();
        
        return view('courses.index', compact('courses', 'categories', 'categorySlug'));
    }

    public function show($slug)
    {
        $course = $this->courseRepository->findBySlug($slug);
        return view('courses.show', compact('course'));
    }

    public function like(Course $course)
    {
        $like = \App\Models\CourseLike::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->first();

        if ($like) {
            $like->delete();
            $message = 'Batal menyukai kelas ini.';
        } else {
            \App\Models\CourseLike::create([
                'user_id' => auth()->id(),
                'course_id' => $course->id,
            ]);
            $message = 'Menyukai kelas ini!';
        }

        return back()->with('success', $message);
    }

    public function create()
    {
        return view('instructor.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $this->uploadService->upload($request->file('thumbnail'), 'courses/thumbnails');
        }

        $course = $this->courseRepository->create([
            'instructor_id' => auth()->id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'description' => $request->description,
            'price' => $request->price,
            'thumbnail' => $thumbnailPath,
            'is_approved' => false,
        ]);

        return redirect()->route('instructor.dashboard')->with('success', 'Course created successfully and pending approval.');
    }

    public function enroll(Course $course)
    {
        $success = $this->courseService->enroll(auth()->user(), $course);

        if (!$success) {
            return redirect()->route('student.learning', $course->slug)->with('success', 'You are already enrolled.');
        }

        return redirect()->route('student.learning', $course->slug)->with('success', 'Successfully enrolled! Welcome to the sanctuary.');
    }

    public function learn($slug, $subChapterId = null)
    {
        $course = $this->courseRepository->findBySlug($slug);
        $user = auth()->user();
        
        // Check enrollment
        if (!$user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return redirect()->route('courses.show', $slug)->with('error', 'You must enroll first.');
        }

        $firstChapter = $course->chapters->first();
        $currentSubChapter = $subChapterId 
            ? \App\Models\SubChapter::with(['material', 'quiz.questions.choices'])->findOrFail($subChapterId)
            : ($firstChapter ? $firstChapter->subChapters()->with(['material', 'quiz.questions.choices'])->first() : null);

        if (!$currentSubChapter) {
            return back()->with('error', 'No lessons available yet.');
        }

        $learningData = $this->courseService->getLearningData($user, $course, $currentSubChapter);

        return view('student.player', array_merge([
            'course' => $course,
            'currentSubChapter' => $currentSubChapter
        ], $learningData));
    }

    public function instructorIndex()
    {
        $courses = auth()->user()->courses()->withCount('students')->get();
        return view('instructor.courses.index', compact('courses'));
    }

    public function update(Request $request, Course $course)
    {
        if ($course->instructor_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->uploadService->upload($request->file('thumbnail'), 'courses/thumbnails', $course->thumbnail);
        }

        $this->courseRepository->update($course, $data);

        return redirect()->route('instructor.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        if ($course->instructor_id !== auth()->id()) {
            abort(403);
        }

        if ($course->thumbnail) {
            $this->uploadService->delete($course->thumbnail);
        }

        $this->courseRepository->delete($course);

        return redirect()->route('instructor.courses.index')->with('success', 'Course deleted and removed from the sanctuary.');
    }

    public function addChapter(Request $request, Course $course)
    {
        $request->validate(['title' => 'required|string|max:255']);
        $this->courseRepository->addChapter($course, [
            'title' => $request->title,
            'order' => $course->chapters()->count() + 1
        ]);

        return back()->with('success', 'Chapter added.');
    }

    public function addSubChapter(Request $request, $chapterId)
    {
        $request->validate(['title' => 'required|string|max:255']);
        $this->courseRepository->addSubChapter($chapterId, [
            'title' => $request->title,
            'order' => \App\Models\Chapter::find($chapterId)->subChapters()->count() + 1
        ]);

        return back()->with('success', 'Sub-chapter added.');
    }

    public function editMaterial($subChapterId)
    {
        $subChapter = \App\Models\SubChapter::with('material')->findOrFail($subChapterId);
        return view('instructor.materials.edit', compact('subChapter'));
    }

    public function updateMaterial(Request $request, $subChapterId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $this->courseRepository->updateMaterial($subChapterId, [
            'title' => $request->title,
            'content' => $request->content,
            'type' => 'text'
        ]);

        return back()->with('success', 'Material updated.');
    }

    public function markComplete(\App\Models\SubChapter $subChapter)
    {
        $user = auth()->user();
        $course = $subChapter->chapter->course;

        // Ensure user is enrolled
        if (!$user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            abort(403);
        }

        $this->progressRepository->markAsCompleted($user->id, $subChapter->id);

        // Check if course is completed
        if ($course->isCompletedBy($user)) {
            $enrollment = \App\Models\Enrollment::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->first();
            
            if ($enrollment && is_null($enrollment->completed_at)) {
                $enrollment->update(['completed_at' => now()]);
            }
            return back()->with('success', 'Pelajaran ditandai selesai! Selamat, Anda telah menyelesaikan kelas ini!');
        }

        return back()->with('success', 'Pelajaran ditandai selesai!');
    }

    public function certificate(Course $course)
    {
        $user = auth()->user();

        // Ensure user is enrolled
        $enrollment = \App\Models\Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if (!$enrollment) {
            abort(403, 'Anda belum mendaftar di kelas ini.');
        }

        // Ensure course is completed
        if (!$course->isCompletedBy($user)) {
            abort(403, 'Anda belum menyelesaikan semua bab pada kelas ini.');
        }

        if (is_null($enrollment->completed_at)) {
            $enrollment->update(['completed_at' => now()]);
        }

        return view('courses.certificate', compact('course', 'user', 'enrollment'));
    }
}
