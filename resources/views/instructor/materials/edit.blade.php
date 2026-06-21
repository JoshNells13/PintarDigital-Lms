@extends('layouts.dashboard')

@section('title', 'Editor | ' . $subChapter->title)
@section('header', 'Mengedit Materi: ' . $subChapter->title)

@section('content')
<!-- Editor Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
<style>
    .EasyMDEContainer .CodeMirror {
        border-radius: 1rem;
        border: none;
        background: var(--color-surface-container-low);
        padding: 1rem;
        font-family: 'Inter', sans-serif;
        font-size: 1.1rem;
        min-height: 500px;
    }
    .EasyMDEContainer .editor-toolbar {
        border: none;
        background: transparent;
        padding-bottom: 1rem;
    }
    .editor-toolbar button {
        border-radius: 8px;
        margin-right: 4px;
    }
    .editor-toolbar button.active, .editor-toolbar button:hover {
        background: var(--color-primary-container);
        color: white;
    }
</style>

<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex justify-between items-center bg-surface-container/50 p-4 rounded-xl">
        <div class="flex items-center gap-3">
            <a href="{{ route('instructor.courses.edit', $subChapter->chapter->course_id) }}" class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <span class="text-sm font-bold text-on-surface-variant uppercase tracking-widest">{{ $subChapter->chapter->title }} / {{ $subChapter->title }}</span>
        </div>
        <div class="flex gap-2">
            <button form="material-form" type="submit" class="px-6 py-2 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-all">
                Simpan Perubahan
            </button>
        </div>
    </div>

    <form id="material-form" action="{{ route('instructor.sub-chapters.material.update', $subChapter->id) }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="bg-surface-container-lowest p-8 rounded-2xl border border-outline-variant/15 shadow-sm space-y-8">
            <!-- Title -->
            <div>
                <input type="text" name="title" value="{{ old('title', $subChapter->material->title ?? $subChapter->title) }}" required
                    class="w-full text-4xl font-extrabold tracking-tight bg-transparent border-none p-0 focus:ring-0 placeholder:text-on-surface-variant/20"
                    placeholder="Masukkan judul materi...">
            </div>

            <!-- Content Area -->
            <div>
                <textarea name="content" id="markdown-editor">{{ old('content', $subChapter->material->content ?? '') }}</textarea>
            </div>
        </div>
    </form>
</div>

<!-- Editor Scripts -->
<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
<script>
    const easyMDE = new EasyMDE({
        element: document.getElementById('markdown-editor'),
        spellChecker: false,
        status: false,
        autosave: {
            enabled: true,
            uniqueId: "material_{{ $subChapter->id }}",
            delay: 1000,
        },
        toolbar: [
            "bold", "italic", "heading", "|", 
            "quote", "unordered-list", "ordered-list", "|", 
            "link", "image", "|", 
            "preview", "side-by-side", "fullscreen", "|", 
            "guide"
        ],
        placeholder: "Tulis konten materi Anda di sini menggunakan Markdown...",
    });
</script>
@endsection
