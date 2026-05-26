<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('hadiths.index') }}" class="p-1.5 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition text-slate-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100">
                    Hadith Details
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-450 mt-0.5">
                    Authentic narration guiding our spiritual journey.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto py-4">
        <x-hadith-card :hadith="$hadith" class="!shadow-xl border-emerald-200" />
        
        <div class="mt-6 text-center">
            <a href="{{ route('hadiths.index') }}" class="inline-flex items-center text-sm font-semibold text-emerald-650 hover:text-emerald-700 dark:text-emerald-400">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                Browse all Hadiths in Library
            </a>
        </div>
    </div>
</x-app-layout>
