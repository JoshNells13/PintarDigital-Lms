<?php

namespace App\Services;

use App\Contracts\Repositories\CourseRepositoryInterface;
use App\Models\Course;
use App\Notifications\CourseStatusNotification;

class ModerationService
{
    protected $courseRepository;
    protected $uploadService;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        UploadService $uploadService
    ) {
        $this->courseRepository = $courseRepository;
        $this->uploadService = $uploadService;
    }

    public function approve(Course $course)
    {
        $this->courseRepository->update($course, ['is_approved' => true]);
        $course->instructor->notify(new CourseStatusNotification($course, 'approved'));
        return true;
    }

    public function reject(Course $course)
    {
        // Notify before deletion
        $course->instructor->notify(new CourseStatusNotification($course, 'rejected'));

        if ($course->thumbnail) {
            $this->uploadService->delete($course->thumbnail);
        }

        return $this->courseRepository->delete($course);
    }
}
