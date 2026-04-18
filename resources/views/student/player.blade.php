<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $currentSubChapter->title }} | {{ $course->title }}</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#004ac6',
                        'primary-container': '#2563eb',
                        'on-primary': '#ffffff',
                        secondary: '#495c95',
                        'secondary-container': '#acbfff',
                        'on-secondary-container': '#394c84',
                        tertiary: '#943700',
                        'tertiary-container': '#bc4800',
                        surface: '#faf8ff',
                        'on-surface': '#191b23',
                        'surface-container-lowest': '#ffffff',
                        'surface-container-low': '#f3f3fe',
                        'surface-container': '#ededf9',
                        'surface-container-high': '#e7e7f3',
                        'surface-container-highest': '#e1e2ed',
                        'on-surface-variant': '#434655',
                        'inverse-surface': '#2e3039',
                        'inverse-on-surface': '#f0f0fb',
                        outline: '#737686',
                        'outline-variant': '#c3c6d7',
                    },
                    borderRadius: {
                        'md': '0.75rem',
                        'lg': '1rem',
                        'xl': '1.5rem',
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        @layer utilities {
            .glass-panel {
                background: rgba(255, 255, 255, 0.8);
                @apply backdrop-blur-xl;
            }
            .hero-gradient {
                background: linear-gradient(180deg, #faf8ff 0%, #f3f3fe 100%);
            }
            .prose {
                @apply text-on-surface leading-relaxed;
                font-size: 1.125rem;
            }
            .prose h1 { @apply text-4xl font-extrabold tracking-tight mb-8 mt-12; }
            .prose h2 { @apply text-2xl font-bold tracking-tight mb-6 mt-10; }
            .prose p { @apply mb-6; }
            .prose blockquote {
                @apply border-l-4 border-primary pl-6 py-2 italic text-on-surface-variant my-8 bg-primary/5 rounded-r-xl;
            }
            .prose ul { @apply list-disc pl-6 mb-6 space-y-2; }
            .prose ol { @apply list-decimal pl-6 mb-6 space-y-2; }
            .prose hr { @apply border-outline-variant/10 my-12; }
            .prose code { @apply bg-surface-container-high px-1.5 py-0.5 rounded text-sm font-mono; }
            .prose pre {
                @apply bg-inverse-surface text-inverse-on-surface p-6 rounded-2xl my-8 overflow-x-auto text-sm;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</head>
<body class="bg-surface h-full flex flex-col overflow-hidden">
    <!-- Player Header -->
    <header class="h-16 bg-surface border-b border-outline-variant/10 px-6 flex justify-between items-center z-50">
        <div class="flex items-center gap-4">
            <a href="{{ route('student.dashboard') }}" class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-colors font-bold text-xs flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">close</span>
            </a>
            <div class="h-8 w-px bg-outline-variant/20"></div>
            <div>
                <h1 class="text-sm font-bold truncate max-w-xs">{{ $course->title }}</h1>
                <p class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest">{{ $currentSubChapter->chapter->title }}</p>
            </div>
        </div>
        
        <div class="flex items-center gap-3">
            <div class="hidden md:flex flex-col items-end mr-4">
                <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-1">Course Progress ({{ $progressPercentage }}%)</span>
                <div class="w-32 bg-surface-container-high h-1 rounded-full overflow-hidden">
                    <div class="bg-primary h-full transition-all duration-1000" style="width: {{ $progressPercentage }}%"></div>
                </div>
            </div>
            
            @if($isCompleted)
                <span class="px-5 py-2 bg-success/10 text-success text-[10px] font-bold uppercase rounded-xl flex items-center gap-2">
                    Completed
                    <span class="material-symbols-outlined text-sm">verified</span>
                </span>
            @else
                <form action="{{ route('student.learning.complete', $currentSubChapter->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-5 py-2 bg-primary text-on-primary text-[10px] font-bold uppercase rounded-xl hover:bg-primary-container transition-colors flex items-center gap-2">
                        Mark as Complete
                        <span class="material-symbols-outlined text-sm font-bold">check_circle</span>
                    </button>
                </form>
            @endif
        </div>
    </header>

    <div class="flex-1 flex overflow-hidden">
        <!-- Sidebar Navigation -->
        <aside class="w-80 bg-surface-container-low border-r border-outline-variant/10 overflow-y-auto hidden lg:block">
            <div class="p-6">
                <h3 class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-6">Course Content</h3>
                <div class="space-y-6">
                    @foreach($course->chapters as $chapter)
                        <div>
                            <h4 class="text-xs font-bold text-on-surface mb-3">{{ $chapter->title }}</h4>
                            <div class="space-y-1">
                                @foreach($chapter->subChapters as $sub)
                                    <a href="{{ route('student.learning', ['course_slug' => $course->slug, 'subChapterId' => $sub->id]) }}" 
                                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all {{ $currentSubChapter->id == $sub->id ? 'bg-primary/5 text-primary' : 'hover:bg-surface-container-high text-on-surface-variant' }}">
                                        <span class="material-symbols-outlined text-sm {{ $currentSubChapter->id == $sub->id ? 'fill-1' : '' }}">
                                            @if($sub->material && $sub->quiz)
                                                menu_book
                                            @elseif($sub->material)
                                                article
                                            @else
                                                quiz
                                            @endif
                                        </span>
                                        <span class="text-[11px] font-bold line-clamp-1 flex-1">{{ $sub->title }}</span>
                                        
                                        @php
                                            $subCompleted = \App\Models\Progress::where('user_id', auth()->id())->where('sub_chapter_id', $sub->id)->where('is_completed', true)->exists();
                                        @endphp
                                        
                                        @if($subCompleted)
                                            <span class="material-symbols-outlined text-success text-sm">check_circle</span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>

        <!-- Main Material Rendering -->
        <main class="flex-1 overflow-y-auto bg-surface-container-lowest">
            <div class="p-8">
                 @if(session('success'))
                    <div class="max-w-3xl mx-auto mb-6 p-4 bg-primary/5 border border-primary/20 text-primary rounded-xl flex items-center gap-3">
                        <span class="material-symbols-outlined">check_circle</span>
                        <p class="text-sm font-semibold">{{ session('success') }}</p>
                    </div>
                @endif
            </div>

            <article class="max-w-3xl mx-auto pb-24 px-8 md:px-12">
                @if($currentSubChapter->material)
                    <div class="prose">
                        {!! $currentSubChapter->material->html_content !!}
                    </div>
                @endif

                @if($currentSubChapter->quiz)
                    <div class="mt-16 pt-16 border-t border-outline-variant/10 space-y-12">
                        <div class="text-center bg-surface-container-low p-12 rounded-3xl border border-outline-variant/10">
                            <span class="material-symbols-outlined text-5xl text-primary mb-6">quiz</span>
                            <h2 class="text-3xl font-extrabold mb-2">{{ $currentSubChapter->quiz->title }}</h2>
                            <p class="text-on-surface-variant font-medium">Verify your knowledge to progress to the next chapter.</p>
                        </div>

                        <form action="{{ route('student.quizzes.submit', $currentSubChapter->quiz->id) }}" method="POST" class="space-y-12">
                            @csrf
                            @foreach($currentSubChapter->quiz->questions as $question)
                                <div class="bg-surface-container-lowest p-8 rounded-2xl border border-outline-variant/10 shadow-sm space-y-6">
                                    <h4 class="text-lg font-bold flex gap-4">
                                        <span class="text-primary/40">{{ $loop->iteration }}</span>
                                        {{ $question->question_text }}
                                    </h4>
                                    <div class="grid gap-3">
                                        @foreach($question->choices as $choice)
                                            <label class="flex items-center gap-4 px-6 py-4 rounded-xl border border-outline-variant/10 hover:bg-primary/5 hover:border-primary/20 transition-all cursor-pointer group">
                                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $choice->id }}" required 
                                                    class="w-4 h-4 text-primary border-outline-variant/30 focus:ring-primary/20">
                                                <span class="text-sm font-medium text-on-surface-variant group-hover:text-on-surface transition-colors">{{ $choice->choice_text }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="flex justify-center pt-8">
                                <button type="submit" class="px-12 py-5 bg-primary text-on-primary font-black rounded-2xl shadow-2xl shadow-primary/30 hover:scale-[0.98] transition-all uppercase tracking-widest text-xs">
                                    Submit Results
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                @if(!$currentSubChapter->material && !$currentSubChapter->quiz)
                    <div class="bg-surface-container-low p-12 rounded-3xl text-center border-2 border-dashed border-outline-variant/20 italic text-on-surface-variant">
                        This lesson is currently being prepared.
                    </div>
                @endif
                
                <!-- Lesson Navigation -->
                <div class="mt-24 pt-12 border-t border-outline-variant/10 flex justify-between items-center">
                    @if($prevSubChapter)
                        <a href="{{ route('student.learning', ['course_slug' => $course->slug, 'subChapterId' => $prevSubChapter->id]) }}" 
                           class="flex items-center gap-2 text-on-surface-variant font-bold text-[11px] uppercase tracking-widest hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-sm">chevron_left</span>
                            Previous Lesson
                        </a>
                    @else
                        <div class="flex items-center gap-2 text-on-surface-variant/30 font-bold text-[11px] uppercase tracking-widest cursor-not-allowed">
                            <span class="material-symbols-outlined text-sm">chevron_left</span>
                            Previous Lesson
                        </div>
                    @endif

                    @if($nextSubChapter)
                        <a href="{{ route('student.learning', ['course_slug' => $course->slug, 'subChapterId' => $nextSubChapter->id]) }}" 
                           class="px-8 py-3 bg-surface-container-high text-on-surface text-[11px] uppercase tracking-widest font-black rounded-xl hover:bg-surface-container-highest transition-colors flex items-center gap-2">
                            Next Lesson
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
                        </a>
                    @else
                        <div class="px-8 py-3 bg-surface-container-low text-on-surface-variant/30 text-[11px] uppercase tracking-widest font-black rounded-xl cursor-not-allowed flex items-center gap-2">
                            End of Course
                            <span class="material-symbols-outlined text-sm">check_circle</span>
                        </div>
                    @endif
                </div>
            </article>
        </main>
    </div>
</body>
</html>
