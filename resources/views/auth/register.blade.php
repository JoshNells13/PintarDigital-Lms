@extends('layouts.main')

@section('title', 'Daftar Akun Baru | PintarDigital')

@section('content')
    <section class="min-h-[calc(100vh-64px)] flex items-center justify-center  py-12 px-8">
        <div class="w-full max-w-xl">
            <!-- Brand/Header -->
            <div class="text-center mb-10">
                <h1 class="text-3xl font-extrabold tracking-tight text-on-surface mb-2">Mulai Perjalanan Belajar Anda</h1>
                <p class="text-on-surface-variant">Pilih peran Anda dan bergabunglah bersama ribuan developer berbakat.</p>
            </div>

            <!-- Register Card -->
            <div class="bg-surface-container-low p-8 rounded-2xl border border-outline-variant/15 shadow-sm">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="name"
                                class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                autofocus
                                class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-on-surface placeholder:text-on-surface-variant/40"
                                placeholder="Nama Anda">
                            @error('name')
                                <p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email"
                                class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-2">Alamat Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-on-surface placeholder:text-on-surface-variant/40"
                                placeholder="nama@email.com">
                            @error('email')
                                <p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="password"
                                class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-2">Kata Sandi</label>
                            <input type="password" name="password" id="password" required
                                class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-on-surface placeholder:text-on-surface-variant/40"
                                placeholder="••••••••">
                            @error('password')
                                <p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-2">Konfirmasi Kata Sandi</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-on-surface placeholder:text-on-surface-variant/40"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <span
                            class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-4 text-center">Saya ingin bergabung sebagai...</span>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="role" value="student" class="peer hidden" checked>
                                <div
                                    class="p-4 bg-surface-container-low border-2 border-transparent rounded-xl flex flex-col items-center gap-2 group-hover:bg-surface-container peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                                    <span
                                        class="material-symbols-outlined text-3xl text-on-surface-variant peer-checked:text-primary">school</span>
                                    <span class="text-sm font-bold">Siswa / Pelajar</span>
                                    <span class="text-[10px] text-on-surface-variant text-center leading-tight">Saya ingin belajar dan berkembang</span>
                                </div>
                            </label>

                            <label class="relative cursor-pointer group">
                                <input type="radio" name="role" value="instructor" class="peer hidden">
                                <div
                                    class="p-4 bg-surface-container-low border-2 border-transparent rounded-xl flex flex-col items-center gap-2 group-hover:bg-surface-container peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                                    <span
                                        class="material-symbols-outlined text-3xl text-on-surface-variant peer-checked:text-primary">record_voice_over</span>
                                    <span class="text-sm font-bold">Instruktur / Mentor</span>
                                    <span class="text-[10px] text-on-surface-variant text-center leading-tight">Saya ingin membagikan ilmu & membimbing</span>
                                </div>
                            </label>
                        </div>
                        @error('role')
                            <p class="mt-2 text-sm text-error font-medium text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-start gap-3">
                        <input type="checkbox" required name="terms" id="terms"
                            class="mt-1 w-4 h-4 text-primary bg-surface-container-low border-none rounded focus:ring-primary/20">
                        <label for="terms" class="text-xs text-on-surface-variant leading-relaxed">
                            Dengan mendaftar, Anda menyetujui <a href="#"
                                class="text-primary hover:underline">Ketentuan Layanan</a> dan <a href="#"
                                class="text-primary hover:underline">Kebijakan Privasi</a> kami.
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-transform flex justify-center items-center gap-2">
                        Daftar Akun
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <p class="text-center mt-8 text-sm text-on-surface-variant font-medium">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Masuk ke akun Anda</a>
            </p>
        </div>
    </section>
@endsection
