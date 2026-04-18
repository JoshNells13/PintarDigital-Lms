<?php

namespace App\Services;

use App\Contracts\Repositories\CourseRepositoryInterface;
use App\Contracts\Repositories\ProgressRepositoryInterface;
use App\Models\Course;
use App\Notifications\EnrollmentNotification;

class CourseService
{
    protected $courseRepository;
    protected $progressRepository;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        ProgressRepositoryInterface $progressRepository
    ) {
        $this->courseRepository = $courseRepository;
        $this->progressRepository = $progressRepository;
    }

    public function enroll($user, Course $course)
    {
        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return false;
        }

        $user->enrolledCourses()->attach($course->id, ['enrolled_at' => now()]);
        
        // Notify Instructor
        $course->instructor->notify(new EnrollmentNotification($user, $course));

        return true;
    }

    public function getLearningData($user, Course $course, $currentSubChapter)
    {
        $totalSubChapters = $course->chapters->sum(fn($c) => $c->subChapters->count());
        $subChapterIds = $course->chapters->flatMap(fn($c) => $c->subChapters)->pluck('id')->toArray();
        
        $completedCount = $this->progressRepository->getCompletedCount($user->id, $subChapterIds);
        $progressPercentage = $totalSubChapters > 0 ? round(($completedCount / $totalSubChapters) * 100) : 0;

        // Navigation logic
        $orderedSubChapters = $course->chapters->flatMap->subChapters;
        $currentIndex = $orderedSubChapters->search(fn($s) => $s->id == $currentSubChapter->id);
        
        $prevSubChapter = $currentIndex > 0 ? $orderedSubChapters[$currentIndex - 1] : null;
        $nextSubChapter = $currentIndex < $orderedSubChapters->count() - 1 ? $orderedSubChapters[$currentIndex + 1] : null;

        return [
            'progressPercentage' => $progressPercentage,
            'prevSubChapter' => $prevSubChapter,
            'nextSubChapter' => $nextSubChapter,
            'isCompleted' => $this->progressRepository->isCompleted($user->id, $currentSubChapter->id)
        ];
    }
}
