<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\CourseRepositoryInterface;
use App\Models\Course;

class EloquentCourseRepository implements CourseRepositoryInterface
{
    public function getAllApproved()
    {
        return Course::where('is_approved', true)->with('instructor')->get();
    }

    public function findBySlug($slug)
    {
        return Course::where('slug', $slug)->with(['chapters.subChapters.material', 'chapters.subChapters.quiz'])->firstOrFail();
    }

    public function findOrFail($id)
    {
        return Course::with(['chapters.subChapters.material'])->findOrFail($id);
    }

    public function getPendingApproval()
    {
        return Course::where('is_approved', false)->with('instructor')->get();
    }

    public function countAll()
    {
        return Course::count();
    }

    public function countApproved()
    {
        return Course::where('is_approved', true)->count();
    }

    public function create(array $data)
    {
        return Course::create($data);
    }

    public function update(Course $course, array $data)
    {
        $course->update($data);
        return $course;
    }

    public function delete(Course $course)
    {
        return $course->delete();
    }

    public function addChapter(Course $course, array $data)
    {
        return $course->chapters()->create($data);
    }

    public function addSubChapter(int $chapterId, array $data)
    {
        $chapter = \App\Models\Chapter::findOrFail($chapterId);
        return $chapter->subChapters()->create($data);
    }

    public function updateMaterial(int $subChapterId, array $data)
    {
        $subChapter = \App\Models\SubChapter::findOrFail($subChapterId);
        return $subChapter->material()->updateOrCreate(
            ['sub_chapter_id' => $subChapterId],
            $data
        );
    }
}
