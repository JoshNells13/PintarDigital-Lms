@extends('layouts.dashboard')

@section('title', 'Pembelajaran Saya | PintarDigital')
@section('header', 'Selamat datang kembali, ' . auth()->user()->name)

@section('content')
<div class="space-y-8">
    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-surface-container-low p-6 rounded-2xl">
            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Kelas Diikuti</p>
            <p class="text-3xl font-extrabold">{{ $enrolledCourses->count() }}</p>
        </div>
        <div class="bg-surface-container-low p-6 rounded-2xl">
            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Sedang Dipelajari</p>
            <p class="text-3xl font-extrabold">{{ $enrolledCourses->where('progress_percentage', '>', 0)->where('progress_percentage', '<', 100)->count() }}</p>
        </div>
        <div class="bg-surface-container-low p-6 rounded-2xl">
            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Selesai</p>
            <p class="text-3xl font-extrabold">{{ $enrolledCourses->where('progress_percentage', 100)->count() }}</p>
        </div>
    </div>

    <!-- Course List -->
    <div>
        <h3 class="text-xl font-bold tracking-tight mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">auto_stories</span>
            Lanjutkan Belajar
        </h3>
        
        @if($enrolledCourses->isEmpty())
            <div class="bg-surface-container-lowest border border-outline-variant/10 rounded-2xl p-12 text-center">
                <div class="w-16 h-16 bg-surface-container-low rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-3xl text-on-surface-variant">auto_stories</span>
                </div>
                <h4 class="text-lg font-bold mb-2">Belum ada kelas terdaftar</h4>
                <p class="text-on-surface-variant mb-6 max-w-sm mx-auto">Eksplorasi katalog kelas pemrograman kami dan mulai perjalanan belajar Anda di PintarDigital.</p>
                <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-on-primary font-bold rounded-xl hover:bg-primary-container transition-colors">
                    Telusuri Katalog
                    <span class="material-symbols-outlined text-sm">explore</span>
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($enrolledCourses as $course)
                    <div class="bg-surface-container-lowest border border-outline-variant/10 rounded-2xl overflow-hidden group hover:shadow-xl hover:shadow-primary/5 transition-all">
                        <div class="h-40 bg-surface-container-high relative">
                            @if($course->thumbnail)
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-primary/5 text-primary">
                                    <span class="material-symbols-outlined text-5xl opacity-20">code</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-on-surface/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <div class="p-6">
                            <h4 class="font-bold text-lg mb-2 line-clamp-1 text-on-surface group-hover:text-primary transition-colors">{{ $course->title }}</h4>
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-sm text-on-surface-variant flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">person</span>
                                    {{ $course->instructor->name }}
                                </p>
                                <span class="text-[10px] font-bold text-primary uppercase tracking-widest">{{ $course->progress_percentage }}% Selesai</span>
                            </div>
                            <div class="w-full bg-surface-container h-1.5 rounded-full mb-6 overflow-hidden">
                                <div class="bg-primary h-full transition-all duration-1000" style="width: {{ $course->progress_percentage }}%"></div>
                            </div>
                            
                            @if($course->progress_percentage == 100)
                                <a href="{{ route('courses.certificate', $course->id) }}" class="w-full py-3 bg-amber-500 text-white text-sm font-bold rounded-xl hover:bg-amber-600 transition-all flex items-center justify-center gap-2">
                                    Lihat Sertifikat
                                    <span class="material-symbols-outlined text-sm">workspace_premium</span>
                                </a>
                            @else
                                <a href="{{ route('student.learning', $course->slug) }}" class="w-full py-3 bg-surface-container-high text-on-surface text-sm font-bold rounded-xl hover:bg-primary hover:text-on-primary transition-all flex items-center justify-center gap-2">
                                    {{ $course->progress_percentage > 0 ? 'Lanjutkan Belajar' : 'Mulai Belajar' }}
                                    <span class="material-symbols-outlined text-sm">play_arrow</span>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
