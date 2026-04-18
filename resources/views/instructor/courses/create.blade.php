@extends('layouts.dashboard')

@section('title', 'Create New Course | Sanctuary Learning')
@section('header', 'Create New Course')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-surface-container-lowest p-8 rounded-2xl border border-outline-variant/15 shadow-sm">
        <form method="POST" action="{{ route('instructor.courses.store') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-2">Course Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required autofocus
                        class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-on-surface placeholder:text-on-surface-variant/40"
                        placeholder="e.g. Modern Architecture and Ethics">
                    @error('title')
                        <p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-2">Description</label>
                    <textarea name="description" id="description" rows="5"
                        class="w-full px-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-on-surface placeholder:text-on-surface-variant/40"
                        placeholder="Describe what students will learn in this academic sanctuary...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-2">Price (USD)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-bold">$</span>
                            <input type="number" name="price" id="price" value="{{ old('price', 49) }}" required min="0" step="0.01"
                                class="w-full pl-8 pr-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary/20 text-on-surface">
                        </div>
                        @error('price')
                            <p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Thumbnail -->
                    <div>
                        <label for="thumbnail" class="block text-sm font-bold text-on-surface-variant uppercase tracking-widest mb-2">Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                            class="w-full text-xs text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary file:text-on-primary hover:file:bg-primary-container transition-all">
                        <p class="mt-1 text-[10px] text-on-surface-variant/60">Max size: 2MB. Preferred ratio: 16:9.</p>
                        @error('thumbnail')
                            <p class="mt-2 text-sm text-error font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-outline-variant/10 flex gap-4">
                <button type="submit" class="px-8 py-3 bg-primary text-on-primary font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-[0.98] transition-all flex items-center gap-2">
                    Create Course
                    <span class="material-symbols-outlined text-sm">check</span>
                </button>
                <a href="{{ route('instructor.dashboard') }}" class="px-8 py-3 bg-surface-container-high text-on-surface font-semibold rounded-xl hover:bg-surface-container-highest transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
