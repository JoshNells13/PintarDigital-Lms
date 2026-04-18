<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->courses()->withCount('students')->get();
        $totalStudents = $courses->sum('students_count');
        
        return view('instructor.dashboard', compact('courses', 'totalStudents'));
    }
}
