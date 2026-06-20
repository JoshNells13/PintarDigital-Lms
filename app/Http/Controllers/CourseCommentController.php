<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseComment;
use App\Models\CourseCommentLike;
use Illuminate\Http\Request;

class CourseCommentController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:course_comments,id',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $course->comments()->create([
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id,
            'content' => $request->content,
            'rating' => $request->parent_id ? null : $request->rating, // Rating only on root comments
        ]);

        return back()->with('success', 'Komentar/ulasan berhasil ditambahkan!');
    }

    public function likeComment(CourseComment $comment)
    {
        $like = CourseCommentLike::where('user_id', auth()->id())
            ->where('course_comment_id', $comment->id)
            ->first();

        if ($like) {
            $like->delete();
            $message = 'Batal menyukai komentar.';
        } else {
            CourseCommentLike::create([
                'user_id' => auth()->id(),
                'course_comment_id' => $comment->id,
            ]);
            $message = 'Menyukai komentar!';
        }

        return back()->with('success', $message);
    }
}
