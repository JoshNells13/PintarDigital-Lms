<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function index()
    {
        $mentors = User::where('role', 'instructor')
            ->withCount('courses')
            ->with('courses')
            ->get();

        return view('mentors.index', compact('mentors'));
    }
}
