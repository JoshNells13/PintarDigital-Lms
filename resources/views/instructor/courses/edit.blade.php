@extends('layouts.dashboard')

@section('title', 'Manage Curriculum | ' . $course->title)
@section('header', 'Manage: ' . $course->title)

@section('content')
<div class="grid lg:grid-cols-3 gap-8">
    <!-- Main Content: Curriculum List -->
    <div class="lg:col-span-2 space-y-6">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-bold tracking-tight">Course Curriculum</h3>
            <button onclick="document.getElementById('add-chapter-modal').classList.remove('hidden')" class="text-primary font-bold text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">add</span>
                Add Chapter
            </button>
        </div>

        @if($course->chapters->isEmpty())
            <div class="bg-surface-container-low p-12 rounded-2xl border-2 border-dashed border-outline-variant/20 text-center">
                <p class="text-on-surface-variant font-medium">Your curriculum is empty. Start by adding your first chapter.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($course->chapters as $chapter)
                    <div class="bg-surface-container-lowest border border-outline-variant/10 rounded-2xl overflow-hidden shadow-sm">
                        <!-- Chapter Header -->
                        <div class="bg-surface-container-low p-4 px-6 flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-bold text-on-surface-variant/50 uppercase tracking-widest">CH {{ $loop->iteration }}</span>
                                <h4 class="font-bold text-lg text-on-surface">{{ $chapter->title }}</h4>
                            </div>
                            <button onclick="document.getElementById('add-sub-chapter-modal-{{ $chapter->id }}').classList.remove('hidden')" class="text-xs font-bold text-primary px-3 py-1 hover:bg-primary/5 rounded-lg transition-colors">
                                + Add Sub-chapter
                            </button>
                        </div>
                        
                        <!-- Sub-chapters List -->
                        <div class="p-4 space-y-2">
                            @forelse($chapter->subChapters as $sub)
                                <div class="flex items-center justify-between p-4 bg-surface rounded-xl border border-outline-variant/5 hover:border-primary/20 hover:bg-primary/5 transition-all group">
                                    <div class="flex items-center gap-4">
                                        <span class="material-symbols-outlined text-on-surface-variant text-[20px]">drag_indicator</span>
                                        <div>
                                            <p class="text-sm font-bold">{{ $sub->title }}</p>
                                            <p class="text-[10px] text-on-surface-variant uppercase tracking-widest font-bold mt-0.5">
                                                @if($sub->material || $sub->quiz)
                                                     <span class="text-primary">Content Ready</span>
                                                @else
                                                     <span class="text-tertiary">Empty</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex gap-2 items-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('instructor.sub-chapters.material.edit', $sub->id) }}" class="px-4 py-2 bg-surface-container-high text-on-surface text-[10px] font-bold uppercase rounded-lg hover:bg-surface-container-highest transition-colors flex items-center gap-2">
                                            <span class="material-symbols-outlined text-[16px]">article</span>
                                            Edit Content
                                        </a>
                                        <a href="{{ route('instructor.sub-chapters.quiz.edit', $sub->id) }}" class="px-4 py-2 bg-primary/10 text-primary text-[10px] font-bold uppercase rounded-lg hover:bg-primary/20 transition-colors flex items-center gap-2">
                                            <span class="material-symbols-outlined text-[16px]">quiz</span>
                                            Edit Quiz
                                        </a>
                                        <button class="p-2 text-on-surface-variant hover:text-error transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <p class="text-xs text-on-surface-variant italic p-4 text-center">No sub-chapters yet.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Modals for Sub-chapters -->
                    <div id="add-sub-chapter-modal-{{ $chapter->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-on-surface/40 backdrop-blur-sm">
                        <div class="bg-surface-container-lowest p-8 rounded-2xl w-full max-w-md shadow-2xl border border-outline-variant/15">
                            <h3 class="text-xl font-bold mb-6 text-on-surface">Add Sub-chapter to {{ $chapter->title }}</h3>
                            <form action="{{ route('instructor.chapters.sub-chapters.store', $chapter->id) }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Sub-chapter Title</label>
                                    <input type="text" name="title" required class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="e.g. Fundamental Axioms">
                                </div>
                                <div class="flex gap-4 pt-4">
                                    <button type="submit" class="flex-1 py-3 bg-primary text-on-primary font-bold rounded-xl">Add Sub-chapter</button>
                                    <button type="button" onclick="this.closest('#add-sub-chapter-modal-{{ $chapter->id }}').classList.add('hidden')" class="flex-1 py-3 bg-surface-container-high text-on-surface font-semibold rounded-xl">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Sidebar: Course Settings -->
    <div class="space-y-6">
        <div class="bg-surface-container-low p-6 rounded-2xl border border-outline-variant/10 shadow-sm">
            <h4 class="font-bold mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">settings</span>
                Course Summary
            </h4>
            <div class="space-y-4 text-sm">
                <div>
                    <span class="text-on-surface-variant">Price:</span>
                    <span class="font-bold text-on-surface float-right">${{ $course->price }}</span>
                </div>
                <div>
                    <span class="text-on-surface-variant">Access:</span>
                    <span class="font-bold text-primary float-right">Lifetime</span>
                </div>
                <div>
                    <span class="text-on-surface-variant">Status:</span>
                    <span class="font-bold {{ $course->is_approved ? 'text-primary' : 'text-tertiary' }} float-right">
                        {{ $course->is_approved ? 'Live' : 'Draft' }}
                    </span>
                </div>
            </div>
            <button onclick="document.getElementById('edit-course-modal').classList.remove('hidden')" class="w-full mt-6 py-3 border border-outline text-on-surface font-bold rounded-xl hover:bg-surface-container transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-sm">settings_suggest</span>
                Edit Base Info
            </button>
        </div>
    </div>
</div>

<!-- Modal for Base Info Update -->
<div id="edit-course-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-on-surface/40 backdrop-blur-sm">
    <div class="bg-surface-container-lowest p-8 rounded-3xl w-full max-w-lg shadow-2xl border border-outline-variant/15 max-h-[90vh] overflow-y-auto">
        <h3 class="text-xl font-bold mb-6 text-on-surface">Update Course Metadata</h3>
        <form action="{{ route('instructor.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-2">
                <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest">Course Title</label>
                <input type="text" name="title" value="{{ $course->title }}" required class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20">
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest">Price (USD)</label>
                <input type="number" name="price" value="{{ $course->price }}" required min="0" class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20">
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest">Description</label>
                <textarea name="description" rows="4" class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20">{{ $course->description }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest">New Thumbnail (Optional)</label>
                <input type="file" name="thumbnail" class="w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 py-3 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20">Update Course</button>
                <button type="button" onclick="document.getElementById('edit-course-modal').classList.add('hidden')" class="flex-1 py-3 bg-surface-container-high text-on-surface font-semibold rounded-xl">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal for Chapters -->
<div id="add-chapter-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-on-surface/40 backdrop-blur-sm">
    <div class="bg-surface-container-lowest p-8 rounded-2xl w-full max-w-md shadow-2xl border border-outline-variant/15">
        <h3 class="text-xl font-bold mb-6 text-on-surface">Add New Chapter</h3>
        <form action="{{ route('instructor.courses.chapters.store', $course->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Chapter Title</label>
                <input type="text" name="title" required class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="e.g. Introduction to Logic">
            </div>
            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 py-3 bg-primary text-on-primary font-bold rounded-xl">Add Chapter</button>
                <button type="button" onclick="document.getElementById('add-chapter-modal').classList.add('hidden')" class="flex-1 py-3 bg-surface-container-high text-on-surface font-semibold rounded-xl">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection
