<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\SubChapter;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function edit(SubChapter $subChapter)
    {
        $subChapter->load(['quiz.questions.choices', 'chapter.course']);
        
        // Ensure only instructor can manage own course
        if ($subChapter->chapter->course->instructor_id !== auth()->id()) {
            abort(403);
        }

        $quiz = $subChapter->quiz ?? $subChapter->quiz()->create(['title' => 'Assessment: ' . $subChapter->title]);

        return view('instructor.quizzes.edit', compact('subChapter', 'quiz'));
    }

    public function addQuestion(Request $request, Quiz $quiz)
    {
        $request->validate(['text' => 'required|string']);

        $quiz->questions()->create(['question_text' => $request->text]);

        return back()->with('success', 'Question added.');
    }

    public function addChoice(Request $request, Question $question)
    {
        $request->validate([
            'text' => 'required|string',
            'is_correct' => 'boolean'
        ]);

        // If this choice is correct, make others incorrect (only 1 correct for now)
        if ($request->boolean('is_correct')) {
            $question->choices()->update(['is_correct' => false]);
        }

        $question->choices()->create([
            'choice_text' => $request->text,
            'is_correct' => $request->boolean('is_correct')
        ]);

        return back()->with('success', 'Choice added.');
    }

    public function removeChoice(Choice $choice)
    {
        $choice->delete();
        return back()->with('success', 'Choice removed.');
    }

    public function removeQuestion(Question $question)
    {
        $question->delete();
        return back()->with('success', 'Question removed.');
    }
}
