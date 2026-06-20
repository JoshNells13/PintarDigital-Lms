<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCommentLike extends Model
{
    use HasFactory;

    protected $table = 'course_comment_likes';

    protected $fillable = ['user_id', 'course_comment_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(CourseComment::class, 'course_comment_id');
    }
}
