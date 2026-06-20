<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PintarDigital | Platform Belajar IT & Coding Terbaik')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">

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

<body class="bg-surface text-on-surface selection:bg-primary-container selection:text-white relative min-h-screen">
    <!-- Global Page Grid Background (covers all pages extending main layout) -->
    <div class="absolute inset-0 [background-size:50px_50px] [background-image:linear-gradient(to_right,#222226_1px,transparent_1px),linear-gradient(to_bottom,#222226_1px,transparent_1px)] pointer-events-none opacity-50 z-0"></div>

    <header class="fixed top-4 left-0 right-0 z-50 px-4 md:px-8">
        <div
            class="max-w-7xl mx-auto bg-surface-container-low/75 backdrop-blur-md border border-outline-variant/15 rounded-2xl px-6 py-3 flex justify-between items-center shadow-lg shadow-black/40">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-xl font-black tracking-tighter text-primary">PintarDigital</a>
                <nav class="hidden md:flex gap-2 items-center">
                    <a href="{{ route('courses.index') }}"
                        class="px-3 py-1.5 rounded-lg text-sm font-medium text-on-surface hover:bg-surface-container-high/50 transition-all">Katalog</a>
                    <a href="{{ route('mentors.index') }}"
                        class="px-3 py-1.5 rounded-lg text-sm font-medium text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high/50 transition-all">Mentor</a>
                    <a href="{{ route('learning-paths') }}"
                        class="px-3 py-1.5 rounded-lg text-sm font-medium text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high/50 transition-all">Alur
                        Belajar</a>
                    <a href="{{ route('leaderboard') }}"
                        class="px-3 py-1.5 rounded-lg text-sm font-medium text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high/50 transition-all">Leaderboard</a>
                </nav>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <div class="flex items-center gap-4">
                        <a href="{{ route(auth()->user()->role . '.dashboard') }}"
                            class="px-4 py-2 text-sm font-semibold text-primary hover:bg-surface-container-high/50 transition-all rounded-xl">
                            Dasbor Saya
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="p-2 text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high/50 transition-colors rounded-full"
                                title="Keluar">
                                <span class="material-symbols-outlined">logout</span>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}"
                            class="px-3 py-1.5 rounded-lg text-sm font-semibold text-on-surface hover:bg-surface-container-high/50 transition-all">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="px-5 py-2 bg-primary text-on-primary text-sm font-bold rounded-full hover:scale-95 transition-all shadow-md hover:shadow-white/10">Daftar
                            Sekarang</a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <main class="min-h-screen pt-24 md:pt-28 relative z-10">
        @yield('content')
    </main>

    <footer class="bg-surface-container-low pt-16 pb-8 border-t border-outline-variant/10 relative z-10">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-12 mb-16">
                <div class="col-span-2">
                    <span class="text-xl font-bold tracking-tighter text-primary mb-6 block">PintarDigital</span>
                    <p class="text-on-surface-variant text-sm max-w-xs leading-relaxed">Lingkungan akademik modern yang
                        didedikasikan untuk pembelajaran mendalam melalui teks berkualitas dan fokus penuh pada IT
                        Coding.</p>
                </div>
                <div>
                    <h5 class="font-bold text-sm mb-4">Platform</h5>
                    <ul class="space-y-3 text-sm text-on-surface-variant">
                        <li><a class="hover:text-primary transition-colors" href="{{ route('courses.index') }}">Katalog
                                Kelas</a></li>
                        <li><a class="hover:text-primary transition-colors"
                                href="{{ route('mentors.index') }}">Mentor</a></li>
                        <li><a class="hover:text-primary transition-colors" href="#">Komunitas</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-bold text-sm mb-4">Perusahaan</h5>
                    <ul class="space-y-3 text-sm text-on-surface-variant">
                        <li><a class="hover:text-primary transition-colors" href="#">Filosofi</a></li>
                        <li><a class="hover:text-primary transition-colors" href="#">Karir</a></li>
                        <li><a class="hover:text-primary transition-colors" href="#">Kontak</a></li>
                    </ul>
                </div>
            </div>
            <div
                class="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-outline-variant/10 text-xs text-on-surface-variant gap-4">
                <p>© {{ date('Y') }} PintarDigital. Hak Cipta Dilindungi Undang-Undang.</p>
                <div class="flex gap-6">
                    <a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
                    <a class="hover:text-primary transition-colors" href="#">Ketentuan Layanan</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
