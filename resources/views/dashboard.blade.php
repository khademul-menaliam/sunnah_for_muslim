<x-app-layout>
    <!-- Welcome Header / Prayer Countdown Banner -->
    <div class="mb-8 p-6 rounded-3xl bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-650 text-white shadow-lg flex flex-col md:flex-row md:items-center md:justify-between gap-6 relative overflow-hidden">
        <!-- Abstract background glow shapes -->
        <div class="absolute -right-10 -bottom-10 w-40 h-40 rounded-full bg-white/5 blur-2xl"></div>
        <div class="absolute right-20 top-2 w-28 h-28 rounded-full bg-white/10 blur-xl"></div>
        
        <div class="relative z-10">
            <span class="text-xs font-black uppercase tracking-widest bg-emerald-500/30 px-3 py-1 rounded-full border border-emerald-400/30">Assalamu Alaikum</span>
            <h2 class="text-2xl font-black mt-2">Welcome, {{ Auth::user()->name }}!</h2>
            <p class="text-sm text-emerald-100 font-semibold mt-1">Keep track of your Islamic daily habits and maintain your spiritual progress.</p>
        </div>

        <!-- Next Prayer Countdown Box -->
        <div class="bg-white/15 backdrop-blur-md border border-white/20 p-4.5 rounded-2xl shrink-0 text-center relative z-10">
            <span class="text-[10px] font-black uppercase tracking-wider text-emerald-200">Next Obligatory Salah</span>
            <div class="text-2xl font-black mt-0.5 tracking-tight font-sans">{{ $nextPrayerName }}</div>
            <div class="text-xs font-bold font-mono bg-emerald-950/40 text-emerald-200 px-3 py-1 rounded-lg mt-2 inline-block">
                at {{ $nextPrayerTime }}
            </div>
        </div>
    </div>

    <!-- Quick Navigation Shortcuts -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('prayers.tracker') }}" class="p-4 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm text-center block group hover:shadow-md transition">
            <span class="text-2xl group-hover:scale-110 transition duration-300 block mb-1.5">🕌</span>
            <span class="text-xs font-extrabold text-slate-800 dark:text-slate-200 block">Salah Tracker</span>
        </a>
        <a href="{{ route('eating.index') }}" class="p-4 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm text-center block group hover:shadow-md transition">
            <span class="text-2xl group-hover:scale-110 transition duration-300 block mb-1.5">🍏</span>
            <span class="text-xs font-extrabold text-slate-800 dark:text-slate-200 block">Halal Eating</span>
        </a>
        <a href="{{ route('sunnahs.index') }}" class="p-4 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm text-center block group hover:shadow-md transition">
            <span class="text-2xl group-hover:scale-110 transition duration-300 block mb-1.5">✨</span>
            <span class="text-xs font-extrabold text-slate-800 dark:text-slate-200 block">Sunnah Checklist</span>
        </a>
        <a href="{{ route('income.index') }}" class="p-4 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl shadow-sm text-center block group hover:shadow-md transition">
            <span class="text-2xl group-hover:scale-110 transition duration-300 block mb-1.5">💼</span>
            <span class="text-xs font-extrabold text-slate-800 dark:text-slate-200 block">Halal Rizq</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Left: Today's Salah & Progress Tracker -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Today's Salah Times -->
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/80 rounded-3xl p-6 shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-50 dark:border-slate-850 pb-3.5 mb-4">
                    <h3 class="text-sm font-bold text-slate-850 dark:text-slate-100">📅 Today's Salah Timings</h3>
                    <a href="{{ route('prayer-times.index') }}" class="text-[10px] font-bold text-emerald-650 dark:text-emerald-400 hover:underline">Full Details</a>
                </div>

                <div class="space-y-2.5">
                    @foreach($timings as $name => $time)
                        @php
                            // Approximate Fajr is 1, Dhuhr 2, Asr 3, Maghrib 4, Isha 5
                            $pIdMap = ['Fajr' => 1, 'Dhuhr' => 2, 'Asr' => 3, 'Maghrib' => 4, 'Isha' => 5];
                            $pId = $pIdMap[$name] ?? 0;
                            $logStatus = $prayerLogs[$pId] ?? 'unlogged';
                        @endphp
                        
                        <div class="flex items-center justify-between p-3 rounded-xl border border-slate-100 dark:border-slate-850 bg-slate-50/50 dark:bg-slate-950/20">
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ $name }}</span>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold font-mono text-slate-550 dark:text-slate-400 bg-white dark:bg-slate-900 px-2.5 py-1 rounded-lg border border-slate-100 dark:border-slate-800/80 shadow-sm">{{ $time }}</span>
                                
                                <!-- Status Dot Indicator -->
                                @if($logStatus === 'prayed' || $logStatus === 'congregation')
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-sm" title="Prayed"></span>
                                @elseif($logStatus === 'qada')
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500 shadow-sm" title="Qada"></span>
                                @elseif($logStatus === 'missed')
                                    <span class="w-2.5 h-2.5 rounded-full bg-red-500 shadow-sm" title="Missed"></span>
                                @else
                                    <span class="w-2.5 h-2.5 rounded-full bg-slate-350 dark:bg-slate-700 shadow-sm" title="Unlogged"></span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Today's Sunnah checklist Progress dial -->
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/80 rounded-3xl p-6 shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-50 dark:border-slate-850 pb-3.5 mb-5">
                    <h3 class="text-sm font-bold text-slate-850 dark:text-slate-100">✨ Sunnah Practices Progress</h3>
                    <a href="{{ route('sunnahs.index') }}" class="text-[10px] font-bold text-emerald-650 dark:text-emerald-400 hover:underline">Track Daily</a>
                </div>

                <div class="flex items-center gap-6">
                    <!-- Progress circle visual -->
                    <div class="relative w-20 h-20 bg-slate-50 dark:bg-slate-950 rounded-full flex items-center justify-center border border-slate-100 dark:border-slate-900 shadow-inner shrink-0">
                        <span class="text-lg font-black font-mono text-emerald-650 dark:text-emerald-450 leading-none">
                            {{ $sunnahProgress }}%
                        </span>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Checked Today</span>
                        <div class="text-lg font-extrabold text-slate-805 dark:text-slate-205 mt-0.5">{{ $completedSunnahs }} / {{ $totalSunnahs }} Completed</div>
                        <p class="text-[11px] text-slate-500 font-semibold mt-1">Strive to complete daily habits to keep up with the Sunnah.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Hadith of the Day -->
        <div class="lg:col-span-2 space-y-6">
            <h3 class="text-base font-bold text-slate-800 dark:text-slate-150 flex items-center gap-2 border-l-4 border-emerald-600 pl-3">
                ⭐ Featured Hadith of the Day
            </h3>
            
            @if($hadithOfDay)
                <x-hadith-card :hadith="$hadithOfDay" class="!shadow-md border-emerald-100" />
            @else
                <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-8 text-center text-slate-455">
                    Loading daily wisdom...
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
