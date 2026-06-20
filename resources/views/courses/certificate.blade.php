<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Kelulusan: {{ $course->title }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Inter:wght@400;600;700;800&family=Playfair+Display:ital,wght@1,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        cinzel: ['Cinzel', 'serif'],
                        playfair: ['Playfair Display', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white; margin: 0; padding: 0; }
            .print-area { border: none !important; box-shadow: none !important; }
        }
        @page {
            size: A4 landscape;
            margin: 0;
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex flex-col justify-center items-center p-4 sm:p-8 font-sans">

    <!-- Print / Close Controls -->
    <div class="no-print w-full max-w-5xl flex justify-between items-center mb-6">
        <a href="{{ route('student.learning', $course->slug) }}" class="flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-slate-900 transition-colors">
            <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Kelas
        </a>
        <button onclick="window.print()" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-lg transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">print</span> Cetak Sertifikat
        </button>
    </div>

    <!-- Certificate Container (Simulated A4 Landscape aspect-ratio: [1.414]) -->
    <div class="print-area w-full max-w-5xl aspect-[1.414] bg-white border-[16px] border-double border-amber-800 p-8 sm:p-16 flex flex-col justify-between shadow-2xl relative overflow-hidden rounded-2xl">
        
        <!-- Subtle background watermark ornament -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none flex items-center justify-center">
            <span class="material-symbols-outlined text-[400px]">verified_user</span>
        </div>

        <!-- Gold corner ornaments -->
        <div class="absolute top-4 left-4 w-12 h-12 border-t-4 border-l-4 border-amber-600"></div>
        <div class="absolute top-4 right-4 w-12 h-12 border-t-4 border-r-4 border-amber-600"></div>
        <div class="absolute bottom-4 left-4 w-12 h-12 border-b-4 border-l-4 border-amber-600"></div>
        <div class="absolute bottom-4 right-4 w-12 h-12 border-b-4 border-r-4 border-amber-600"></div>

        <!-- Top Header -->
        <div class="text-center">
            <span class="font-cinzel text-amber-700 font-extrabold text-sm sm:text-lg tracking-[0.3em] block mb-2">PINTARDIGITAL ACADEMY</span>
            <div class="h-0.5 bg-gradient-to-r from-transparent via-amber-600 to-transparent w-2/3 mx-auto"></div>
        </div>

        <!-- Main Body Content -->
        <div class="text-center my-6 flex-1 flex flex-col justify-center">
            <h1 class="font-cinzel text-slate-800 text-3xl sm:text-5xl font-black tracking-wider mb-4">SERTIFIKAT KELULUSAN</h1>
            <p class="font-playfair text-slate-600 text-base sm:text-xl italic mb-6">Dengan ini menerangkan bahwa:</p>
            
            <h2 class="text-2xl sm:text-4xl font-extrabold text-blue-900 tracking-wide border-b border-slate-300 pb-2 max-w-lg mx-auto mb-6">
                {{ $user->name }}
            </h2>

            <p class="text-slate-600 text-xs sm:text-sm max-w-2xl mx-auto leading-relaxed">
                Telah menyelesaikan seluruh rangkaian kurikulum pembelajaran berbasis teks, teori, kuis interaktif, dan verifikasi praktis di bawah bimbingan instruktur profesional, serta dinyatakan lulus pada kelas:
            </p>
            <h3 class="text-lg sm:text-2xl font-bold text-slate-800 tracking-tight mt-4 mb-2">
                {{ $course->title }}
            </h3>
            <span class="px-3 py-1 bg-amber-50 border border-amber-200 text-amber-800 text-[10px] sm:text-xs font-bold uppercase rounded-md inline-block mx-auto">
                Kategori: {{ $course->category ? $course->category->name : 'IT Pemrograman' }}
            </span>
        </div>

        <!-- Signatures & Footer -->
        <div class="flex justify-between items-end border-t border-slate-200 pt-6">
            <!-- Verification / Date -->
            <div class="text-left">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-none mb-1">ID SERTIFIKAT</p>
                <p class="text-[11px] font-mono text-slate-600 font-bold mb-3">PD-{{ strtoupper(substr($course->slug, 0, 4)) }}-{{ $enrollment->id }}-{{ $user->id }}</p>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-none mb-1">TANGGAL KELULUSAN</p>
                <p class="text-[11px] font-bold text-slate-700">{{ $enrollment->completed_at ? $enrollment->completed_at->format('d M Y') : now()->format('d M Y') }}</p>
            </div>

            <!-- Signature 1: PintarDigital -->
            <div class="text-center">
                <div class="h-12 w-28 mx-auto flex items-center justify-center">
                    <span class="font-playfair text-xl text-blue-900 italic font-black">PintarDigital</span>
                </div>
                <div class="h-px bg-slate-300 w-32 mx-auto mb-1"></div>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">DIREKTUR AKADEMI</p>
            </div>

            <!-- Signature 2: Instructor -->
            <div class="text-center">
                <div class="h-12 w-28 mx-auto flex items-center justify-center">
                    <span class="font-playfair text-sm text-slate-700 italic">{{ $course->instructor->name }}</span>
                </div>
                <div class="h-px bg-slate-300 w-32 mx-auto mb-1"></div>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">MENTOR UTAMA</p>
            </div>
        </div>

    </div>

</body>
</html>
