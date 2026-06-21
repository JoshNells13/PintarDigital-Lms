@extends('layouts.dashboard')

@section('title', 'Kelas Saya | Sanctuary Instruktur')
@section('header', 'Pusat Pembelajaran Anda')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold tracking-tight">Kelola Kelas Anda</h2>
        <a href="{{ route('instructor.courses.create') }}" class="px-5 py-2.5 bg-primary text-on-primary text-xs font-bold uppercase rounded-xl hover:bg-primary-container transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-sm font-bold">add</span>
            Kelas Baru
        </a>
    </div>

    @if($courses->isEmpty())
        <div class="bg-surface-container-low p-16 rounded-3xl text-center border-2 border-dashed border-outline-variant/10">
            <span class="material-symbols-outlined text-5xl text-on-surface-variant/20 mb-4 font-light">auto_stories</span>
            <p class="text-on-surface-variant font-medium text-lg">Pustaka Anda saat ini kosong.</p>
            <p class="text-xs text-on-surface-variant/60 mb-8 max-w-xs mx-auto">Mulailah berbagi pengetahuan dengan membuat kelas pertama Anda.</p>
            <a href="{{ route('instructor.courses.create') }}" class="text-primary font-bold hover:underline">Buat Kelas Sekarang</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="bg-surface-container-lowest border border-outline-variant/10 rounded-2xl overflow-hidden group hover:shadow-xl hover:shadow-primary/5 transition-all">
                    <div class="h-40 bg-surface-container-high relative">
                        @if($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-primary/5 text-primary text-4xl">
                                <span class="material-symbols-outlined text-5xl opacity-20">auto_stories</span>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            @if($course->is_approved)
                                <span class="px-2 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase rounded-md backdrop-blur-md">Aktif</span>
                            @else
                                <span class="px-2 py-1 bg-tertiary/10 text-tertiary text-[10px] font-bold uppercase rounded-md backdrop-blur-md">Draf</span>
                            @endif
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="font-bold text-lg mb-2 line-clamp-1 h-7">{{ $course->title }}</h4>
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-xs text-on-surface-variant flex items-center gap-1 font-medium">
                                <span class="material-symbols-outlined text-sm font-light">group</span>
                                {{ $course->students_count }} Siswa
                            </span>
                            <span class="text-xs font-bold text-primary">${{ number_format($course->price, 0) }}</span>
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('instructor.courses.edit', $course->id) }}" class="flex-1 py-2.5 bg-surface-container-high text-on-surface text-[10px] font-bold uppercase rounded-xl hover:bg-surface-container-highest transition-colors flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm font-bold">edit_note</span>
                                Edit
                            </a>
                            <form action="{{ route('instructor.courses.destroy', $course->id) }}" method="POST" class="inline" onsubmit="return confirm('Pastikan semua data telah dicadangkan. Menghapus bersifat permanen. Lanjutkan?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 text-on-surface-variant hover:text-error hover:bg-error/5 rounded-xl transition-all">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
