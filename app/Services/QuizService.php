<?php

namespace App\Services;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Choice;
use App\Contracts\Repositories\ProgressRepositoryInterface;

class QuizService
{
    protected $progressRepository;

    public function __construct(ProgressRepositoryInterface $progressRepository)
    {
        $this->progressRepository = $progressRepository;
    }

    public function evaluateAndRecord(int $userId, Quiz $quiz, array $answers)
    {
        $totalQuestions = $quiz->questions()->count();
        $correctAnswers = 0;

        foreach ($answers as $questionId => $choiceId) {
            $choice = Choice::find($choiceId);
            if ($choice && $choice->question_id == $questionId && $choice->is_correct) {
                $correctAnswers++;
            }
        }

        $score = ($totalQuestions > 0) ? ($correctAnswers / $totalQuestions) * 100 : 0;

        $attempt = QuizAttempt::create([
            'user_id' => $userId,
            'quiz_id' => $quiz->id,
            'score' => $score
        ]);

        // Automatically mark lesson as complete
        $this->progressRepository->markAsCompleted($userId, $quiz->sub_chapter_id);

        return $score;
    }
}
