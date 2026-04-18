@extends('layouts.main')

@section('title', 'Learning Catalog | Sanctuary Learning')

@section('content')
<section class="py-24 bg-surface">
    <div class="max-w-7xl mx-auto px-8">
        <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-16">
            <div class="max-w-2xl">
                <span class="text-xs font-bold text-primary uppercase tracking-widest mb-2 block">The Catalog</span>
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-on-surface">Expand your <br/><span class="text-primary">Intellectual Horizon.</span></h1>
            </div>
            <p class="text-on-surface-variant max-w-sm text-sm leading-relaxed">
                Curated courses from industry masters, designed for deep focus and long-term retention.
            </p>
        </div>

        @if($courses->isEmpty())
            <div class="bg-surface-container-low p-24 rounded-3xl text-center border-2 border-dashed border-outline-variant/20 italic text-on-surface-variant">
                The sanctuary is currently being curated. Check back soon for new wisdom.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($courses as $course)
                    <div class="group bg-surface-container-lowest border border-outline-variant/10 rounded-2xl overflow-hidden hover:shadow-2xl hover:shadow-primary/5 hover:-translate-y-1 transition-all duration-500">
                        <div class="aspect-video bg-surface-container relative overflow-hidden">
                            @if($course->thumbnail)
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-primary/5">
                                    <span class="material-symbols-outlined text-5xl text-primary/20">auto_stories</span>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-surface-container-lowest/80 backdrop-blur-md text-[10px] font-bold uppercase tracking-widest rounded-full">Editorial Choice</span>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-6 h-6 rounded-full bg-secondary-container flex items-center justify-center text-[10px] text-on-secondary-container font-bold">
                                    {{ substr($course->instructor->name, 0, 1) }}
                                </div>
                                <span class="text-xs font-medium text-on-surface-variant">{{ $course->instructor->name }}</span>
                            </div>
                            <h3 class="text-xl font-bold mb-4 line-clamp-2">{{ $course->title }}</h3>
                            <div class="flex justify-between items-center pt-6 border-t border-outline-variant/5">
                                <div class="flex items-baseline gap-1">
                                    <span class="text-2xl font-black">${{ number_format($course->price, 0) }}</span>
                                    <span class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">USD</span>
                                </div>
                                <a href="{{ route('courses.show', $course->slug) }}" class="p-3 bg-primary text-on-primary rounded-xl hover:bg-primary-container transition-colors">
                                    <span class="material-symbols-outlined">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
