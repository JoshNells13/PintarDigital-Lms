@extends('layouts.main')

@section('title', $course->title . ' | Sanctuary Learning')

@section('content')
<section class="hero-gradient pt-32 pb-24 px-8 overflow-hidden relative">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
        <div class="space-y-8 relative z-10">
            <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-primary uppercase tracking-widest hover:gap-3 transition-all">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Back to Catalog
            </a>
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-on-surface leading-tight">
                {{ $course->title }}
            </h1>
            <p class="text-lg md:text-xl text-on-surface-variant leading-relaxed max-w-xl">
                {{ $course->description }}
            </p>
            
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                        {{ substr($course->instructor->name, 0, 1) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest leading-none mb-1">Expert Mentor</span>
                        <span class="text-sm font-bold text-on-surface">{{ $course->instructor->name }}</span>
                    </div>
                </div>
                <div class="h-8 w-px bg-outline-variant/30"></div>
                <div>
                     <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest leading-none mb-1 block">Rating</span>
                     <span class="text-sm font-bold text-on-surface flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm text-primary fill-1" style="font-variation-settings: 'FILL' 1;">star</span>
                        4.9 (120 reviews)
                     </span>
                </div>
            </div>
        </div>

        <div class="relative">
             <div class="bg-surface-container-lowest p-2 rounded-2xl shadow-2xl border border-outline-variant/15 relative z-10 overflow-hidden">
                <div class="aspect-video bg-surface-container rounded-xl overflow-hidden relative">
                    @if($course->thumbnail)
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-primary/5">
                            <span class="material-symbols-outlined text-7xl text-primary/10">auto_stories</span>
                        </div>
                    @endif
                </div>
                <div class="p-8">
                    <div class="flex justify-between items-baseline mb-8">
                        <div class="flex items-baseline gap-2">
                             <span class="text-4xl font-black">${{ number_format($course->price, 0) }}</span>
                             <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Lifetime Access</span>
                        </div>
                        <span class="px-2 py-1 bg-tertiary-container/10 text-tertiary text-[10px] font-bold uppercase rounded-md">Selling Fast</span>
                    </div>
                    
                    @auth
                        @if(auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists())
                            <a href="{{ route('student.learning', $course->slug) }}" class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-transform flex items-center justify-center gap-2">
                                Resume Learning
                                <span class="material-symbols-outlined">play_arrow</span>
                            </a>
                        @else
                            <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-transform flex items-center justify-center gap-2">
                                    Enroll in Course
                                    <span class="material-symbols-outlined">payments</span>
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-transform flex items-center justify-center gap-2">
                            Sign in to Enroll
                            <span class="material-symbols-outlined">login</span>
                        </a>
                    @endauth
                    
                    <ul class="mt-8 space-y-4">
                        <li class="flex items-center gap-3 text-sm text-on-surface-variant">
                             <span class="material-symbols-outlined text-primary text-lg">check_circle</span>
                             Full curriculum access
                        </li>
                        <li class="flex items-center gap-3 text-sm text-on-surface-variant">
                             <span class="material-symbols-outlined text-primary text-lg">check_circle</span>
                             Direct mentor feedback
                        </li>
                    </ul>
                </div>
             </div>
        </div>
    </div>
</section>

<section class="py-24 bg-surface px-8">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-3 gap-16">
        <div class="lg:col-span-2 space-y-12">
            <div>
                <h3 class="text-3xl font-extrabold tracking-tight mb-8">Curriculum Breakdown</h3>
                <div class="space-y-4">
                    @forelse($course->chapters as $chapter)
                        <div class="bg-surface-container-low rounded-2xl overflow-hidden border border-outline-variant/10">
                            <div class="p-6 bg-surface-container/30 flex justify-between items-center cursor-pointer">
                                <div class="flex items-center gap-4">
                                     <span class="text-xs font-bold text-primary tracking-widest uppercase">Chapter {{ $loop->iteration }}</span>
                                     <h4 class="font-bold text-on-surface">{{ $chapter->title }}</h4>
                                </div>
                                <span class="text-xs font-medium text-on-surface-variant">{{ $chapter->subChapters->count() }} lessons</span>
                            </div>
                            <div class="px-6 pb-6">
                                <ul class="space-y-3">
                                    @foreach($chapter->subChapters as $sub)
                                        <li class="flex items-center gap-3 text-sm p-3 hover:bg-surface-container-lowest rounded-xl transition-colors">
                                             <span class="material-symbols-outlined text-on-surface-variant text-[20px]">description</span>
                                             <span class="font-medium">{{ $sub->title }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @empty
                        <p class="text-on-surface-variant italic">Curriculum is currently being finalized.</p>
                    @endforelse
                </div>
            </div>
        </div>
        
        <div class="space-y-8">
            <div class="bg-surface-container-low p-8 rounded-2xl border border-outline-variant/10">
                <h4 class="font-bold mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">verified_user</span>
                    The Sanctuary Promise
                </h4>
                <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                    Our courses are designed for deep work. We replace distracting UI with editorial elegance to help you retain every word.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                         <span class="material-symbols-outlined text-primary text-lg">bolt</span>
                         <div>
                            <p class="text-xs font-bold uppercase tracking-widest mb-1 text-on-surface">Speed-Optimized</p>
                            <p class="text-[10px] text-on-surface-variant">Zero bloat, instant loading.</p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
