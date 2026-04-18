<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'user_id', 'course_id')
                    ->using(Enrollment::class)
                    ->withPivot('enrolled_at')
                    ->withTimestamps();
    }

    public function courseProgress($courseId)
    {
        $course = Course::withCount('chapters')->find($courseId);
        if (!$course) return 0;

        $totalSubChapters = SubChapter::whereIn('chapter_id', $course->chapters->pluck('id'))->count();
        if ($totalSubChapters === 0) return 0;

        $completedCount = Progress::where('user_id', $this->id)
            ->whereIn('sub_chapter_id', function($query) use ($course) {
                $query->select('id')
                    ->from('sub_chapters')
                    ->whereIn('chapter_id', $course->chapters->pluck('id'));
            })
            ->where('is_completed', true)
            ->count();

        return round(($completedCount / $totalSubChapters) * 100);
    }
}
