<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard | Sanctuary Learning')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ffffff',
                        'primary-container': '#27272a',
                        'on-primary': '#09090b',
                        secondary: '#a1a1aa',
                        'secondary-container': '#18181b',
                        'on-secondary-container': '#ffffff',
                        tertiary: '#71717a',
                        'tertiary-container': '#3f3f46',
                        surface: '#09090b',
                        'on-surface': '#ffffff',
                        'surface-container-lowest': '#09090b',
                        'surface-container-low': '#18181b',
                        'surface-container': '#27272a',
                        'surface-container-high': '#3f3f46',
                        'surface-container-highest': '#52525b',
                        'on-surface-variant': '#a1a1aa',
                        'inverse-surface': '#ffffff',
                        'inverse-on-surface': '#09090b',
                        outline: '#52525b',
                        'outline-variant': '#27272a',
                    },
                    borderRadius: {
                        'md': '0.75rem',
                        'lg': '1rem',
                        'xl': '1.5rem',
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style type="text/tailwindcss">
        @layer utilities {
            .glass-panel {
                background: rgba(9, 9, 11, 0.7);
                @apply backdrop-blur-xl;
            }

            .hero-gradient {
                background: linear-gradient(180deg, #09090b 0%, #18181b 100%);
            }

            .prose {
                @apply text-on-surface leading-relaxed;
                font-size: 1.125rem;
            }

            .prose h1 {
                @apply text-4xl font-extrabold tracking-tight mb-8 mt-12;
            }

            .prose h2 {
                @apply text-2xl font-bold tracking-tight mb-6 mt-10;
            }

            .prose p {
                @apply mb-6;
            }

            .prose blockquote {
                @apply border-l-4 border-primary pl-6 py-2 italic text-on-surface-variant my-8 bg-primary/5 rounded-r-xl;
            }

            .prose ul {
                @apply list-disc pl-6 mb-6 space-y-2;
            }

            .prose ol {
                @apply list-decimal pl-6 mb-6 space-y-2;
            }

            .prose hr {
                @apply border-outline-variant/10 my-12;
            }

            .prose code {
                @apply bg-surface-container-high px-1.5 py-0.5 rounded text-sm font-mono;
            }

            .prose pre {
                @apply bg-inverse-surface text-inverse-on-surface p-6 rounded-2xl my-8 overflow-x-auto text-sm;
            }
        }
    </style>
</head>

<body class="bg-surface text-on-surface selection:bg-primary-container selection:text-white">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-surface-container-low border-r border-outline-variant/10 flex flex-col">
            <div class="p-6">
                <a href="{{ route('home') }}" class="text-xl font-bold tracking-tighter text-primary">PintarDigital</a>
                <div class="mt-2 text-[10px] font-bold uppercase tracking-widest text-on-surface-variant/50">
                    PANEL {{ auth()->user()->role === 'instructor' ? 'MENTOR' : (auth()->user()->role === 'student' ? 'SISWA' : 'ADMIN') }}
                </div>
            </div>

            <nav class="flex-1 px-4 space-y-1">
                @if (auth()->user()->role === 'admin')
                    <x-nav-link href="{{ route('admin.dashboard') }}" icon="dashboard"
                        :active="request()->routeIs('admin.dashboard') && !request()->has('view')">Ringkasan</x-nav-link>
                    <x-nav-link href="{{ route('admin.users.index') }}" icon="group"
                        :active="request()->routeIs('admin.users.*')">Anggota</x-nav-link>
                    <x-nav-link href="{{ route('admin.dashboard', ['view' => 'approvals']) }}" icon="verified" :active="request()->query('view') === 'approvals'">Persetujuan Kelas</x-nav-link>
                    <x-nav-link href="{{ route('settings.edit') }}" icon="settings"
                        :active="request()->routeIs('settings.*')">Pengaturan</x-nav-link>
                @elseif(auth()->user()->role === 'instructor')
                    <x-nav-link href="{{ route('instructor.dashboard') }}" icon="dashboard"
                        :active="request()->routeIs('instructor.dashboard')">Ringkasan</x-nav-link>
                    <x-nav-link href="{{ route('instructor.courses.index') }}" icon="auto_stories" :active="request()->routeIs('instructor.courses.*')">Kelas Saya</x-nav-link>
                    <x-nav-link href="{{ route('instructor.students.index') }}" icon="analytics"
                        :active="request()->routeIs('instructor.students.*')">Progres Siswa</x-nav-link>
                    <x-nav-link href="{{ route('settings.edit') }}" icon="settings"
                        :active="request()->routeIs('settings.*')">Pengaturan</x-nav-link>
                @else
                    <x-nav-link href="{{ route('student.dashboard') }}" icon="dashboard" :active="request()->routeIs('student.dashboard')">Pembelajaran Saya</x-nav-link>
                    <x-nav-link href="{{ route('courses.index') }}" icon="explore" :active="request()->routeIs('courses.*')">Katalog Kelas</x-nav-link>
                    <x-nav-link href="{{ route('settings.edit') }}" icon="settings"
                        :active="request()->routeIs('settings.*')">Pengaturan</x-nav-link>
                @endif
            </nav>

            <div class="p-4 border-t border-outline-variant/10">
                <a href="{{ route('settings.edit') }}"
                    class="flex items-center gap-3 p-2 rounded-xl bg-surface-container-highest/20 hover:bg-surface-container-highest/50 transition-colors group">
                    <div
                        class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold overflow-hidden">
                        @if (auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                class="w-full h-full object-cover">
                        @else
                            {{ substr(auth()->user()->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold truncate group-hover:text-primary transition-colors">
                            {{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-on-surface-variant/70 font-bold uppercase tracking-widest truncate">
                            {{ auth()->user()->role === 'instructor' ? 'Mentor' : (auth()->user()->role === 'student' ? 'Siswa' : 'Admin') }}</p>
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-2 text-[10px] font-bold uppercase tracking-widest text-error hover:bg-error/5 transition-colors rounded-xl">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-surface">
            <header
                class="h-16 border-b border-outline-variant/10 flex items-center justify-between px-8 sticky top-0 bg-surface/80 backdrop-blur-md z-40">
                <h2 class="text-sm font-black uppercase tracking-[0.2em] text-on-surface/60">@yield('header', 'Dasbor')</h2>
                <div class="flex items-center gap-6">
                    <!-- Notifications Dropdown -->
                    <div class="relative group">
                        <button
                            class="p-2 text-on-surface-variant hover:bg-surface-container-high transition-colors rounded-full relative">
                            <span class="material-symbols-outlined">notifications</span>
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <span
                                    class="absolute top-1 right-1 w-2.5 h-2.5 bg-error border-2 border-surface rounded-full"></span>
                            @endif
                        </button>

                        <!-- Dropdown Panel -->
                        <div
                            class="absolute right-0 mt-2 w-80 bg-surface-container-lowest border border-outline-variant/10 rounded-2xl shadow-2xl shadow-primary/10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div
                                class="p-4 border-b border-outline-variant/5 flex justify-between items-center bg-surface-container-low/50">
                                <h4 class="text-xs font-black uppercase tracking-widest">Aktivitas Terbaru</h4>
                                @if (auth()->user()->unreadNotifications->count() > 0)
                                    <form action="{{ route('notifications.read-all') }}" method="POST">
                                        @csrf
                                        <button class="text-[10px] font-bold text-primary hover:underline">Hapus Semua</button>
                                    </form>
                                @endif
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                    <div
                                        class="p-4 hover:bg-surface-container-low transition-colors border-b border-outline-variant/5 last:border-0 relative">
                                        <div class="flex gap-4">
                                            <div
                                                class="w-8 h-8 rounded-xl bg-primary/5 flex items-center justify-center text-primary">
                                                <span
                                                    class="material-symbols-outlined text-sm font-bold">{{ $notification->data['icon'] ?? 'info' }}</span>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-[11px] font-bold text-on-surface leading-tight">
                                                    {{ $notification->data['message'] }}</p>
                                                <p class="text-[10px] text-on-surface-variant mt-1">
                                                    {{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <form action="{{ route('notifications.read', $notification->id) }}"
                                            method="POST" class="absolute inset-0 opacity-0">
                                            @csrf
                                            <button class="w-full h-full cursor-pointer"></button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="p-8 text-center text-on-surface-variant/40">
                                        <span class="material-symbols-outlined text-4xl mb-2">notifications_off</span>
                                        <p class="text-xs font-bold uppercase tracking-widest">Tidak ada aktivitas baru</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="h-8 w-px bg-outline-variant/20"></div>

                    <div class="flex items-center gap-3">
                        <div class="flex flex-col items-end">
                            <span
                                class="text-xs font-bold tracking-tight">{{ explode(' ', auth()->user()->name)[0] }}</span>
                            <span
                                class="text-[10px] text-primary font-black uppercase tracking-widest">{{ auth()->user()->role }}</span>
                        </div>
                        <div
                            class="w-8 h-8 rounded-lg bg-surface-container-highest border border-outline-variant/20 flex items-center justify-center overflow-hidden">
                            @if (auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <span class="text-xs font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-8">
                @if (session('success'))
                    <div
                        class="mb-6 p-4 bg-primary/5 border border-primary/20 text-primary rounded-xl flex items-center gap-3">
                        <span class="material-symbols-outlined">check_circle</span>
                        <p class="text-sm font-semibold">{{ session('success') }}</p>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
