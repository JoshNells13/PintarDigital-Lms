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

        return back()->with('success', "Quiz completed! Your score: " . number_format($score, 1) . "%");
    }
}
