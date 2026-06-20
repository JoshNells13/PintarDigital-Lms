@extends('layouts.main')

@section('title', 'Alur Belajar Pemrograman | PintarDigital')

@section('content')
    <section class="py-24 bg-surface z-30">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-xs font-bold text-primary uppercase tracking-widest mb-2 block">Rekomendasi Belajar</span>
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-on-surface mb-6">Pilih Tujuan Karir
                    <br /><span class="text-primary">IT & Programming Anda.</span>
                </h1>
                <p class="text-on-surface-variant text-base leading-relaxed">
                    Kami menyusun kurikulum kelas secara bertahap agar Anda dapat menguasai teknologi industri secara
                    efektif dari nol hingga menjadi profesional.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Web Developer Path -->
                <div
                    class="bg-surface-container border-outline-variant/10 rounded-3xl p-8 hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-2xl font-bold">html</span>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-on-surface">Web Developer Path</h2>
                                <p class="text-xs font-semibold text-primary uppercase tracking-wider mt-0.5">Frontend &
                                    Backend Web</p>
                            </div>
                        </div>

                        <p class="text-on-surface-variant text-sm leading-relaxed mb-8">
                            Pelajari cara membangun website modern yang interaktif, dinamis, aman, serta memiliki performa
                            tinggi untuk kebutuhan bisnis.
                        </p>

                        <!-- Steps -->
                        <div class="space-y-6">
                            <!-- Step 1 -->
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary text-xs font-bold shrink-0 mt-0.5">
                                    1</div>
                                <div>
                                    <h4 class="font-bold text-sm text-on-surface">Dasar Pemrograman</h4>
                                    <p class="text-xs text-on-surface-variant mt-0.5 mb-2">Pelajari logika dasar pemrograman
                                        dan sintaks dasar sebelum membuat web.</p>
                                    <a href="{{ route('courses.show', 'dasar-pemrograman-python-untuk-pemula') }}"
                                        class="inline-flex items-center gap-1 text-xs text-primary font-bold hover:underline">
                                        Mulai Kelas Dasar Python <span
                                            class="material-symbols-outlined text-xs">chevron_right</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary text-xs font-bold shrink-0 mt-0.5">
                                    2</div>
                                <div>
                                    <h4 class="font-bold text-sm text-on-surface">Backend Framework (Laravel)</h4>
                                    <p class="text-xs text-on-surface-variant mt-0.5 mb-2">Gunakan Laravel 11 untuk membuat
                                        web dinamis dengan pengelolaan database yang canggih.</p>
                                    <a href="{{ route('courses.show', 'membangun-web-dinamis-dengan-laravel-11') }}"
                                        class="inline-flex items-center gap-1 text-xs text-primary font-bold hover:underline">
                                        Mulai Kelas Laravel 11 <span
                                            class="material-symbols-outlined text-xs">chevron_right</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-outline-variant/10 pt-6 mt-8">
                        <span class="text-xs font-bold text-on-surface-variant/60 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">schedule</span> Estimasi Waktu Belajar: 2-3
                            Bulan
                        </span>
                    </div>
                </div>

                <!-- Android Developer Path -->
                <div
                    class="bg-surface-container border border-outline-variant/10 rounded-3xl p-8 hover:shadow-2xl hover:shadow-primary/5 transition-all duration-500 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-2xl font-bold">phone_android</span>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-on-surface">Android Developer Path</h2>
                                <p class="text-xs font-semibold text-primary uppercase tracking-wider mt-0.5">Aplikasi
                                    Mobile Lintas Platform</p>
                            </div>
                        </div>

                        <p class="text-on-surface-variant text-sm leading-relaxed mb-8">
                            Kembangkan aplikasi mobile berskala besar untuk Android dan iOS menggunakan satu basis kode yang
                            efisien.
                        </p>

                        <!-- Steps -->
                        <div class="space-y-6">
                            <!-- Step 1 -->
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary text-xs font-bold shrink-0 mt-0.5">
                                    1</div>
                                <div>
                                    <h4 class="font-bold text-sm text-on-surface">Dasar Logika</h4>
                                    <p class="text-xs text-on-surface-variant mt-0.5 mb-2">Pahami alur kontrol dan
                                        penyelesaian masalah dasar.</p>
                                    <a href="{{ route('courses.show', 'dasar-pemrograman-python-untuk-pemula') }}"
                                        class="inline-flex items-center gap-1 text-xs text-primary font-bold hover:underline">
                                        Kelas Dasar Python <span
                                            class="material-symbols-outlined text-xs">chevron_right</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center text-primary text-xs font-bold shrink-0 mt-0.5">
                                    2</div>
                                <div>
                                    <h4 class="font-bold text-sm text-on-surface">Mobile Framework (Flutter)</h4>
                                    <p class="text-xs text-on-surface-variant mt-0.5 mb-2">Pelajari SDK Flutter dan bahasa
                                        Dart untuk membuat aplikasi Android yang dinamis.</p>
                                    <a href="{{ route('courses.show', 'pembuatan-aplikasi-mobile-dengan-flutter') }}"
                                        class="inline-flex items-center gap-1 text-xs text-primary font-bold hover:underline">
                                        Mulai Kelas Flutter <span
                                            class="material-symbols-outlined text-xs">chevron_right</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-outline-variant/10 pt-6 mt-8">
                        <span class="text-xs font-bold text-on-surface-variant/60 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">schedule</span> Estimasi Waktu Belajar: 2 Bulan
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
