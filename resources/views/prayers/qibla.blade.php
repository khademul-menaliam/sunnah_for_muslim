<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-805 dark:text-slate-100 flex items-center gap-2">
            🧭 Qibla Compass Finder
        </h2>
        <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
            Find the exact direction of the Kaaba (Makkah) from your current location using astronomical calculations.
        </p>
    </x-slot>

    <div class="max-w-4xl mx-auto py-4 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <!-- Visual Compass -->
        <div class="flex flex-col items-center justify-center bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-8 shadow-sm">
            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-6">Visual Direction</h3>
            
            <!-- Beautiful compass graphic container -->
            <div class="relative w-64 h-64 md:w-72 md:h-72 bg-slate-50 dark:bg-slate-950/40 rounded-full border-4 border-emerald-500/10 dark:border-emerald-500/5 shadow-inner flex items-center justify-center">
                <!-- Cardinal directions (N, E, S, W) -->
                <span class="absolute top-3 font-extrabold text-sm text-red-500">N</span>
                <span class="absolute right-3 font-extrabold text-sm text-slate-400">E</span>
                <span class="absolute bottom-3 font-extrabold text-sm text-slate-400">S</span>
                <span class="absolute left-3 font-extrabold text-sm text-slate-400">W</span>

                <!-- Compass central dial (Outer Ring) -->
                <div class="w-48 h-48 md:w-56 md:h-56 rounded-full border border-dashed border-slate-200 dark:border-slate-800 flex items-center justify-center relative">
                    <!-- Qibla Direction Needle -->
                    <div class="absolute w-full h-full flex items-center justify-center transition-all duration-700" style="transform: rotate({{ $qiblaDegree }}deg)">
                        <!-- Beautiful pointer -->
                        <div class="relative w-full h-full flex items-center justify-center">
                            <!-- Kaaba miniature badge at target angle -->
                            <div class="absolute -top-7 text-3xl animate-bounce">
                                🕋
                            </div>
                            
                            <!-- Arrow pointer line -->
                            <div class="w-1.5 h-20 md:h-24 bg-gradient-to-t from-transparent via-emerald-500 to-emerald-600 rounded-full shadow-md relative">
                                <div class="absolute -top-1 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[6px] border-l-transparent border-r-[6px] border-r-transparent border-b-[8px] border-b-emerald-600"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Center hub -->
                <div class="absolute w-4 h-4 rounded-full bg-slate-800 dark:bg-slate-200 border-2 border-white dark:border-slate-900 shadow-md z-10"></div>
            </div>

            <!-- Compass Stats -->
            <div class="mt-8 text-center">
                <span class="text-xs text-slate-400 uppercase tracking-widest block font-bold mb-1">Kaaba Direction Angle</span>
                <span class="text-3xl font-black text-emerald-650 dark:text-emerald-400 font-mono">
                    {{ round($qiblaDegree, 2) }}°
                </span>
                <span class="text-xs text-slate-500 font-medium block mt-1">Bearing from North (Clockwise)</span>
            </div>
        </div>

        <!-- Information and custom check -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-6 shadow-sm">
                <h4 class="text-base font-bold text-slate-800 dark:text-slate-105 mb-4 border-b border-slate-50 dark:border-slate-850 pb-2">
                    📍 Location Details
                </h4>
                <div class="grid grid-cols-2 gap-4 text-xs font-semibold">
                    <div class="bg-slate-50 dark:bg-slate-950/20 p-3 rounded-xl">
                        <span class="text-slate-400 block mb-0.5">Latitude</span>
                        <span class="text-slate-700 dark:text-slate-350 text-sm font-mono">{{ $latitude }}</span>
                    </div>
                    <div class="bg-slate-50 dark:bg-slate-950/20 p-3 rounded-xl">
                        <span class="text-slate-400 block mb-0.5">Longitude</span>
                        <span class="text-slate-700 dark:text-slate-350 text-sm font-mono">{{ $longitude }}</span>
                    </div>
                </div>
                <p class="text-xs text-slate-500 mt-4 leading-relaxed font-medium">
                    *Based on {{ $city }}. The angle represents the shortest spherical path (great circle) between your coordinates and the Holy Kaaba in Makkah.
                </p>
            </div>

            <div class="bg-emerald-50/50 dark:bg-emerald-950/20 border border-emerald-100 dark:border-emerald-900/60 rounded-3xl p-6 shadow-sm">
                <h4 class="text-sm font-bold text-emerald-800 dark:text-emerald-350 flex items-center gap-1.5 mb-2">
                    <span>💡</span> How to Align your Compass
                </h4>
                <ol class="list-decimal pl-4 text-xs text-emerald-900/80 dark:text-emerald-300/80 space-y-2.5 leading-relaxed font-semibold">
                    <li>Hold your smartphone or computer screen perfectly flat relative to the ground.</li>
                    <li>Determine which way is physical North (using a magnetic compass app or tracking sunrise/sunset).</li>
                    <li>Point the top of your device directly towards North.</li>
                    <li>The Kaaba icon 🕋 on the graphic above now indicates the exact direction of the Kaaba relative to your stance!</li>
                </ol>
            </div>
        </div>
    </div>
</x-app-layout>
