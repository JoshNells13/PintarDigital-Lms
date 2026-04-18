@extends('layouts.main')

@section('title', 'Knowledge, Stripped Bare | PintarDigital')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient relative overflow-hidden py-24 md:py-32">
    <div class="max-w-7xl mx-auto px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <div class="inline-flex items-center px-3 py-1 bg-secondary-container/30 text-on-secondary-container text-xs font-bold uppercase tracking-widest rounded-full">
                    NEW ERA OF LEARNING
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter leading-[1.1] text-on-surface">
                    Knowledge, <br/>
                    <span class="text-primary">Stripped Bare.</span>
                </h1>
                <p class="text-lg md:text-xl text-on-surface-variant font-body leading-relaxed max-w-xl">
                    PintarDigital is a text-first platform designed for deep focus. No distracting video fluff—just high-fidelity editorial content that respects your time and cognitive load.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-transform flex items-center gap-2">
                        Start Learning Now
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                    <a href="{{ route('courses.index') }}" class="px-8 py-4 bg-surface-container-high text-on-surface font-semibold rounded-xl hover:bg-surface-container-highest transition-colors">
                        View Courses
                    </a>
                </div>
                <div class="flex items-center gap-4 pt-4">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full border-2 border-surface bg-surface-container flex items-center justify-center text-xs font-bold text-primary">A</div>
                        <div class="w-10 h-10 rounded-full border-2 border-surface bg-surface-container flex items-center justify-center text-xs font-bold text-tertiary">B</div>
                        <div class="w-10 h-10 rounded-full border-2 border-surface bg-surface-container flex items-center justify-center text-xs font-bold text-secondary">C</div>
                    </div>
                    <span class="text-sm font-medium text-on-surface-variant">Joined by 12,000+ modern scholars</span>
                </div>
            </div>
            
            <div class="relative">
                <div class="absolute -top-12 -left-12 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-12 -right-12 w-64 h-64 bg-tertiary/10 rounded-full blur-3xl"></div>
                <div class="glass-panel border border-outline-variant/15 rounded-2xl shadow-2xl overflow-hidden p-1">
                    <div class="bg-surface-container-lowest rounded-xl overflow-hidden border border-outline-variant/15">
                        <div class="p-6 border-b border-surface-container">
                            <div class="flex gap-2 mb-4">
                                <div class="w-3 h-3 rounded-full bg-error/40"></div>
                                <div class="w-3 h-3 rounded-full bg-tertiary/40"></div>
                                <div class="w-3 h-3 rounded-full bg-primary/40"></div>
                            </div>
                            <h3 class="text-xl font-bold">The Philosophy of Logic</h3>
                            <p class="text-xs text-on-surface-variant uppercase tracking-widest font-bold mt-1">Lesson 04: Aristotelian Structures</p>
                        </div>
                        <div class="p-8 space-y-6">
                            <div class="space-y-2">
                                <div class="h-4 bg-surface-container w-3/4 rounded"></div>
                                <div class="h-4 bg-surface-container w-full rounded"></div>
                                <div class="h-4 bg-surface-container w-5/6 rounded"></div>
                            </div>
                            <div class="py-4 px-6 bg-surface-container-low rounded-xl border-l-4 border-primary">
                                <p class="italic text-on-surface-variant">"Logic is the beginning of wisdom, not the end."</p>
                            </div>
                            <div class="space-y-2">
                                <div class="h-4 bg-surface-container w-full rounded"></div>
                                <div class="h-4 bg-surface-container w-2/3 rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Grid -->
