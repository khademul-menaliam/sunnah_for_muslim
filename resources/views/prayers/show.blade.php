<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('prayers.index') }}" class="p-1.5 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition text-slate-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100 flex items-center gap-2">
                    {{ $prayer->name }} Details
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-450 mt-0.5">
                    Explore its structural rakats and Shariah significance.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar stats -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm">
                <div class="text-center pb-6 border-b border-slate-100 dark:border-slate-800 mb-6">
                    <span class="font-arabic text-4xl text-emerald-600 font-bold block mb-2">{{ $prayer->arabic_name }}</span>
                    <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100">{{ $prayer->name }}</h3>
                    <span class="text-xs text-slate-400 font-medium">Order of the Day: {{ $prayer->order_number }}</span>
                </div>

                <h4 class="text-sm font-bold text-slate-805 dark:text-slate-200 mb-4 uppercase tracking-wider">Rakat Breakdown</h4>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 rounded-xl bg-emerald-50/50 dark:bg-emerald-950/20 text-sm font-semibold">
                        <span class="text-emerald-800 dark:text-emerald-300">Fard (Obligatory)</span>
                        <span class="px-2.5 py-0.5 rounded bg-emerald-600 text-white text-xs">{{ $prayer->rakat_fard }} Rakat</span>
                    </div>
                    @if($prayer->rakat_sunnah_before > 0)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-teal-50/50 dark:bg-teal-950/20 text-sm font-semibold">
                            <span class="text-teal-800 dark:text-teal-300">Sunnah Before Fard</span>
                            <span class="px-2.5 py-0.5 rounded bg-teal-600 text-white text-xs">{{ $prayer->rakat_sunnah_before }} Rakat</span>
                        </div>
                    @endif
                    @if($prayer->rakat_sunnah_after > 0)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-blue-50/50 dark:bg-blue-950/20 text-sm font-semibold">
                            <span class="text-blue-800 dark:text-blue-300">Sunnah After Fard</span>
                            <span class="px-2.5 py-0.5 rounded bg-blue-600 text-white text-xs">{{ $prayer->rakat_sunnah_after }} Rakat</span>
                        </div>
                    @endif
                    @if($prayer->rakat_nafl > 0)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 dark:bg-slate-800 text-sm font-semibold">
                            <span class="text-slate-700 dark:text-slate-350">Nafl (Voluntary)</span>
                            <span class="px-2.5 py-0.5 rounded bg-slate-650 text-white text-xs">{{ $prayer->rakat_nafl }} Rakat</span>
                        </div>
                    @endif
                </div>

                @if($prayer->special_notes)
                    <div class="mt-6 p-4 rounded-xl bg-amber-50/40 dark:bg-amber-950/25 border border-amber-100 dark:border-amber-900/60">
                        <span class="text-[10px] font-bold text-amber-800 dark:text-amber-300 uppercase block mb-1">Recitation Notes</span>
                        <p class="text-xs text-amber-900/80 dark:text-amber-300/80 leading-relaxed">{{ $prayer->special_notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Main details -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm">
                <h4 class="text-base font-bold text-slate-850 dark:text-slate-105 mb-4 border-b pb-3 border-slate-100 dark:border-slate-850">
                    Spiritual Importance & Timings
                </h4>
                <div class="space-y-4 text-sm leading-relaxed text-slate-650 dark:text-slate-350">
                    <div>
                        <strong class="text-slate-800 dark:text-slate-200 block mb-1">Time Range:</strong>
                        <p>{{ $prayer->time_window_description }}</p>
                    </div>
                    <div>
                        <strong class="text-slate-800 dark:text-slate-200 block mb-1">Significance & Merits:</strong>
                        <p>{{ $prayer->significance }}</p>
                    </div>
                </div>
            </div>

            <!-- Linked Hadiths -->
            <div>
                <h4 class="text-base font-bold text-slate-850 dark:text-slate-150 mb-4 flex items-center gap-2">
                    📚 Scriptural References ({{ $prayer->hadiths->count() }})
                </h4>

                @if($prayer->hadiths->isEmpty())
                    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-8 text-center text-slate-400">
                        No specific hadith linked yet.
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach($prayer->hadiths as $hadith)
                            <x-hadith-card :hadith="$hadith" class="border-l-4 border-l-emerald-500" />
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
