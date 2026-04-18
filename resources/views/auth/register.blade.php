@extends('layouts.main')

@section('title', 'Join the Sanctuary | Sanctuary Learning')

@section('content')
<section class="min-h-[calc(100vh-64px)] flex items-center justify-center bg-surface-container-low py-12 px-8">
    <div class="w-full max-w-xl">
        <!-- Brand/Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold tracking-tight text-on-surface mb-2">Begin Your Journey</h1>
            <p class="text-on-surface-variant">Choose your path and join our community of modern scholars.</p>
        </div>

        <!-- Register Card -->
        <div class="bg-surface-container-lowest p-8 rounded-2xl border border-outline-variant/15 shadow-sm">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-2">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                            class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-on-surface placeholder:text-on-surface-variant/40"
                            placeholder="Alex Scholar">
                        @error('name')
                            <p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-2">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-on-surface placeholder:text-on-surface-variant/40"
                            placeholder="alex@example.com">
                        @error('email')
                            <p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-2">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-on-surface placeholder:text-on-surface-variant/40">
                        @error('password')
                            <p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-on-surface placeholder:text-on-surface-variant/40">
                    </div>
                </div>

                <div>
                    <span class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-4 text-center">I want to join as a...</span>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="role" value="student" class="peer hidden" checked>
                            <div class="p-4 bg-surface-container-low border-2 border-transparent rounded-xl flex flex-col items-center gap-2 group-hover:bg-surface-container peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                                <span class="material-symbols-outlined text-3xl text-on-surface-variant peer-checked:text-primary">school</span>
                                <span class="text-sm font-bold">Student</span>
                                <span class="text-[10px] text-on-surface-variant text-center leading-tight">I want to learn and grow</span>
                            </div>
                        </label>
                        
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="role" value="instructor" class="peer hidden">
                            <div class="p-4 bg-surface-container-low border-2 border-transparent rounded-xl flex flex-col items-center gap-2 group-hover:bg-surface-container peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                                <span class="material-symbols-outlined text-3xl text-on-surface-variant peer-checked:text-primary">record_voice_over</span>
                                <span class="text-sm font-bold">Instructor</span>
                                <span class="text-[10px] text-on-surface-variant text-center leading-tight">I want to share knowledge</span>
                            </div>
                        </label>
                    </div>
                    @error('role')
                        <p class="mt-2 text-sm text-error font-medium text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-start gap-3">
                    <input type="checkbox" required name="terms" id="terms" class="mt-1 w-4 h-4 text-primary bg-surface-container-low border-none rounded focus:ring-primary/20">
                    <label for="terms" class="text-xs text-on-surface-variant leading-relaxed">
                        By creating an account, you agree to our <a href="#" class="text-primary hover:underline">Terms of Service</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>.
                    </label>
                </div>

                <button type="submit" class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-transform flex justify-center items-center gap-2">
                    Create Account
                    <span class="material-symbols-outlined text-base">arrow_forward</span>
                </button>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center mt-8 text-sm text-on-surface-variant font-medium">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Sign in instead</a>
        </p>
    </div>
</section>
@endsection