<section class="py-24 bg-surface">
    <div class="max-w-7xl mx-auto px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl font-bold tracking-tight mb-4">Designed for the Intellectual Mind</h2>
            <p class="text-on-surface-variant">We removed the bloat and kept the soul of education. A system built for retention, not just consumption.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <!-- Rich Editor Card -->
            <div class="md:col-span-8 bg-surface-container-low rounded-2xl p-8 flex flex-col justify-between overflow-hidden relative group">
                <div class="max-w-md relative z-10">
                    <span class="material-symbols-outlined text-primary text-4xl mb-4">edit_note</span>
                    <h3 class="text-2xl font-bold mb-3">Distraction-Free Editor</h3>
                    <p class="text-on-surface-variant mb-6">Our text editor is tuned for scholarly writing. Markdown support, beautiful typography, and integrated references.</p>
                    <button class="text-primary font-bold flex items-center gap-2 hover:gap-3 transition-all">
                        Explore the Editor <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
                <!-- Mock UI Decor -->
                <div class="absolute bottom-0 right-0 w-3/4 h-1/2 bg-white rounded-tl-2xl shadow-2xl border-t border-l border-outline-variant/15 p-4 translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                    <div class="flex items-center gap-2 border-b border-surface-container pb-2 mb-4">
                        <span class="w-2 h-2 rounded-full bg-primary"></span>
                        <div class="h-2 w-24 bg-surface-container rounded"></div>
                    </div>
                    <div class="space-y-2">
                        <div class="h-2 w-full bg-surface-container rounded"></div>
                        <div class="h-2 w-5/6 bg-surface-container rounded"></div>
                    </div>
                </div>
            </div>
            <!-- Performance Card -->
            <div class="md:col-span-4 bg-primary text-on-primary rounded-2xl p-8 flex flex-col justify-between">
                <div class="space-y-4">
                    <span class="material-symbols-outlined text-4xl">bolt</span>
                    <h3 class="text-2xl font-bold">Lightning Performance</h3>
                    <p class="opacity-80 leading-relaxed">Pages load in under 100ms. No waiting for video buffers or heavy scripts. Pure speed for pure thought.</p>
                </div>
                <div class="mt-8 flex items-baseline gap-1">
                    <span class="text-4xl font-extrabold">99</span>
                    <span class="text-xl font-medium opacity-80">Lighthouse Score</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Courses -->
<section class="py-24 bg-surface-container-low/30">
    <div class="max-w-7xl mx-auto px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="max-w-xl">
                <h2 class="text-3xl font-bold tracking-tight mb-4">The Current Curriculum</h2>
                <p class="text-on-surface-variant">Hand-picked editorial courses designed for intellectual stamina and focus.</p>
            </div>
            <a href="{{ route('courses.index') }}" class="text-primary font-bold flex items-center gap-2 hover:gap-3 transition-all border-b border-primary/20 pb-1">
                Explore Full Library <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredCourses as $course)
                <div class="bg-surface-container-lowest border border-outline-variant/10 rounded-2xl overflow-hidden group hover:shadow-2xl hover:shadow-primary/5 transition-all">
                    <div class="h-48 bg-surface-container-high relative">
                        @if($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-primary/5 text-primary">
                                <span class="material-symbols-outlined text-6xl opacity-20">auto_stories</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <a href="{{ route('courses.show', $course->slug) }}" class="px-6 py-2 bg-white text-on-surface text-xs font-bold uppercase rounded-full shadow-xl">View Syllabus</a>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-bold text-primary-container bg-primary/10 px-2 py-0.5 rounded tracking-widest uppercase">Editorial</span>
                            <span class="text-sm font-bold text-primary">${{ number_format($course->price, 0) }}</span>
                        </div>
                        <h4 class="text-xl font-bold mb-3 h-14 line-clamp-2 h-14">{{ $course->title }}</h4>
                        <p class="text-sm text-on-surface-variant mb-6 flex items-center gap-2">
                             <div class="w-6 h-6 rounded-full bg-secondary/10 flex items-center justify-center text-secondary text-[10px] font-bold">
                                {{ substr($course->instructor->name, 0, 1) }}
                            </div>
                            By {{ $course->instructor->name }}
                        </p>
                        <a href="{{ route('courses.show', $course->slug) }}" class="w-full py-4 border border-outline-variant/30 text-on-surface-variant text-sm font-bold rounded-xl hover:bg-surface-container-high hover:text-on-surface transition-all flex items-center justify-center gap-2">
                            Take a Closer Look
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-24 text-center">
                    <p class="text-on-surface-variant italic">New wisdom is currently being forged. Check back soon.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 bg-surface text-center px-8">
    <div class="max-w-3xl mx-auto py-16 px-8 rounded-3xl bg-inverse-surface text-inverse-on-surface relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/20 rounded-full blur-3xl -mr-32 -mt-32"></div>
        <div class="relative z-10">
            <h2 class="text-3xl md:text-5xl font-bold tracking-tight mb-6 leading-tight">Ready to reclaim your <br/>focus and learn deeper?</h2>
            <p class="text-lg opacity-80 mb-10 max-w-xl mx-auto">Join the hundreds of creators and scholars who switched to the Sanctuary. Your cognitive health will thank you.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-10 py-4 bg-primary text-on-primary font-bold rounded-xl hover:bg-primary-container transition-colors">Join the Sanctuary</a>
                <a href="{{ route('courses.index') }}" class="px-10 py-4 border border-outline-variant/30 text-inverse-on-surface font-bold rounded-xl hover:bg-white/10 transition-colors">Explore Catalog</a>
            </div>
        </div>
    </div>
</section>
@endsection
