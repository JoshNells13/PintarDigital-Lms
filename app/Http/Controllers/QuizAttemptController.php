<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizAttemptController extends Controller
{
    protected $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $answers = $request->input('answers', []);
        $score = $this->quizService->evaluateAndRecord(auth()->id(), $quiz, $answers);

        // Check if the user completed the course
        $course = $quiz->subChapter->chapter->course;
        $user = auth()->user();
        
        if ($course->isCompletedBy($user)) {
            $enrollment = \App\Models\Enrollment::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->first();
            if ($enrollment && is_null($enrollment->completed_at)) {
                $enrollment->update(['completed_at' => now()]);
            }
        }

        if ($score >= 70) {
            return back()->with('success', "Kuis selesai! Selamat, Anda lulus dengan skor: " . number_format($score, 1) . "%");
        } else {
            return back()->with('error', "Kuis selesai. Skor Anda: " . number_format($score, 1) . "%. Anda memerlukan minimal 70% untuk lulus.");
        }
    }
}
