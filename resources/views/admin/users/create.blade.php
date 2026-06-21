@extends('layouts.dashboard')

@section('title', 'Tambah Anggota Baru | Sanctuary Admin')
@section('header', 'Tambah Anggota')

@section('content')
<div class="max-w-2xl">
    <div class="bg-surface-container-lowest p-8 rounded-2xl border border-outline-variant/10 shadow-sm">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label for="name" class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary/20 text-sm font-medium">
                @error('name') <p class="text-xs text-error font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary/20 text-sm font-medium">
                @error('email') <p class="text-xs text-error font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="password" class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Kata Sandi Sementara</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary/20 text-sm font-medium">
                @error('password') <p class="text-xs text-error font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="role" class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Peran Sistem</label>
                <select name="role" id="role" required
                    class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary/20 text-sm font-medium">
                    <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Siswa</option>
                    <option value="instructor" {{ old('role') === 'instructor' ? 'selected' : '' }}>Mentor</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
                @error('role') <p class="text-xs text-error font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4 flex gap-3">
                <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-all">
                    Tambah Anggota
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-8 py-3 bg-surface-container-high text-on-surface font-bold rounded-xl hover:bg-surface-container-highest transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
