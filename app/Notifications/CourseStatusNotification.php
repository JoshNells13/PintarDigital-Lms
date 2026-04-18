<?php

namespace App\Notifications;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CourseStatusNotification extends Notification
{
    use Queueable;

    protected $course;
    protected $status;

    public function __construct(Course $course, string $status)
    {
        $this->course = $course;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $isApproved = $this->status === 'approved';
        
        return [
            'type' => 'course_status',
            'title' => $isApproved ? 'Course Approved!' : 'Course Rejected',
            'message' => $isApproved 
                ? "Your course '{$this->course->title}' has been successfully moderated and is now live." 
                : "Your course '{$this->course->title}' was not approved and has been removed from the queue.",
            'url' => route('instructor.dashboard'),
            'icon' => $isApproved ? 'verified' : 'cancel'
        ];
    }
}
