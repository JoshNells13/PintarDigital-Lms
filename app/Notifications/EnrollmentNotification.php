<?php

namespace App\Notifications;

use App\Models\Course;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EnrollmentNotification extends Notification
{
    use Queueable;

    protected $student;
    protected $course;

    public function __construct(User $student, Course $course)
    {
        $this->student = $student;
        $this->course = $course;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'enrollment',
            'title' => 'New Student Enrolled',
            'message' => "{$this->student->name} has just enrolled in '{$this->course->title}'.",
            'url' => route('instructor.students.index'),
            'icon' => 'person_add'
        ];
    }
}
