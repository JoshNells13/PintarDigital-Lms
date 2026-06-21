@extends('layouts.dashboard')

@section('title', 'Pendaftaran Siswa | Sanctuary Instruktur')
@section('header', 'Peserta Siswa')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold tracking-tight">Siswa Terdaftar</h2>
    </div>

    @if($enrolledStudents->isEmpty())
        <div class="bg-surface-container-low p-12 rounded-3xl text-center text-on-surface-variant italic border-2 border-dashed border-outline-variant/10">
            Belum ada siswa yang mendaftar di kelas Anda.
        </div>
    @else
        <div class="bg-surface-container-lowest border border-outline-variant/10 rounded-2xl overflow-hidden shadow-sm">
            <table class="w-full text-left">
                <thead class="bg-surface-container-low text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Siswa</th>
                        <th class="px-6 py-4">Kelas yang Diikuti</th>
                        <th class="px-6 py-4">Status Progres</th>
                        <th class="px-6 py-4 text-right">Aktivitas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/5">
                    @foreach($enrolledStudents as $student)
                        <tr class="hover:bg-surface-container-low transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary font-bold text-xs">
                                        {{ substr($student->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm">{{ $student->name }}</p>
                                        <p class="text-[10px] text-on-surface-variant">{{ $student->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <ul class="space-y-1">
                                    @foreach($student->enrolledCourses as $course)
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-primary/40"></span>
                                            {{ $course->title }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                             <td class="px-6 py-4">
                                <ul class="space-y-2">
                                    @foreach($student->enrolledCourses as $course)
                                        <li class="flex items-center justify-between gap-4">
                                            @php $progress = $student->courseProgress($course->id); @endphp
                                            <div class="flex-1 h-1.5 bg-surface-container rounded-full overflow-hidden">
                                                <div class="h-full bg-primary" style="width: {{ $progress }}%"></div>
                                            </div>
                                            <span class="text-[10px] font-bold text-primary whitespace-nowrap">{{ $progress }}%</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-6 py-4 text-right text-xs text-on-surface-variant">
                                Terdaftar {{ $student->enrolledCourses->first()->pivot->enrolled_at->diffForHumans() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
