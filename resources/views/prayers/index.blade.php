<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100 flex items-center gap-2">
                    🕌 Daily & Special Prayers Guide
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
                    Understand the structural count, significance, and authentic scriptural basis of the Fard and Sunnah prayers.
                </p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('prayers.tracker') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold text-sm transition shadow-sm flex items-center gap-1.5">
                    📊 Prayer Tracker
                </a>
                <a href="{{ route('prayer-times.index') }}" class="px-4 py-2 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 text-slate-700 dark:text-slate-300 rounded-xl font-semibold text-sm transition hover:bg-slate-50">
                    🕒 Prayer Times Calculator
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Five Daily Prayers Grid -->
    <div class="mb-12">
        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-150 mb-6 flex items-center gap-2 border-l-4 border-emerald-600 pl-3">
            The Five Obligatory (Fard) Prayers
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($prayers as $prayer)
                <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <!-- Header with Arabic -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-2.5">
                                <span class="w-7 h-7 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 font-bold text-xs flex items-center justify-center shadow-sm">
                                    {{ $prayer->order_number }}
                                </span>
                                <h4 class="text-lg font-bold text-slate-850 dark:text-slate-100">{{ $prayer->name }}</h4>
                            </div>
                            <span class="font-arabic text-xl text-emerald-650 dark:text-emerald-450 font-bold" dir="rtl">
                                {{ $prayer->arabic_name }}
                            </span>
                        </div>

                        <!-- Rakat Count Badges -->
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-emerald-50 text-emerald-800 dark:bg-emerald-950/40 dark:text-emerald-300 border border-emerald-100/50">
                                {{ $prayer->rakat_fard }} Fard
                            </span>
                            @if($prayer->rakat_sunnah_before > 0)
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-teal-50 text-teal-800 dark:bg-teal-950/40 dark:text-teal-300 border border-teal-100/50">
                                    {{ $prayer->rakat_sunnah_before }} Sunnah Before
                                </span>
                            @endif
                            @if($prayer->rakat_sunnah_after > 0)
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-blue-50 text-blue-800 dark:bg-blue-950/40 dark:text-blue-300 border border-blue-100/50">
                                    {{ $prayer->rakat_sunnah_after }} Sunnah After
                                </span>
                            @endif
                            @if($prayer->rakat_nafl > 0)
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-lg bg-slate-50 text-slate-700 dark:bg-slate-800 dark:text-slate-350 border border-slate-100">
                                    {{ $prayer->rakat_nafl }} Nafl
                                </span>
                            @endif
                        </div>

                        <!-- Description & Significance -->
                        <div class="space-y-3 mb-6">
                            <div>
                                <h5 class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Time Window</h5>
                                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">{{ $prayer->time_window_description }}</p>
                            </div>
                            <div>
                                <h5 class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Spiritual Merit</h5>
                                <p class="text-xs text-slate-550 dark:text-slate-450 leading-relaxed italic">{{ Str::limit($prayer->significance, 180) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Action -->
                    <div class="pt-4 border-t border-slate-50 dark:border-slate-850 flex items-center justify-between">
                        <a href="{{ route('prayers.show', $prayer->id) }}" class="text-xs font-bold text-emerald-650 hover:text-emerald-700 dark:text-emerald-450 flex items-center gap-1">
                            View Hadiths & Complete Details
                            <span>→</span>
                        </a>
                        <span class="px-2 py-0.5 rounded bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-350 text-[10px] font-bold">
                            {{ $prayer->hadiths->count() }} Hadiths
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Special / Voluntary Prayers Section -->
    <div>
        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-150 mb-6 flex items-center gap-2 border-l-4 border-emerald-600 pl-3">
            Special, Sunnah Mu'akkadah & Voluntary Prayers
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($specialPrayers as $sp)
                <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-base font-bold text-slate-850 dark:text-slate-100 flex items-center gap-2">
                            <span>✨</span> {{ $sp->name }}
                        </h4>
                        <span class="px-2.5 py-1 text-xs font-bold uppercase rounded-lg bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-300">
                            {{ $sp->type }}
                        </span>
                    </div>
                    
                    <p class="text-xs text-slate-600 dark:text-slate-405 leading-relaxed mb-4">
                        {{ $sp->description }}
                    </p>

                    @if($sp->hadith)
                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-950/30 border border-slate-100 dark:border-slate-900">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-650 dark:text-emerald-400 block mb-1">Authentic Scriptural Basis</span>
                            <p class="text-xs text-slate-650 dark:text-slate-450 italic leading-relaxed">
                                "{{ Str::limit($sp->hadith->translation, 170) }}"
                            </p>
                            <div class="flex items-center justify-between mt-2.5 pt-2 border-t border-slate-200/50 dark:border-slate-850">
                                <span class="text-[10px] text-slate-500 font-medium">Narrated by: {{ $sp->hadith->narrator }}</span>
                                <a href="{{ route('hadiths.show', $sp->hadith->id) }}" class="text-[10px] font-bold text-emerald-650 dark:text-emerald-400 hover:underline">
                                    View Full Hadith
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
