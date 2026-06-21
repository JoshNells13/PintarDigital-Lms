@extends('layouts.dashboard')

@section('title', 'Dasbor Admin | Sanctuary Learning')
@section('header', 'Ikhtisar Platform')

@section('content')
    <div class="space-y-8">
        <!-- Platform Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-surface-container-low p-6 rounded-2xl border border-outline-variant/5">
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-1">Total Anggota</p>
                <p class="text-3xl font-extrabold">{{ $totalUsers }}</p>
                <div class="mt-2 flex gap-2">
                    <span
                        class="text-[10px] bg-primary/10 text-primary px-2 py-0.5 rounded font-bold">{{ $totalInstructors }}
                        Mentor</span>
                    <span
                        class="text-[10px] bg-secondary/10 text-secondary px-2 py-0.5 rounded font-bold">{{ $totalStudents }}
                        Siswa</span>
                </div>
            </div>
            <div class="bg-surface-container-low p-6 rounded-2xl border border-outline-variant/5">
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-1">Total kelas</p>
                <p class="text-3xl font-extrabold">{{ $totalCourses }}</p>
                <div class="mt-2 text-[10px] font-bold text-success">
                    {{ $totalApprovedCourses }} Diterbitkan
                </div>
            </div>
            <div class="bg-surface-container-low p-6 rounded-2xl border border-outline-variant/5 text-primary">
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-1">Pendapatan Platform</p>
                <p class="text-3xl font-extrabold">$14.2k</p>
                <div class="mt-2 text-[10px] font-bold text-on-surface-variant">Estimasi</div>
            </div>
            <div class="bg-surface-container-low p-6 rounded-2xl border border-outline-variant/5">
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest mb-1">Kesehatan Sistem</p>
                <p class="text-3xl font-extrabold text-success">99.9%</p>
                <div class="mt-2 text-[10px] font-bold text-on-surface-variant">Semua layanan operasional</div>
            </div>
        </div>

        <!-- Approval Queue -->
        <div>
            <h3 class="text-xl font-bold tracking-tight mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">verified</span>
                Antrean Persetujuan Kelas
            </h3>

            @if ($pendingCourses->isEmpty())
                <div
                    class="bg-surface-container-low p-12 rounded-3xl text-center text-on-surface-variant italic border-2 border-dashed border-outline-variant/10">
                    Antrean kosong. Semua konten editorial telah ditinjau.
                </div>
            @else
                <div
                    class="bg-surface-container-lowest border border-outline-variant/10 rounded-2xl overflow-hidden shadow-sm">
                    <table class="w-full text-left">
                        <thead
                            class="bg-surface-container-low text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">
                            <tr>
                                <th class="px-6 py-4">Judul</th>
                                <th class="px-6 py-4">Mentor</th>
                                <th class="px-6 py-4">Harga</th>
                                <th class="px-6 py-4 text-right">Keputusan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/5">
                            @foreach ($pendingCourses as $course)
                                <tr class="hover:bg-surface-container-low transition-colors group">
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-sm">{{ $course->title }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">{{ $course->instructor->name }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-primary">
                                        ${{ number_format($course->price, 0) }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-3">
                                            <form action="{{ route('admin.courses.approve', $course->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="px-4 py-2 bg-primary text-on-primary text-[10px] font-bold uppercase rounded-lg hover:bg-primary-container transition-all">
                                                    Setujui
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.courses.reject', $course->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="px-4 py-2 bg-surface-container-high text-on-surface text-[10px] font-bold uppercase rounded-lg hover:bg-error/10 hover:text-error transition-all"
                                                    onclick="return confirm('Tolak kelas ini?')">
                                                    Tolak
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
    </div>
@endsection
