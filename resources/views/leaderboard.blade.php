@extends('layouts.main')

@section('title', 'Papan Peringkat Siswa | PintarDigital')

@section('content')
    <section class="py-24 ">
        <div class="max-w-4xl mx-auto px-8">
            <div class="text-center mb-16">
                <span class="text-xs font-bold text-primary uppercase tracking-widest mb-2 block">Peringkat Global</span>
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-on-surface mb-6">Papan Peringkat
                    <br /><span class="text-primary">Siswa PintarDigital.</span></h1>
                <p class="text-on-surface-variant text-base leading-relaxed">
                    Tantang diri Anda dan lihat peringkat Anda dibandingkan dengan rekan belajar lainnya berdasarkan jumlah
                    kelas dan bab yang Anda selesaikan.
                </p>
            </div>

            <div
                class="bg-surface-container-lowest border border-outline-variant/10 rounded-3xl overflow-hidden shadow-2xl shadow-primary/5">
                <div
                    class="p-6 bg-surface-container/30 border-b border-outline-variant/10 flex justify-between items-center">
                    <h3 class="font-bold text-lg text-on-surface">Top Siswa Teraktif</h3>
                    <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full">10 Poin per
                        Sub-bab</span>
                </div>

                <div class="divide-y divide-outline-variant/10">
                    @forelse($students as $student)
                        @php
                            $rank = $loop->iteration;
                        @endphp
                        <div class="flex items-center justify-between p-6 hover:bg-surface-container/20 transition-colors">
                            <div class="flex items-center gap-6">
                                <!-- Rank Number / Badge -->
                                <div class="w-10 h-10 flex items-center justify-center shrink-0">
                                    @if ($rank === 1)
                                        <span class="text-3xl">🥇</span>
                                    @elseif($rank === 2)
                                        <span class="text-3xl">🥈</span>
                                    @elseif($rank === 3)
                                        <span class="text-3xl">🥉</span>
                                    @else
                                        <span
                                            class="text-base font-extrabold text-on-surface-variant/50">#{{ $rank }}</span>
                                    @endif
                                </div>

                                <!-- Avatar -->
                                <div
                                    class="w-12 h-12 rounded-2xl bg-secondary-container flex items-center justify-center text-on-secondary-container font-black text-base shrink-0">
                                    {{ substr($student->name, 0, 1) }}
                                </div>

                                <!-- User details -->
                                <div>
                                    <h4 class="font-extrabold text-on-surface text-base leading-tight mb-1">
                                        {{ $student->name }}</h4>
                                    <p class="text-xs text-on-surface-variant/80">
                                        {{ $student->bio ?? 'Siswa PintarDigital' }}</p>
                                </div>
                            </div>

                            <!-- Stats/Score -->
                            <div class="flex items-center gap-8 text-right">
                                <div class="hidden sm:block">
                                    <span
                                        class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest block mb-0.5">Kelas
                                        Selesai</span>
                                    <span class="font-extrabold text-on-surface">{{ $student->completed_courses_count }}
                                        Kelas</span>
                                </div>
                                <div>
                                    <span
                                        class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest block mb-0.5">Total
                                        Skor</span>
                                    <span class="font-black text-primary text-lg">{{ number_format($student->points) }}
                                        Poin</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-on-surface-variant/40 italic">
                            Belum ada siswa di papan peringkat.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
