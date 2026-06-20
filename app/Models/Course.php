<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'instructor_id',
        'category_id',
        'title',
        'slug',
        'description',
        'thumbnail',
        'price',
        'is_approved',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class)->orderBy('order');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }

    public function comments()
    {
        return $this->hasMany(CourseComment::class)->orderBy('created_at', 'desc');
    }

    public function rootComments()
    {
        return $this->hasMany(CourseComment::class)->whereNull('parent_id')->orderBy('created_at', 'desc');
    }

    public function likes()
    {
        return $this->hasMany(CourseLike::class);
    }

    public function isLikedBy($user)
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function averageRating()
    {
        $avg = $this->comments()->whereNotNull('rating')->avg('rating');
        return $avg ? round($avg, 1) : null;
    }

    public function isCompletedBy($user)
    {
        if (!$user) return false;
        $totalSubChapters = $this->chapters->sum(fn($c) => $c->subChapters->count());
        if ($totalSubChapters === 0) return false;

        $completedCount = \App\Models\Progress::where('user_id', $user->id)
            ->whereIn('sub_chapter_id', function($query) {
                $query->select('id')
                    ->from('sub_chapters')
                    ->whereIn('chapter_id', $this->chapters->pluck('id'));
            })
            ->where('is_completed', true)
            ->count();

        return $completedCount === $totalSubChapters;
    }
}
