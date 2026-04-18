@extends('layouts.dashboard')

@section('title', 'Instructor Dashboard | Sanctuary Learning')
@section('header', 'Instructor Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-surface-container-low p-6 rounded-2xl">
            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">My Courses</p>
            <p class="text-3xl font-extrabold">{{ $courses->count() }}</p>
        </div>
        <div class="bg-surface-container-low p-6 rounded-2xl">
            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Total Students</p>
            <p class="text-3xl font-extrabold">{{ $totalStudents }}</p>
        </div>
        <div class="bg-surface-container-low p-6 rounded-2xl">
            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Platform Rating</p>
            <p class="text-3xl font-extrabold">4.9</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="flex justify-between items-center">
        <h3 class="text-xl font-bold tracking-tight">Active Courses</h3>
        <a href="{{ route('instructor.courses.create') }}" class="px-5 py-2.5 bg-primary text-on-primary text-sm font-bold rounded-xl hover:bg-primary-container transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-base">add</span>
            Create New Course
        </a>
    </div>

    @if($courses->isEmpty())
        <div class="bg-surface-container-lowest border border-outline-variant/10 rounded-2xl p-12 text-center text-on-surface-variant">
            <p>You haven't created any courses yet. Start sharing your knowledge today.</p>
        </div>
    @else
        <div class="bg-white border border-outline-variant/10 rounded-2xl overflow-hidden shadow-sm">
            <table class="w-full text-left">
                <thead class="bg-surface-container-low text-xs font-bold text-on-surface-variant uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Course Name</th>
                        <th class="px-6 py-4">Students</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/5">
                    @foreach($courses as $course)
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-primary/5 flex items-center justify-center text-primary">
                                        <span class="material-symbols-outlined text-base">auto_stories</span>
                                    </div>
                                    <span class="font-bold">{{ $course->title }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium">{{ $course->students_count }} students</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($course->is_approved)
                                    <span class="inline-flex items-center px-2 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase rounded-md">Approved</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 bg-tertiary/10 text-tertiary text-[10px] font-bold uppercase rounded-md">Pending Review</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('instructor.courses.edit', $course->id) }}" class="p-2 text-on-surface-variant hover:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-base">edit</span>
                                    </a>
                                    <form action="{{ route('instructor.courses.destroy', $course->id) }}" method="POST" class="inline" onsubmit="return confirm('Deleting is permanent. Proceed?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors">
                                            <span class="material-symbols-outlined text-base">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
