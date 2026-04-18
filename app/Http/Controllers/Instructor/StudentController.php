<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Get all student IDs enrolled in any of this instructor's courses
        $instructorCourseIds = Course::where('instructor_id', auth()->id())->pluck('id');
        
        $enrolledStudents = User::whereHas('enrolledCourses', function($query) use ($instructorCourseIds) {
            $query->whereIn('courses.id', $instructorCourseIds);
        })->with(['enrolledCourses' => function($query) use ($instructorCourseIds) {
            $query->whereIn('courses.id', $instructorCourseIds)->with('chapters');
        }])->get();

        return view('instructor.students.index', compact('enrolledStudents'));
    }
}
