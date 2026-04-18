@extends('layouts.dashboard')

@section('title', 'Add New Member | Sanctuary Admin')
@section('header', 'Create Member')

@section('content')
<div class="max-w-2xl">
    <div class="bg-surface-container-lowest p-8 rounded-2xl border border-outline-variant/10 shadow-sm">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label for="name" class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary/20 text-sm font-medium">
                @error('name') <p class="text-xs text-error font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary/20 text-sm font-medium">
                @error('email') <p class="text-xs text-error font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="password" class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">Temporary Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary/20 text-sm font-medium">
                @error('password') <p class="text-xs text-error font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label for="role" class="text-xs font-bold uppercase tracking-widest text-on-surface-variant">System Role</label>
                <select name="role" id="role" required
                    class="w-full px-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-primary/20 text-sm font-medium">
                    <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>Student</option>
                    <option value="instructor" {{ old('role') === 'instructor' ? 'selected' : '' }}>Instructor (Owner)</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
                @error('role') <p class="text-xs text-error font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4 flex gap-3">
                <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-all">
                    Create Member
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-8 py-3 bg-surface-container-high text-on-surface font-bold rounded-xl hover:bg-surface-container-highest transition-all">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
