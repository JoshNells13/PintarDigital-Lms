@extends('layouts.dashboard')

@section('title', 'Manage Account | PintarDigital')
@section('header', 'System Settings')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 pb-12">
    <!-- Profile & Avatar Section -->
    <div class="bg-surface-container-lowest p-8 rounded-3xl border border-outline-variant/10 shadow-sm relative overflow-hidden">
        <div class="absolute top-0 left-0 w-24 h-24 bg-primary/5 rounded-full -ml-12 -mt-12"></div>
        
        <div class="relative z-10">
            <h3 class="text-xl font-bold mb-8 flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">person_outline</span>
                Personal Information
            </h3>

            <form action="{{ route('settings.profile.update') }}" method="POST" enctype="multipart/form-data" class="grid md:grid-cols-12 gap-12">
                @csrf
                @method('PUT')
                
                <div class="md:col-span-4 flex flex-col items-center gap-6">
                    <div class="w-32 h-32 rounded-3xl bg-surface-container border-2 border-dashed border-outline-variant/30 flex items-center justify-center relative overflow-hidden group">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                        @else
                            <span class="material-symbols-outlined text-4xl text-outline-variant">add_a_photo</span>
                        @endif
                        <label class="absolute inset-0 bg-primary/40 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer flex items-center justify-center">
                            <input type="file" name="avatar" class="hidden" onchange="this.form.submit()">
                            <span class="text-xs font-bold text-white uppercase tracking-widest">Change</span>
                        </label>
                    </div>
                    <p class="text-[10px] text-on-surface-variant uppercase tracking-widest font-bold text-center">Square image recommended<br/>Max 1MB</p>
                </div>

                <div class="md:col-span-8 space-y-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest">Full Display Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full px-4 py-3 bg-surface-container border-none rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-medium">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full px-4 py-3 bg-surface-container border-none rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-medium">
                    </div>

                    <div class="pt-4 text-right">
                        <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-all">
                            Save Profile Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Security Section -->
    <div class="bg-surface-container-lowest p-8 rounded-3xl border border-outline-variant/10 shadow-sm relative overflow-hidden">
        <h3 class="text-xl font-bold mb-8 flex items-center gap-3">
            <span class="material-symbols-outlined text-tertiary">lock_reset</span>
            Update Passphrase
        </h3>

        <form action="{{ route('settings.password.update') }}" method="POST" class="max-w-xl space-y-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-2">
                <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest">Current Password</label>
                <input type="password" name="current_password" required
                    class="w-full px-4 py-3 bg-surface-container border-none rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-medium">
                @error('current_password') <p class="text-xs text-error mt-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest">New Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-surface-container border-none rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-medium">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 bg-surface-container border-none rounded-xl focus:ring-2 focus:ring-primary/20 transition-all font-medium">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-3 bg-tertiary text-on-primary font-bold rounded-xl shadow-lg shadow-tertiary/20 hover:scale-[0.98] transition-all">
                    Update Security Credentials
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
