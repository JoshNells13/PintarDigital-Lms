@extends('layouts.dashboard')

@section('title', 'Quiz Builder | ' . $subChapter->title)
@section('header', 'Build Assessment: ' . $subChapter->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex justify-between items-center bg-surface-container/50 p-4 rounded-xl">
        <div class="flex items-center gap-3">
            <a href="{{ route('instructor.courses.edit', $subChapter->chapter->course_id) }}" class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">{{ $subChapter->chapter->title }} / {{ $subChapter->title }}</span>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-surface-container-lowest p-8 rounded-2xl border border-outline-variant/10 shadow-sm">
            <h3 class="text-lg font-bold mb-6">Add New Question</h3>
            <form action="{{ route('instructor.quizzes.questions.store', $quiz->id) }}" method="POST" class="flex gap-4">
                @csrf
                <input type="text" name="text" placeholder="e.g. What is the fundamental principle of focus?" required
                    class="flex-1 px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary/20 text-sm font-medium">
                <button type="submit" class="px-6 py-3 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Add Question
                </button>
            </form>
        </div>

        @foreach($quiz->questions as $question)
            <div class="bg-surface-container-lowest p-8 rounded-2xl border border-outline-variant/10 shadow-sm space-y-6 relative group">
                <div class="flex justify-between items-start">
                    <div class="flex items-center gap-4">
                        <span class="w-8 h-8 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold text-xs">{{ $loop->iteration }}</span>
                        <h4 class="font-bold text-lg">{{ $question->question_text }}</h4>
                    </div>
                    <form action="{{ route('instructor.questions.destroy', $question->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-on-surface-variant hover:bg-error/10 hover:text-error rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-sm">delete</span>
                        </button>
                    </form>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($question->choices as $choice)
                        <div class="flex items-center justify-between p-4 rounded-xl border {{ $choice->is_correct ? 'bg-primary/5 border-primary/20' : 'border-outline-variant/10 hover:bg-surface-container-low' }} transition-colors">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-sm {{ $choice->is_correct ? 'text-primary' : 'text-on-surface-variant' }}">
                                    {{ $choice->is_correct ? 'check_circle' : 'circle' }}
                                </span>
                                <span class="text-sm {{ $choice->is_correct ? 'font-bold text-primary' : '' }}">{{ $choice->choice_text }}</span>
                            </div>
                            <form action="{{ route('instructor.choices.destroy', $choice->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-on-surface-variant hover:text-error transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">close</span>
                                </button>
                            </form>
                        </div>
                    @endforeach

                    <!-- Add Choice Modal/Form -->
                    <div class="p-4 rounded-xl border border-dashed border-outline-variant/30">
                        <form action="{{ route('instructor.questions.choices.store', $question->id) }}" method="POST" class="space-y-3">
                            @csrf
                            <input type="text" name="text" placeholder="Add choice..." required
                                class="w-full px-3 py-2 bg-surface-container rounded-lg border-none focus:ring-1 focus:ring-primary/20 text-xs font-medium">
                            <div class="flex items-center justify-between">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="is_correct" value="1" class="rounded text-primary focus:ring-primary/20">
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-on-surface-variant">Mark as correct</span>
                                </label>
                                <button type="submit" class="px-4 py-1.5 bg-surface-container-high text-on-surface text-[10px] font-bold uppercase rounded-lg hover:bg-surface-container-highest transition-colors">
                                    Add
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
