<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Progress;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')
            ->withCount([
                'enrolledCourses as completed_courses_count' => function ($query) {
                    $query->whereNotNull('completed_at');
                }
            ])
            ->get()
            ->map(function ($student) {
                $completedSubChaptersCount = Progress::where('user_id', $student->id)
                    ->where('is_completed', true)
                    ->count();

                $student->completed_subchapters_count = $completedSubChaptersCount;
                $student->points = $completedSubChaptersCount * 10;
                
                return $student;
            })
            ->sortByDesc(function ($student) {
                return $student->completed_courses_count * 10000 + $student->points;
            })
            ->values();

        return view('leaderboard', compact('students'));
    }
}
