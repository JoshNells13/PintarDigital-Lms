@extends('layouts.main')

@section('title', $course->title . ' | PintarDigital')

@section('content')
<section class="hero-gradient pt-32 pb-24 px-8 overflow-hidden relative">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
        <div class="space-y-8 relative z-10">
            <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-primary uppercase tracking-widest hover:gap-3 transition-all">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Kembali ke Katalog
            </a>
            
            @if($course->category)
                <div>
                    <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest rounded-full">
                        {{ $course->category->name }}
                    </span>
                </div>
            @endif

            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-on-surface leading-tight">
                {{ $course->title }}
            </h1>
            
            <p class="text-lg md:text-xl text-on-surface-variant leading-relaxed max-w-xl">
                {{ $course->description }}
            </p>
            
            <div class="flex flex-wrap items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                        {{ substr($course->instructor->name, 0, 1) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest leading-none mb-1">Mentor Ahli</span>
                        <span class="text-sm font-bold text-on-surface">{{ $course->instructor->name }}</span>
                    </div>
                </div>
                
                <div class="h-8 w-px bg-outline-variant/30"></div>
                
                <div>
                     <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest leading-none mb-1 block">Rating Kelas</span>
                     <span class="text-sm font-bold text-on-surface flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm text-primary fill-1" style="font-variation-settings: 'FILL' 1;">star</span>
                        {{ $course->averageRating() ? $course->averageRating() . ' (' . $course->comments()->whereNotNull('rating')->count() . ' ulasan)' : 'Belum ada ulasan' }}
                     </span>
                </div>

                <div class="h-8 w-px bg-outline-variant/30"></div>

                <div>
                     <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest leading-none mb-1 block">Suka</span>
                     <span class="text-sm font-bold text-on-surface flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm text-error fill-1" style="font-variation-settings: 'FILL' 1;">favorite</span>
                        {{ $course->likes()->count() }} menyukai
                     </span>
                </div>

                <div class="h-8 w-px bg-outline-variant/30"></div>

                <div>
                     <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest leading-none mb-1 block">Lulusan</span>
                     <span class="text-sm font-bold text-on-surface flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm text-amber-500 fill-1" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                        {{ $course->enrollments()->whereNotNull('completed_at')->count() }} lulus
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
                        <div class="w-full h-full flex items-center justify-center bg-primary/5 text-primary">
                            <span class="material-symbols-outlined text-7xl opacity-20">code</span>
                        </div>
                    @endif
                </div>
                <div class="p-8">
                    <div class="flex justify-between items-baseline mb-8">
                        <div class="flex items-baseline gap-2">
                             <span class="text-4xl font-black">
                                 {{ $course->price == 0 ? 'Gratis' : 'Rp ' . number_format($course->price, 0, ',', '.') }}
                             </span>
                             <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Akses Selamanya</span>
                        </div>
                        <span class="px-2 py-1 bg-tertiary-container/10 text-tertiary text-[10px] font-bold uppercase rounded-md">Banyak Diminati</span>
                    </div>
                    
                    @auth
                        @if(auth()->user()->enrolledCourses()->where('course_id', $course->id)->exists())
                            <a href="{{ route('student.learning', $course->slug) }}" class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-transform flex items-center justify-center gap-2">
                                Lanjutkan Belajar
                                <span class="material-symbols-outlined">play_arrow</span>
                            </a>
                            
                            @if($course->isCompletedBy(auth()->user()))
                                <a href="{{ route('courses.certificate', $course->id) }}" class="w-full py-4 bg-amber-500 text-white font-bold rounded-xl shadow-lg hover:bg-amber-600 transition-transform flex items-center justify-center gap-2 mt-3">
                                    Unduh Sertifikat Kelulusan
                                    <span class="material-symbols-outlined">workspace_premium</span>
                                </a>
                            @endif
                        @else
                            <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-transform flex items-center justify-center gap-2">
                                    Daftar Kelas Ini
                                    <span class="material-symbols-outlined">payments</span>
                                </button>
                            </form>
                        @endif

                        <!-- Course Like Button -->
                        <form action="{{ route('courses.like', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-3 border border-outline-variant/30 text-on-surface font-semibold rounded-xl hover:bg-surface-container-high transition-colors flex items-center justify-center gap-2 mt-3">
                                <span class="material-symbols-outlined text-lg {{ $course->isLikedBy(auth()->user()) ? 'text-error fill-1' : '' }}" style="font-variation-settings: 'FILL' {{ $course->isLikedBy(auth()->user()) ? 1 : 0 }}">favorite</span>
                                <span>{{ $course->isLikedBy(auth()->user()) ? 'Batal Menyukai' : 'Sukai Kelas Ini' }}</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-transform flex items-center justify-center gap-2">
                            Masuk untuk Mendaftar
                            <span class="material-symbols-outlined">login</span>
                        </a>
                    @endauth
                    
                    <ul class="mt-8 space-y-4">
                        <li class="flex items-center gap-3 text-sm text-on-surface-variant">
                             <span class="material-symbols-outlined text-primary text-lg">check_circle</span>
                             Akses penuh kurikulum berbasis teks
                        </li>
                        <li class="flex items-center gap-3 text-sm text-on-surface-variant">
                             <span class="material-symbols-outlined text-primary text-lg">check_circle</span>
                             Fitur kuis untuk uji pemahaman
                        </li>
                        <li class="flex items-center gap-3 text-sm text-on-surface-variant">
                             <span class="material-symbols-outlined text-primary text-lg">check_circle</span>
                             Feedback langsung dari mentor ahli
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
                <h3 class="text-3xl font-extrabold tracking-tight mb-8">Rincian Kurikulum</h3>
                <div class="space-y-4">
                    @forelse($course->chapters as $chapter)
                        <div class="bg-surface-container-low rounded-2xl overflow-hidden border border-outline-variant/10">
                            <div class="p-6 bg-surface-container/30 flex justify-between items-center cursor-pointer">
                                <div class="flex items-center gap-4">
                                     <span class="text-xs font-bold text-primary tracking-widest uppercase">Bab {{ $loop->iteration }}</span>
                                     <h4 class="font-bold text-on-surface">{{ $chapter->title }}</h4>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-medium text-on-surface-variant block">{{ $chapter->subChapters->count() }} pelajaran</span>
                                    <span class="text-[10px] font-bold text-green-600 block">{{ $chapter->getCompletedUsersCount() }} lulus bab ini</span>
                                </div>
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
                        <p class="text-on-surface-variant italic">Kurikulum saat ini sedang disiapkan.</p>
                    @endforelse
                </div>
            </div>

            <!-- Comments & Discussion Section -->
            <div class="border-t border-outline-variant/10 pt-16">
                <h3 class="text-3xl font-extrabold tracking-tight mb-8">Ulasan & Diskusi</h3>

                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="p-4 mb-6 text-sm text-green-800 bg-green-100 rounded-xl border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Comment Form -->
                @auth
                    <div class="bg-surface-container-low p-6 rounded-2xl border border-outline-variant/10 mb-12">
                        <h4 class="font-bold text-lg mb-4 text-on-surface">Tulis Ulasan atau Pertanyaan</h4>
                        <form action="{{ route('courses.comments.store', $course->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="rating" class="block text-sm font-semibold mb-1 text-on-surface-variant">Berikan Rating (Opsional untuk pertanyaan biasa):</label>
                                <select name="rating" id="rating" class="w-full md:w-1/3 p-3 bg-surface border border-outline-variant/20 rounded-xl text-sm focus:ring-primary focus:border-primary">
                                    <option value="">Pilih Rating</option>
                                    <option value="5">⭐⭐⭐⭐⭐ (5 - Sangat Bagus)</option>
                                    <option value="4">⭐⭐⭐⭐ (4 - Bagus)</option>
                                    <option value="3">⭐⭐⭐ (3 - Cukup)</option>
                                    <option value="2">⭐⭐ (2 - Kurang)</option>
                                    <option value="1">⭐ (1 - Buruk)</option>
                                </select>
                            </div>
                            <div>
                                <label for="content" class="block text-sm font-semibold mb-1 text-on-surface-variant">Tulis pesan:</label>
                                <textarea name="content" id="content" rows="4" required class="w-full p-4 bg-surface border border-outline-variant/20 rounded-xl text-sm focus:ring-primary focus:border-primary" placeholder="Tuliskan ulasan, pertanyaan, atau feedback Anda mengenai kelas ini..."></textarea>
                            </div>
                            <button type="submit" class="px-6 py-3 bg-primary text-on-primary font-bold rounded-xl hover:bg-primary-container transition-colors text-sm">
                                Kirim Masukan
                            </button>
                        </form>
                    </div>
                @else
                    <div class="bg-surface-container-low p-6 rounded-2xl border border-outline-variant/10 text-center mb-12">
                        <p class="text-sm text-on-surface-variant italic">
                            Silakan <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Masuk</a> atau <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">Daftar</a> terlebih dahulu untuk memberikan komentar atau ulasan pada kelas ini.
                        </p>
                    </div>
                @endauth

                <!-- Comments Thread -->
                <div class="space-y-6">
                    @forelse($course->comments as $comment)
                        <div class="bg-surface-container-lowest border border-outline-variant/10 rounded-2xl p-6 relative">
                            <!-- Comment Header -->
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container font-bold text-sm">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-on-surface leading-none mb-1">{{ $comment->user->name }}</h5>
                                        <p class="text-[10px] text-on-surface-variant font-medium">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                
                                @if($comment->rating)
                                    <div class="flex gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="material-symbols-outlined text-xs {{ $i <= $comment->rating ? 'text-amber-500 fill-1' : 'text-outline-variant' }}" style="font-variation-settings: 'FILL' {{ $i <= $comment->rating ? 1 : 0 }}">star</span>
                                        @endfor
                                    </div>
                                @endif
                            </div>

                            <!-- Comment Content -->
                            <div class="text-sm text-on-surface leading-relaxed mb-4">
                                {!! nl2br(e($comment->content)) !!}
                            </div>

                            <!-- Comment Footer Actions -->
                            <div class="flex items-center gap-6 pt-2 border-t border-outline-variant/5">
                                @auth
                                    <!-- Like button -->
                                    <form action="{{ route('comments.like', $comment->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-1 text-xs text-on-surface-variant hover:text-error transition-colors">
                                            <span class="material-symbols-outlined text-sm {{ $comment->isLikedBy(auth()->user()) ? 'text-error fill-1' : '' }}" style="font-variation-settings: 'FILL' {{ $comment->isLikedBy(auth()->user()) ? 1 : 0 }}">favorite</span>
                                            <span>Suka ({{ $comment->likes()->count() }})</span>
                                        </button>
                                    </form>

                                    <!-- Reply toggle button -->
                                    <button onclick="document.getElementById('reply-form-{{ $comment->id }}').classList.toggle('hidden')" class="flex items-center gap-1 text-xs text-on-surface-variant hover:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-sm">reply</span>
                                        <span>Balas</span>
                                    </button>
                                @else
                                    <span class="flex items-center gap-1 text-xs text-on-surface-variant">
                                        <span class="material-symbols-outlined text-sm">favorite</span>
                                        <span>{{ $comment->likes()->count() }} suka</span>
                                    </span>
                                @endauth
                            </div>

                            <!-- Reply Form (Hidden by default) -->
                            @auth
                                <div id="reply-form-{{ $comment->id }}" class="hidden mt-4 pt-4 border-t border-outline-variant/10">
                                    <form action="{{ route('courses.comments.store', $course->id) }}" method="POST" class="space-y-3">
                                        @csrf
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <textarea name="content" rows="2" required class="w-full p-3 text-sm bg-surface border border-outline-variant/20 rounded-xl focus:ring-primary focus:border-primary" placeholder="Tulis balasan untuk {{ $comment->user->name }}..."></textarea>
                                        <div class="flex justify-end gap-2">
                                            <button type="button" onclick="document.getElementById('reply-form-{{ $comment->id }}').classList.add('hidden')" class="px-4 py-1.5 text-xs font-semibold text-on-surface-variant bg-surface-container-high hover:bg-surface-container-highest rounded-lg transition-colors">Batal</button>
                                            <button type="submit" class="px-4 py-1.5 text-xs font-semibold text-on-primary bg-primary rounded-lg hover:bg-primary-container transition-colors">Balas</button>
                                        </div>
                                    </form>
                                </div>
                            @endauth

                            <!-- Nested Replies List -->
                            @if($comment->replies->count() > 0)
                                <div class="mt-6 space-y-4 pl-6 border-l-2 border-primary/20">
                                    @foreach($comment->replies as $reply)
                                        <div class="bg-surface-container-low p-4 rounded-xl relative">
                                            <div class="flex justify-between items-start mb-2">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-6 h-6 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container font-bold text-[10px]">
                                                        {{ substr($reply->user->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="font-bold text-xs text-on-surface leading-none mb-0.5">{{ $reply->user->name }}</h6>
                                                        <p class="text-[8px] text-on-surface-variant font-medium">{{ $reply->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-xs text-on-surface leading-relaxed mb-3">
                                                {!! nl2br(e($reply->content)) !!}
                                            </div>

                                            <div class="flex items-center gap-4 pt-1">
                                                @auth
                                                    <form action="{{ route('comments.like', $reply->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="flex items-center gap-1 text-[10px] text-on-surface-variant hover:text-error transition-colors">
                                                            <span class="material-symbols-outlined text-xs {{ $reply->isLikedBy(auth()->user()) ? 'text-error fill-1' : '' }}" style="font-variation-settings: 'FILL' {{ $reply->isLikedBy(auth()->user()) ? 1 : 0 }}">favorite</span>
                                                            <span>Suka ({{ $reply->likes()->count() }})</span>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="flex items-center gap-1 text-[10px] text-on-surface-variant">
                                                        <span class="material-symbols-outlined text-xs">favorite</span>
                                                        <span>{{ $reply->likes()->count() }} suka</span>
                                                    </span>
                                                @endauth
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-on-surface-variant text-center py-8 italic bg-surface-container-low rounded-2xl">
                            Belum ada ulasan atau diskusi di kelas ini. Jadilah yang pertama memberikan masukan!
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
        
        <div class="space-y-8">
            <div class="bg-surface-container-low p-8 rounded-2xl border border-outline-variant/10">
                <h4 class="font-bold mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">verified_user</span>
                    Komitmen PintarDigital
                </h4>
                <p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                    Metode belajar kami dirancang untuk efektivitas pemahaman kognitif Anda. Belajar lebih teratur, terfokus pada materi sintaks kode, dan bebas dari distraksi visual.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                         <span class="material-symbols-outlined text-primary text-lg">bolt</span>
                         <div>
                            <p class="text-xs font-bold uppercase tracking-widest mb-1 text-on-surface">Pembelajaran Teks</p>
                            <p class="text-[10px] text-on-surface-variant">Fokus membaca, memahami, dan mempraktekkan kode tanpa interupsi video.</p>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
