@extends('layouts.main')

@section('title', 'Belajar Coding Lebih Fokus, Tanpa Distraksi | PintarDigital')

@section('content')
<style>
    @keyframes marquee {
        0% { transform: translateX(0%); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        display: flex;
        width: max-content;
        animation: marquee 20s linear infinite;
    }
</style>

<!-- Hero Section -->
<section class="hero-gradient relative overflow-hidden py-24 md:py-32">
    <div class="max-w-7xl mx-auto px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <div class="inline-flex items-center px-3 py-1 bg-secondary-container/30 text-on-secondary-container text-xs font-bold uppercase tracking-widest rounded-full">
                    ERA BARU BELAJAR CODING
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter leading-[1.1] text-on-surface">
                    Kuasai Coding, <br/>
                    <span class="text-primary">Tanpa Distraksi.</span>
                </h1>
                <p class="text-lg md:text-xl text-on-surface-variant font-body leading-relaxed max-w-xl">
                    PintarDigital adalah platform belajar IT dan pemrograman berbasis teks. Tanpa video bertele-tele—hanya konten editorial berkualitas tinggi yang menghargai waktu dan fokus kognitif Anda.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-transform flex items-center gap-2">
                        Mulai Belajar Sekarang
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                    <a href="{{ route('courses.index') }}" class="px-8 py-4 bg-surface-container-high text-on-surface font-semibold rounded-xl hover:bg-surface-container-highest transition-colors">
                        Lihat Katalog Kelas
                    </a>
                </div>
                <div class="flex items-center gap-4 pt-4">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full border-2 border-surface bg-surface-container flex items-center justify-center text-xs font-bold text-primary">A</div>
                        <div class="w-10 h-10 rounded-full border-2 border-surface bg-surface-container flex items-center justify-center text-xs font-bold text-tertiary">B</div>
                        <div class="w-10 h-10 rounded-full border-2 border-surface bg-surface-container flex items-center justify-center text-xs font-bold text-secondary">C</div>
                    </div>
                    <span class="text-sm font-medium text-on-surface-variant">Bergabung bersama 12.000+ calon developer profesional</span>
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
                            <h3 class="text-xl font-bold">Struktur Data & Algoritma</h3>
                            <p class="text-xs text-on-surface-variant uppercase tracking-widest font-bold mt-1">Pelajaran 02: Efisiensi Kompleksitas Waktu</p>
                        </div>
                        <div class="p-8 space-y-6">
                            <div class="space-y-2">
                                <div class="h-4 bg-surface-container w-3/4 rounded"></div>
                                <div class="h-4 bg-surface-container w-full rounded"></div>
                                <div class="h-4 bg-surface-container w-5/6 rounded"></div>
                            </div>
                            <div class="py-4 px-6 bg-surface-container-low rounded-xl border-l-4 border-primary">
                                <p class="italic text-on-surface-variant">"Kode yang baik bukan hanya kode yang berjalan, melainkan kode yang efisien dan mudah dibaca orang lain."</p>
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

<!-- Programming Languages Marquee -->
<div class="py-8 bg-surface-container-low border-y border-outline-variant/10 overflow-hidden relative w-full">
    <div class="absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-surface-container-low to-transparent z-10"></div>
    <div class="absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-surface-container-low to-transparent z-10"></div>
    <div class="animate-marquee flex">
        <div class="flex gap-16 pr-16 items-center">
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-html5-plain colored text-3xl"></i> HTML5</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-css3-plain colored text-3xl"></i> CSS3</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-javascript-plain colored text-3xl"></i> JAVASCRIPT</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-php-plain colored text-3xl"></i> PHP</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-laravel-original colored text-3xl"></i> LARAVEL</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-python-plain colored text-3xl"></i> PYTHON</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-kotlin-plain colored text-3xl"></i> KOTLIN</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-flutter-plain colored text-3xl"></i> FLUTTER</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-go-original-wordmark colored text-3xl"></i> GOLANG</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-rust-plain colored text-3xl"></i> RUST</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-mysql-plain colored text-3xl"></i> MYSQL</span>
        </div>
        <div class="flex gap-16 pr-16 items-center" aria-hidden="true">
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-html5-plain colored text-3xl"></i> HTML5</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-css3-plain colored text-3xl"></i> CSS3</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-javascript-plain colored text-3xl"></i> JAVASCRIPT</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-php-plain colored text-3xl"></i> PHP</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-laravel-original colored text-3xl"></i> LARAVEL</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-python-plain colored text-3xl"></i> PYTHON</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-kotlin-plain colored text-3xl"></i> KOTLIN</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-flutter-plain colored text-3xl"></i> FLUTTER</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-go-original-wordmark colored text-3xl"></i> GOLANG</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-rust-plain colored text-3xl"></i> RUST</span>
            <span class="text-xl font-extrabold text-slate-700/80 tracking-wider flex items-center gap-2"><i class="devicon-mysql-plain colored text-3xl"></i> MYSQL</span>
        </div>
    </div>
</div>

<!-- Features Grid -->
<section class="py-24 bg-surface">
    <div class="max-w-7xl mx-auto px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl font-bold tracking-tight mb-4">Didesain untuk Fokus Belajar Kode</h2>
            <p class="text-on-surface-variant">Kami menghilangkan semua gangguan visual dan mempertahankan esensi pendidikan. Sistem belajar yang dibangun untuk pemahaman mendalam jangka panjang.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <!-- Distraction-Free Card -->
            <div class="md:col-span-8 bg-surface-container-low rounded-2xl p-8 flex flex-col justify-between overflow-hidden relative group">
                <div class="max-w-md relative z-10">
                    <span class="material-symbols-outlined text-primary text-4xl mb-4">edit_note</span>
                    <h3 class="text-2xl font-bold mb-3">Editor Bebas Gangguan</h3>
                    <p class="text-on-surface-variant mb-6">Materi pembelajaran kami disajikan dalam format teks kaya gaya editorial, pendukung sintaks kode yang indah, serta referensi yang terintegrasi secara langsung.</p>
                    <a href="{{ route('courses.index') }}" class="text-primary font-bold flex items-center gap-2 hover:gap-3 transition-all">
                        Eksplorasi Kelas <span class="material-symbols-outlined">chevron_right</span>
                    </a>
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
                    <h3 class="text-2xl font-bold">Kinerja Secepat Kilat</h3>
                    <p class="opacity-80 leading-relaxed">Halaman memuat dalam waktu kurang dari 100md. Tanpa menunggu buffering video atau skrip yang berat. Kecepatan murni untuk pemikiran yang kritis.</p>
                </div>
                <div class="mt-8 flex items-baseline gap-1">
                    <span class="text-4xl font-extrabold">99</span>
                    <span class="text-xl font-medium opacity-80">Skor Lighthouse</span>
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
                <h2 class="text-3xl font-bold tracking-tight mb-4">Kurikulum Terkini</h2>
                <p class="text-on-surface-variant">Kelas coding pilihan yang dirancang untuk membangun pemahaman fundamental dan praktikal yang kuat.</p>
            </div>
            <a href="{{ route('courses.index') }}" class="text-primary font-bold flex items-center gap-2 hover:gap-3 transition-all border-b border-primary/20 pb-1">
                Jelajahi Semua Kelas <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredCourses as $course)
                <div class="bg-surface-container-lowest border border-outline-variant/10 rounded-2xl overflow-hidden group hover:shadow-2xl hover:shadow-primary/5 transition-all flex flex-col justify-between">
                    <div>
                        <div class="h-48 bg-surface-container-high relative">
                            @if($course->thumbnail)
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-primary/5 text-primary">
                                    <span class="material-symbols-outlined text-6xl opacity-20">code</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <a href="{{ route('courses.show', $course->slug) }}" class="px-6 py-2 bg-white text-on-surface text-xs font-bold uppercase rounded-full shadow-xl">Lihat Silabus</a>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[10px] font-bold text-primary-container bg-primary/10 px-2 py-0.5 rounded tracking-widest uppercase">
                                    {{ $course->category ? $course->category->name : 'IT Pemrograman' }}
                                </span>
                                <span class="text-sm font-bold text-primary">
                                    {{ $course->price == 0 ? 'Gratis' : 'Rp ' . number_format($course->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <h4 class="text-xl font-bold mb-3 h-14 line-clamp-2">{{ $course->title }}</h4>
                            
                            <!-- Rating & Graduates Stats -->
                            <div class="flex items-center gap-4 mb-4 text-xs text-on-surface-variant font-medium">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs text-primary fill-1" style="font-variation-settings: 'FILL' 1;">star</span>
                                    {{ $course->averageRating() ? $course->averageRating() : '0' }} ({{ $course->comments()->whereNotNull('rating')->count() }})
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs text-amber-500 fill-1" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                                    {{ $course->enrollments()->whereNotNull('completed_at')->count() }} lulusan
                                </span>
                            </div>

                            <div class="text-sm text-on-surface-variant mb-6 flex items-center gap-2">
                                 <div class="w-6 h-6 rounded-full bg-secondary/10 flex items-center justify-center text-secondary text-[10px] font-bold">
                                    {{ substr($course->instructor->name, 0, 1) }}
                                </div>
                                <span>Oleh {{ $course->instructor->name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="px-8 pb-8">
                        @auth
                            @if(auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists())
                                <a href="{{ route('student.learning', $course->slug) }}" class="w-full py-4 bg-primary text-on-primary text-sm font-bold rounded-xl hover:bg-primary-container transition-all flex items-center justify-center gap-2 shadow-lg shadow-primary/20">
                                    Lanjutkan Belajar
                                    <span class="material-symbols-outlined text-sm">play_arrow</span>
                                </a>
                            @else
                                <a href="{{ route('courses.show', $course->slug) }}" class="w-full py-4 border border-outline-variant/30 text-on-surface-variant text-sm font-bold rounded-xl hover:bg-surface-container-high hover:text-on-surface transition-all flex items-center justify-center gap-2">
                                    Pelajari Lebih Detail
                                </a>
                            @endif
                        @else
                            <a href="{{ route('courses.show', $course->slug) }}" class="w-full py-4 border border-outline-variant/30 text-on-surface-variant text-sm font-bold rounded-xl hover:bg-surface-container-high hover:text-on-surface transition-all flex items-center justify-center gap-2">
                                Pelajari Lebih Detail
                            </a>
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full py-24 text-center">
                    <p class="text-on-surface-variant italic">Kurikulum baru sedang dipersiapkan oleh para instruktur. Cek kembali dalam beberapa saat.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-24 bg-surface border-t border-outline-variant/10">
    <div class="max-w-4xl mx-auto px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-extrabold tracking-tight mb-4 text-on-surface">Pertanyaan yang Sering Diajukan (FAQ)</h2>
            <p class="text-on-surface-variant text-base">Mempunyai pertanyaan? Berikut beberapa jawaban untuk pertanyaan yang paling sering diajukan.</p>
        </div>
        
        <div class="space-y-4">
            <details class="group bg-surface-container-low border border-outline-variant/10 rounded-2xl p-6 [&_summary::-webkit-details-marker]:hidden transition-all duration-300">
                <summary class="flex justify-between items-center font-bold text-lg text-on-surface cursor-pointer select-none">
                    <span>Apakah PintarDigital fokus pada pemrograman (coding)?</span>
                    <span class="material-symbols-outlined transition-transform group-open:rotate-180 text-primary">expand_more</span>
                </summary>
                <p class="mt-4 text-on-surface-variant text-sm leading-relaxed">
                    Ya, PintarDigital adalah platform belajar yang 100% fokus pada IT Coding dan Pemrograman. Semua kurikulum kami dirancang untuk membantu Anda menguasai teknologi industri terkini seperti Web Development, Mobile Development (Android), dan Dasar-dasar Pemrograman secara mendalam.
                </p>
            </details>

            <details class="group bg-surface-container-low border border-outline-variant/10 rounded-2xl p-6 [&_summary::-webkit-details-marker]:hidden transition-all duration-300">
                <summary class="flex justify-between items-center font-bold text-lg text-on-surface cursor-pointer select-none">
                    <span>Bagaimana metode belajarnya?</span>
                    <span class="material-symbols-outlined transition-transform group-open:rotate-180 text-primary">expand_more</span>
                </summary>
                <p class="mt-4 text-on-surface-variant text-sm leading-relaxed">
                    PintarDigital menggunakan metode text-first yang fokus dan minim gangguan visual. Alih-alih menonton video berjam-jam, Anda membaca materi berkualitas tinggi dengan kode sintaksis interaktif serta kuis langsung untuk memvalidasi pemahaman Anda di setiap langkah.
                </p>
            </details>

            <details class="group bg-surface-container-low border border-outline-variant/10 rounded-2xl p-6 [&_summary::-webkit-details-marker]:hidden transition-all duration-300">
                <summary class="flex justify-between items-center font-bold text-lg text-on-surface cursor-pointer select-none">
                    <span>Apakah kelas-kelas ini cocok untuk pemula?</span>
                    <span class="material-symbols-outlined transition-transform group-open:rotate-180 text-primary">expand_more</span>
                </summary>
                <p class="mt-4 text-on-surface-variant text-sm leading-relaxed">
                    Tentu saja! Kami memiliki kategori "Bahasa Pemrograman Dasar" yang disusun khusus bagi pemula tanpa latar belakang IT untuk mempelajari konsep mendasar dengan bahasa yang santai dan mudah dimengerti.
                </p>
            </details>

            <details class="group bg-surface-container-low border border-outline-variant/10 rounded-2xl p-6 [&_summary::-webkit-details-marker]:hidden transition-all duration-300">
                <summary class="flex justify-between items-center font-bold text-lg text-on-surface cursor-pointer select-none">
                    <span>Bagaimana jika saya mengalami kesulitan atau memiliki pertanyaan?</span>
                    <span class="material-symbols-outlined transition-transform group-open:rotate-180 text-primary">expand_more</span>
                </summary>
                <p class="mt-4 text-on-surface-variant text-sm leading-relaxed">
                    Anda dapat menggunakan fitur diskusi ulasan dan komentar di setiap halaman kelas untuk berdiskusi dengan mentor dan sesama pelajar lainnya.
                </p>
            </details>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24 bg-surface text-center px-8">
    <div class="max-w-3xl mx-auto py-16 px-8 rounded-3xl bg-inverse-surface text-inverse-on-surface relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/20 rounded-full blur-3xl -mr-32 -mt-32"></div>
        <div class="relative z-10">
            <h2 class="text-3xl md:text-5xl font-bold tracking-tight mb-6 leading-tight">Siap untuk Mulai Belajar <br/>Coding Lebih Mendalam?</h2>
            <p class="text-lg opacity-80 mb-10 max-w-xl mx-auto">Bergabunglah dengan ribuan mahasiswa dan developer profesional yang telah mengoptimalkan produktivitas belajarnya di PintarDigital.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-10 py-4 bg-primary text-on-primary font-bold rounded-xl hover:bg-primary-container transition-colors">Daftar Sekarang</a>
                <a href="{{ route('courses.index') }}" class="px-10 py-4 border border-outline-variant/30 text-inverse-on-surface font-bold rounded-xl hover:bg-white/10 transition-colors">Jelajahi Kelas</a>
            </div>
        </div>
    </div>
</section>
@endsection
