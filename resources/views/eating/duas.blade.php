<x-app-layout>
    <x-slot name="header">
        <div>
            <a href="{{ route('eating.index') }}" class="text-xs font-bold text-emerald-650 hover:underline dark:text-emerald-400 mb-1 inline-block">← Back to Eating Hub</a>
            <h2 class="text-2xl font-bold text-slate-805 dark:text-slate-100 flex items-center gap-2">
                🤲 Eating & Fasting Supplications (Duas)
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
                Recite these authentic daily prayers to invoke blessings, express gratitude, and repel satanic influence.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6 max-w-4xl mx-auto">
        @foreach($duas as $dua)
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-md transition">
                <!-- Title & Context -->
                <div class="flex items-center justify-between border-b border-slate-50 dark:border-slate-850 pb-3 mb-4">
                    <h3 class="text-base font-bold text-slate-850 dark:text-slate-100 flex items-center gap-2">
                        <span>🏷️</span> {{ $dua->title }}
                    </h3>
                    <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase rounded bg-amber-50 text-amber-700 dark:bg-amber-950/30 dark:text-amber-400 border border-amber-100/50">
                        {{ $dua->occasion }}
                    </span>
                </div>

                <!-- Arabic Text (RTL) -->
                <div class="mb-5 text-right p-4 rounded-2xl bg-emerald-50/20 dark:bg-emerald-950/10 border border-emerald-50 dark:border-emerald-900/40" dir="rtl">
                    <p class="font-arabic text-2xl md:text-3xl leading-loose text-slate-850 dark:text-slate-100 font-bold select-all">
                        {{ $dua->arabic_text }}
                    </p>
                </div>

                <!-- Transliteration -->
                <div class="mb-4 pl-4 border-l-2 border-emerald-500/30">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-0.5">Transliteration</span>
                    <p class="text-xs italic text-slate-650 dark:text-slate-450 leading-relaxed font-semibold">
                        {{ $dua->transliteration }}
                    </p>
                </div>

                <!-- English Translation -->
                <div class="mb-5 bg-slate-50 dark:bg-slate-955 p-4 rounded-xl">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">Translation</span>
                    <p class="text-xs text-slate-750 dark:text-slate-350 leading-relaxed font-semibold">
                        "{{ $dua->translation }}"
                    </p>
                </div>

                <!-- Hadith Context/Source -->
                @if($dua->hadith)
                    <div class="pt-3 border-t border-slate-50 dark:border-slate-850 flex items-center justify-between text-[10px] text-slate-400 font-bold">
                        <span>Narrator: {{ $dua->hadith->narrator }}</span>
                        <a href="{{ route('hadiths.show', $dua->hadith->id) }}" class="text-emerald-650 dark:text-emerald-400 hover:underline flex items-center gap-0.5">
                            Check Hadith Context ({{ $dua->hadith->source }})
                            <span>→</span>
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>
