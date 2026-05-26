<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Islamic Life Guide') }}</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Inline Font & Custom Layout CSS Overrides -->
        <style>
            body {
                font-family: 'Plus Jakarta Sans', 'Outfit', sans-serif;
            }
            .font-arabic {
                font-family: 'Amiri', serif !important;
                line-height: 2.2 !important;
            }
            /* Custom glassmorphism card styling */
            .glass-card {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.4);
            }
            .dark .glass-card {
                background: rgba(15, 23, 42, 0.6);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.05);
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 transition-colors duration-200">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800/80">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Session Status Alerts -->
                    @if (session('success'))
                        <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 border border-emerald-100 dark:border-emerald-900 flex items-center gap-2 shadow-sm">
                            <span>✅</span>
                            <span class="text-sm font-medium">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-950/40 text-red-800 dark:text-red-300 border border-red-100 dark:border-red-900 flex items-center gap-2 shadow-sm">
                            <span>❌</span>
                            <span class="text-sm font-medium">{{ session('error') }}</span>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>

            <!-- Sticky Footer -->
            <footer class="bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 py-6 text-center text-xs text-slate-500 dark:text-slate-450 mt-12">
                <div class="max-w-7xl mx-auto px-4">
                    <p class="mb-1 font-semibold">Sunnah Life Guide & Deen Tracker</p>
                    <p>© {{ date('Y') }} — Practice and monitor daily prayers, eating habits, sunnahs, and halal earnings. Crafted beautifully.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
