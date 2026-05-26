<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100">
            🕒 Prayer Times Calculator
        </h2>
        <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
            Track precise prayer times based on your geographical location, calculation method, and school of thought.
        </p>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Settings Form -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm sticky top-24">
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 border-b border-slate-50 dark:border-slate-850 pb-3 mb-5">
                    Configure Location & School
                </h3>

                <form action="{{ route('prayer-times.index') }}" method="GET" class="space-y-4">
                    <!-- City -->
                    <div>
                        <label class="block text-xs font-bold text-slate-550 dark:text-slate-400 uppercase tracking-wider mb-1.5">City</label>
                        <input type="text" name="city" value="{{ $locationInfo['city'] }}" required class="w-full px-4 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-950 text-sm focus:ring-emerald-500 focus:border-emerald-500 font-semibold">
                    </div>

                    <!-- Country -->
                    <div>
                        <label class="block text-xs font-bold text-slate-550 dark:text-slate-400 uppercase tracking-wider mb-1.5">Country</label>
                        <input type="text" name="country" value="{{ $locationInfo['country'] }}" required class="w-full px-4 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-950 text-sm focus:ring-emerald-500 focus:border-emerald-500 font-semibold">
                    </div>

                    <!-- Hidden Lat/Lng to support fallback coordinates -->
                    <input type="hidden" name="lat" value="{{ $locationInfo['latitude'] }}">
                    <input type="hidden" name="lng" value="{{ $locationInfo['longitude'] }}">

                    <!-- Jurisprudential School -->
                    <div>
                        <label class="block text-xs font-bold text-slate-550 dark:text-slate-400 uppercase tracking-wider mb-1.5">School (Madhab)</label>
                        <select name="madhab" class="w-full px-4 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-955 text-sm focus:ring-emerald-500 focus:border-emerald-500 font-semibold">
                            <option value="Hanafi" {{ $locationInfo['madhab'] === 'Hanafi' ? 'selected' : '' }}>Hanafi (Later Asr)</option>
                            <option value="Standard" {{ $locationInfo['madhab'] !== 'Hanafi' ? 'selected' : '' }}>Standard/Shafi/Maliki/Hanbali (Earlier Asr)</option>
                        </select>
                    </div>

                    <!-- Calculation Method -->
                    <div>
                        <label class="block text-xs font-bold text-slate-550 dark:text-slate-400 uppercase tracking-wider mb-1.5">Calculation Method</label>
                        <select name="method" class="w-full px-4 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-955 text-sm focus:ring-emerald-500 focus:border-emerald-500 font-semibold">
                            <option value="Karachi" {{ $locationInfo['method'] === 'Karachi' ? 'selected' : '' }}>University of Islamic Sciences, Karachi</option>
                            <option value="ISNA" {{ $locationInfo['method'] === 'ISNA' ? 'selected' : '' }}>Islamic Society of North America (ISNA)</option>
                            <option value="MWL" {{ $locationInfo['method'] === 'MWL' ? 'selected' : '' }}>Muslim World League (MWL)</option>
                            <option value="Makkah" {{ $locationInfo['method'] === 'Makkah' ? 'selected' : '' }}>Umm al-Qura University, Makkah</option>
                            <option value="Egypt" {{ $locationInfo['method'] === 'Egypt' ? 'selected' : '' }}>Egyptian General Authority of Survey</option>
                            <option value="Gulf" {{ $locationInfo['method'] === 'Gulf' ? 'selected' : '' }}>Gulf Region</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-sm shadow-sm transition">
                        Update Timings
                    </button>
                </form>
            </div>
        </div>

        <!-- Times Timeline Display -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm">
                <!-- Header details -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-slate-50 dark:border-slate-850 pb-4 mb-6 gap-3">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-650 dark:text-emerald-400">Current Location</span>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">
                            📍 {{ $locationInfo['city'] }}, {{ $locationInfo['country'] }}
                        </h3>
                    </div>
                    <div class="text-right">
                        <span class="text-xs text-slate-400 font-medium">Source Basis</span>
                        <p class="text-xs font-bold text-slate-700 dark:text-slate-350 bg-slate-100 dark:bg-slate-800 px-2.5 py-1 rounded-lg mt-0.5 inline-block">
                            {{ $timings['source'] }}
                        </p>
                    </div>
                </div>

                <!-- Timings List Timeline -->
                <div class="space-y-4">
                    <!-- Fajr -->
                    <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 dark:border-slate-850 bg-slate-50/50 dark:bg-slate-950/20 hover:border-emerald-100 transition duration-200">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">🌅</span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-150">Fajr (Dawn)</h4>
                                <span class="text-[10px] text-slate-400">Starts before sunrise</span>
                            </div>
                        </div>
                        <span class="text-lg font-extrabold text-slate-850 dark:text-slate-100 bg-white dark:bg-slate-900 px-3.5 py-1.5 rounded-xl border border-slate-100 dark:border-slate-800/60 shadow-sm">
                            {{ $timings['fajr'] }}
                        </span>
                    </div>

                    <!-- Sunrise -->
                    <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 dark:border-slate-850 bg-slate-50/50 dark:bg-slate-950/20 opacity-70">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">☀️</span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-150">Sunrise</h4>
                                <span class="text-[10px] text-slate-400">End of Fajr time</span>
                            </div>
                        </div>
                        <span class="text-lg font-extrabold text-slate-850 dark:text-slate-100 bg-white dark:bg-slate-900 px-3.5 py-1.5 rounded-xl border border-slate-100 dark:border-slate-800/60 shadow-sm">
                            {{ $timings['sunrise'] ?? '05:40' }}
                        </span>
                    </div>

                    <!-- Dhuhr -->
                    <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 dark:border-slate-850 bg-slate-50/50 dark:bg-slate-950/20 hover:border-emerald-100 transition duration-200">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">☀️</span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-150">Dhuhr (Midday)</h4>
                                <span class="text-[10px] text-slate-400">Just after noon zenith</span>
                            </div>
                        </div>
                        <span class="text-lg font-extrabold text-slate-850 dark:text-slate-100 bg-white dark:bg-slate-900 px-3.5 py-1.5 rounded-xl border border-slate-100 dark:border-slate-800/60 shadow-sm">
                            {{ $timings['dhuhr'] }}
                        </span>
                    </div>

                    <!-- Asr -->
                    <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 dark:border-slate-850 bg-slate-50/50 dark:bg-slate-950/20 hover:border-emerald-100 transition duration-200">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">🌤️</span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-150">Asr (Afternoon)</h4>
                                <span class="text-[10px] text-slate-400">Based on shadows ({{ $locationInfo['madhab'] }})</span>
                            </div>
                        </div>
                        <span class="text-lg font-extrabold text-slate-850 dark:text-slate-100 bg-white dark:bg-slate-900 px-3.5 py-1.5 rounded-xl border border-slate-100 dark:border-slate-800/60 shadow-sm">
                            {{ $timings['asr'] }}
                        </span>
                    </div>

                    <!-- Maghrib -->
                    <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 dark:border-slate-850 bg-slate-50/50 dark:bg-slate-950/20 hover:border-emerald-100 transition duration-200">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">🌅</span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-150">Maghrib (Sunset)</h4>
                                <span class="text-[10px] text-slate-400">Immediately after sunset</span>
                            </div>
                        </div>
                        <span class="text-lg font-extrabold text-slate-850 dark:text-slate-100 bg-white dark:bg-slate-900 px-3.5 py-1.5 rounded-xl border border-slate-100 dark:border-slate-800/60 shadow-sm">
                            {{ $timings['maghrib'] }}
                        </span>
                    </div>

                    <!-- Isha -->
                    <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 dark:border-slate-850 bg-slate-50/50 dark:bg-slate-950/20 hover:border-emerald-100 transition duration-200">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">🌌</span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-150">Isha (Night)</h4>
                                <span class="text-[10px] text-slate-400">When red twilight disappears</span>
                            </div>
                        </div>
                        <span class="text-lg font-extrabold text-slate-850 dark:text-slate-100 bg-white dark:bg-slate-900 px-3.5 py-1.5 rounded-xl border border-slate-100 dark:border-slate-800/60 shadow-sm">
                            {{ $timings['isha'] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
