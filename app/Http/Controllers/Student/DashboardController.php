<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $enrolledCourses = $user->enrolledCourses()->with(['instructor', 'chapters.subChapters'])->get();

        // Calculate progress for each course
        $enrolledCourses->each(function($course) use ($user) {
            $totalSubChapters = $course->chapters->sum(fn($c) => $c->subChapters->count());
            
            $subChapterIds = $course->chapters->flatMap(fn($c) => $c->subChapters)->pluck('id');
            
            $completedCount = \App\Models\Progress::where('user_id', $user->id)
                ->whereIn('sub_chapter_id', $subChapterIds)
                ->where('is_completed', true)
                ->count();

            $course->progress_percentage = $totalSubChapters > 0 
                ? round(($completedCount / $totalSubChapters) * 100) 
                : 0;
            
            $course->completed_count = $completedCount;
            $course->total_count = $totalSubChapters;
        });

        return view('student.dashboard', compact('enrolledCourses'));
    }
}
