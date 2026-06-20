@extends('layouts.main')

@section('title', 'Katalog Kelas Coding | PintarDigital')

@section('content')
    <section class="py-24 bg-surface">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-12">
                <div class="max-w-2xl">
                    <span class="text-xs font-bold text-primary uppercase tracking-widest mb-2 block">Katalog
                        Pembelajaran</span>
                    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-on-surface">Perluas Cakrawala
                        <br /><span class="text-primary">Pengetahuan IT Anda.</span>
                    </h1>
                </div>
                <p class="text-on-surface-variant max-w-sm text-sm leading-relaxed">
                    Kursus coding terkurasi oleh para mentor profesional, dirancang khusus untuk meningkatkan keterampilan
                    dan pemahaman logis Anda.
                </p>
            </div>

            <!-- Category Filters -->
            <div class="flex flex-wrap gap-3 mb-12 border-b border-outline-variant/10 pb-6">
                <a href="{{ route('courses.index') }}"
                    class="px-5 py-2 text-sm font-semibold rounded-full transition-all {{ !$categorySlug ? 'bg-primary text-on-primary shadow-md' : 'bg-surface-container hover:bg-surface-container-high text-on-surface-variant' }}">
                    Semua Kelas
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('courses.index', ['category' => $cat->slug]) }}"
                        class="px-5 py-2 text-sm font-semibold rounded-full transition-all {{ $categorySlug === $cat->slug ? 'bg-primary text-on-primary shadow-md' : 'bg-surface-container hover:bg-surface-container-high text-on-surface-variant' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            @if ($courses->isEmpty())
                <div
                    class="bg-surface-container-low p-24 rounded-3xl text-center border-2 border-dashed border-outline-variant/20 italic text-on-surface-variant">
                    Belum ada kelas yang dirilis untuk kategori ini. Cek kembali nanti.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($courses as $course)
                        <div
                            class="group bg-surface-container-lowest border border-outline-variant/10 rounded-2xl overflow-hidden hover:shadow-2xl hover:shadow-primary/5 hover:-translate-y-1 transition-all duration-500 flex flex-col justify-between">
                            <div>
                                <div class="aspect-video bg-surface-container relative overflow-hidden">
                                    @if ($course->thumbnail)
                                        <img src="{{ asset('storage/' . $course->thumbnail) }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-primary/5 text-primary">
                                            <span class="material-symbols-outlined text-5xl text-primary/20">code</span>
                                        </div>
                                    @endif
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="px-3 py-1 bg-surface-container-lowest/80 backdrop-blur-md text-[10px] font-bold uppercase tracking-widest rounded-full">
                                            {{ $course->category ? $course->category->name : 'IT Pemrograman' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-8">
                                    <div class="flex items-center gap-2 mb-4">
                                        <div
                                            class="w-6 h-6 rounded-full bg-secondary-container flex items-center justify-center text-[10px] text-on-secondary-container font-bold">
                                            {{ substr($course->instructor->name, 0, 1) }}
                                        </div>
                                        <span
                                            class="text-xs font-medium text-on-surface-variant">{{ $course->instructor->name }}</span>
                                    </div>
                                    <h3 class="text-xl font-bold mb-4 line-clamp-2">{{ $course->title }}</h3>

                                    <!-- Rating, Like, & Completion Indicators -->
                                    <div class="flex items-center gap-4 mb-4 text-xs text-on-surface-variant font-medium">
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs text-primary fill-1"
                                                style="font-variation-settings: 'FILL' 1;">star</span>
                                            {{ $course->averageRating() ? $course->averageRating() : '0' }}
                                            ({{ $course->comments()->whereNotNull('rating')->count() }})
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs text-error fill-1"
                                                style="font-variation-settings: 'FILL' 1;">favorite</span>
                                            {{ $course->likes()->count() }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs text-amber-500 fill-1"
                                                style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                                            {{ $course->enrollments()->whereNotNull('completed_at')->count() }} lulusan
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-8 pb-8">
                                <div class="flex justify-between items-center pt-6 border-t border-outline-variant/5">
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-2xl font-black">
                                            {{ $course->price == 0 ? 'Gratis' : 'Rp ' . number_format($course->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    @auth
                                        @if (auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists())
                                            <a href="{{ route('student.learning', $course->slug) }}"
                                                class="px-5 py-2.5 bg-green-600 text-white text-xs font-bold rounded-xl hover:bg-green-700 transition-all flex items-center gap-1.5 shadow-md shadow-green-600/10">
                                                Lanjutkan Belajar
                                                <span class="material-symbols-outlined text-sm">play_arrow</span>
                                            </a>
                                        @else
                                            <a href="{{ route('courses.show', $course->slug) }}"
                                                class="px-5 py-2.5 bg-primary text-on-primary text-xs font-bold rounded-xl hover:bg-primary-container hover:text-white transition-all flex items-center gap-1.5">
                                                Lihat Detail
                                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('courses.show', $course->slug) }}"
                                            class="px-5 py-2.5 bg-primary text-on-primary text-xs font-bold rounded-xl hover:bg-primary-container hover:text-white transition-all  flex items-center gap-1.5">
                                            Lihat Detail
                                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
