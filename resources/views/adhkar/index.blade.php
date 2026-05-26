<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ route('sunnahs.index') }}" class="text-xs font-bold text-emerald-650 hover:underline dark:text-emerald-400 mb-1 inline-block">← Back to Sunnah Checklist</a>
                <h2 class="text-2xl font-bold text-slate-805 dark:text-slate-100 flex items-center gap-2">
                    📿 Adhkar & Dhikr Library
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
                    "Remember Me; I will remember you" — Surah Al-Baqarah 2:152. Use our interactive clicker to count repetitions.
                </p>
            </div>
        </div>
    </x-slot>

    <!-- Adhkar Categories Sections -->
    <div class="space-y-12 max-w-4xl mx-auto">
        @php
            $catNames = [
                'morning' => '🌅 Morning Adhkar (After Fajr)',
                'evening' => '🌇 Evening Adhkar (After Asr/Maghrib)',
                'before_sleep' => '🛌 Before Sleep Adhkar',
                'after_prayer' => '🕌 After Prayer Dhikr',
            ];
        @endphp

        @foreach($adhkars as $catKey => $items)
            <div>
                <h3 class="text-lg font-bold text-slate-800 dark:text-slate-150 mb-6 flex items-center gap-2 border-l-4 border-emerald-600 pl-3">
                    {{ $catNames[$catKey] ?? ucfirst($catKey) }}
                </h3>

                <div class="grid grid-cols-1 gap-6">
                    @foreach($items as $adhkar)
                        <div x-data="{ count: 0, target: {{ $adhkar->repetitions }} }" class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-850 rounded-3xl p-6 shadow-sm flex flex-col md:flex-row gap-6 justify-between items-center transition hover:shadow-md">
                            
                            <!-- Texts -->
                            <div class="w-full md:w-3/4">
                                <div class="flex items-center gap-2 mb-3">
                                    <h4 class="text-sm font-extrabold text-slate-800 dark:text-slate-100">{{ $adhkar->name }}</h4>
                                    <span class="px-2 py-0.5 text-[9px] font-black uppercase rounded bg-slate-50 text-slate-500 border border-slate-100">
                                        {{ $adhkar->repetitions }}x Repetitions
                                    </span>
                                </div>

                                <!-- Arabic Script (RTL) -->
                                <div class="mb-4 text-right p-4 rounded-2xl bg-emerald-50/20 dark:bg-emerald-950/10 border border-emerald-50 dark:border-emerald-900/40" dir="rtl">
                                    <p class="font-arabic text-xl md:text-2xl leading-loose text-slate-850 dark:text-slate-100 font-bold select-all">
                                        {{ $adhkar->arabic_text }}
                                    </p>
                                </div>

                                <!-- Transliteration -->
                                <p class="text-xs italic text-slate-550 dark:text-slate-450 leading-relaxed mb-3">
                                    {{ $adhkar->transliteration }}
                                </p>

                                <!-- Translation -->
                                <p class="text-xs text-slate-750 dark:text-slate-350 leading-relaxed font-semibold mb-4 bg-slate-50 dark:bg-slate-955 p-3 rounded-xl">
                                    "{{ $adhkar->translation }}"
                                </p>

                                <!-- Source -->
                                <span class="text-[9px] text-slate-400 font-bold block">
                                    📜 Source: {{ $adhkar->source }}
                                </span>
                            </div>

                            <!-- Interactive Clicker Counter -->
                            <div class="w-full md:w-1/4 flex flex-col items-center justify-center border-t md:border-t-0 md:border-l border-slate-100 dark:border-slate-800 pt-6 md:pt-0 md:pl-6 shrink-0">
                                <span class="text-[10px] font-bold text-slate-450 uppercase tracking-widest mb-3">Taps Counter</span>
                                
                                <button @click="if (count < target) { count++ } else { count = 0 }" 
                                        :class="count >= target ? 'bg-emerald-500 text-white border-emerald-500 scale-105 shadow-emerald-500/20 animate-pulse' : 'bg-slate-50 border-slate-200 text-slate-700 hover:bg-slate-100 dark:bg-slate-950 dark:border-slate-800 dark:text-slate-350'" 
                                        class="w-20 h-20 rounded-full border-2 flex flex-col items-center justify-center transition-all duration-300 shadow-md">
                                    <span class="text-2xl font-black font-mono leading-none" x-text="count">0</span>
                                    <span class="text-[9px] font-bold uppercase tracking-wider mt-0.5 opacity-80" x-text="count >= target ? 'Done!' : '/ ' + target">/ 1</span>
                                </button>
                                
                                <button @click="count = 0" class="text-[10px] text-slate-450 hover:text-slate-600 font-bold mt-3 hover:underline">
                                    Reset Clicker
                                </button>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
