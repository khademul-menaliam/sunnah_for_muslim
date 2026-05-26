@props(['hadith'])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-slate-900 border border-emerald-100 dark:border-emerald-950/60 shadow-md rounded-2xl p-6 transition-all duration-300 hover:shadow-lg']) }}>
    <!-- Header info -->
    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800 pb-3 mb-4">
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 text-xs font-semibold uppercase tracking-wider rounded-full bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">
                {{ ucfirst($hadith->module) }} Hadith
            </span>
            @if($hadith->topic)
                <span class="text-xs text-slate-500 dark:text-slate-400 font-medium">
                    • {{ $hadith->topic }}
                </span>
            @endif
        </div>
        @if($hadith->verified)
            <span class="inline-flex items-center text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                Authentic
            </span>
        @endif
    </div>

    <!-- Hadith Arabic Text (RTL) -->
    <div class="mb-5 text-right" dir="rtl">
        <p class="font-arabic text-2xl md:text-3xl leading-loose text-slate-850 dark:text-slate-100 font-medium select-none">
            {{ $hadith->arabic_text }}
        </p>
    </div>

    <!-- Transliteration -->
    @if($hadith->transliteration)
        <div class="mb-4 pl-4 border-l-2 border-emerald-500/30">
            <p class="text-sm italic text-slate-650 dark:text-slate-450 leading-relaxed">
                {{ $hadith->transliteration }}
            </p>
        </div>
    @endif

    <!-- English Translation -->
    <div class="mb-5">
        <p class="text-slate-750 dark:text-slate-300 leading-relaxed font-sans text-base">
            "{{ $hadith->translation }}"
        </p>
    </div>

    <!-- Footer / Source and Narrator -->
    <div class="flex flex-wrap items-center justify-between gap-3 pt-3 border-t border-slate-100 dark:border-slate-800 text-xs text-slate-500 dark:text-slate-400 font-medium">
        <div>
            @if($hadith->narrator)
                Narrated by: <span class="text-slate-700 dark:text-slate-300 font-semibold">{{ $hadith->narrator }}</span>
            @endif
        </div>
        <div class="px-2.5 py-1 rounded bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-mono tracking-tight text-right">
            {{ $hadith->source }}
        </div>
    </div>
</div>
