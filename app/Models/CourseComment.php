<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'parent_id',
        'content',
        'rating'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function parent()
    {
        return $this->belongsTo(CourseComment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(CourseComment::class, 'parent_id')->orderBy('created_at', 'asc');
    }

    public function likes()
    {
        return $this->hasMany(CourseCommentLike::class);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
