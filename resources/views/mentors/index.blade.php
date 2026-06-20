@extends('layouts.main')

@section('title', 'Mentor Kami | PintarDigital')

@section('content')
    <section class="py-24 ">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-xs font-bold text-primary uppercase tracking-widest mb-2 block">Daftar Mentor</span>
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-on-surface mb-6">Belajar Langsung dari
                    <br /><span class="text-primary">Para Praktisi IT Ahli.</span>
                </h1>
                <p class="text-on-surface-variant text-base leading-relaxed">
                    Mentor kami adalah para software engineer dan edukator berpengalaman yang siap membimbing Anda menguasai
                    keahlian coding secara mendalam.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                @foreach ($mentors as $mentor)
                    <div
                        class="bg-surface-container border-outline-variant/10 rounded-3xl p-8 hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 flex flex-col justify-between">
                        <div>
                            <!-- Mentor Info Header -->
                            <div class="flex items-center gap-6 mb-6">
                                @if ($mentor->avatar)
                                    <img src="{{ asset('storage/' . $mentor->avatar) }}"
                                        class="w-16 h-16 rounded-full object-cover">
                                @else
                                    <div
                                        class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center text-primary text-xl font-bold">
                                        {{ substr($mentor->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h3 class="text-2xl font-bold text-on-surface">{{ $mentor->name }}</h3>
                                    <p class="text-xs font-semibold text-primary uppercase tracking-wider mt-0.5">Mentor
                                        Pemrograman</p>
                                </div>
                            </div>

                            <!-- Bio -->
                            <p class="text-on-surface-variant text-sm leading-relaxed mb-8">
                                {{ $mentor->bio ?? 'Seorang profesional IT yang berdedikasi tinggi untuk membagikan ilmu pemrograman dan membantu pengembangan karir para calon developer.' }}
                            </p>
                        </div>

                        <!-- Courses list by Mentor -->
                        <div class="border-t border-outline-variant/10 pt-6">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-on-surface mb-4">Kelas yang Diajar
                                ({{ $mentor->courses_count }}):</h4>
                            @if ($mentor->courses->isEmpty())
                                <p class="text-xs italic text-on-surface-variant">Saat ini sedang menyiapkan kurikulum kelas
                                    baru.</p>
                            @else
                                <ul class="space-y-3">
                                    @foreach ($mentor->courses as $course)
                                        @if ($course->is_approved)
                                            <li
                                                class="flex items-center justify-between text-sm p-3 bg-surface-container hover:bg-black transition-colors rounded-xl border border-outline-variant/5">
                                                <span
                                                    class="font-semibold text-on-surface truncate pr-4">{{ $course->title }}</span>
                                                <a href="{{ route('courses.show', $course->slug) }}"
                                                    class="text-xs font-bold text-primary hover:underline flex items-center shrink-0">
                                                    Lihat Kelas
                                                    <span class="material-symbols-outlined text-xs">chevron_right</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
