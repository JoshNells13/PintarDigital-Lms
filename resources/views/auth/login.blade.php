@extends('layouts.main')

@section('title', 'Sign In | Sanctuary Learning')

@section('content')
<section class="min-h-[calc(100vh-64px)] flex items-center justify-center bg-surface-container-low py-12 px-8">
    <div class="w-full max-w-md">
        <!-- Brand/Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold tracking-tight text-on-surface mb-2">Welcome Back</h1>
            <p class="text-on-surface-variant">Resume your journey in the sanctuary.</p>
        </div>

        <!-- Login Card -->
        <div class="bg-surface-container-lowest p-8 rounded-2xl border border-outline-variant/15 shadow-sm">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-on-surface placeholder:text-on-surface-variant/40"
                        placeholder="email@example.com">
                    @error('email')
                        <p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest">Password</label>
                        <a href="#" class="text-xs font-bold text-primary hover:underline">Forgot?</a>
                    </div>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-on-surface placeholder:text-on-surface-variant/40"
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-primary bg-surface-container-low border-none rounded focus:ring-primary/20">
                    <label for="remember" class="ml-2 text-sm font-medium text-on-surface-variant">Remember me for 30 days</label>
                </div>

                <button type="submit" class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-transform flex justify-center items-center gap-2">
                    Sign In
                    <span class="material-symbols-outlined text-base">login</span>
                </button>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center mt-8 text-sm text-on-surface-variant font-medium">
            New to the Sanctuary? 
            <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">Create an account</a>
        </p>
    </div>
</section>
@endsection
