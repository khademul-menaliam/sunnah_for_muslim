<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-805 dark:text-slate-100 flex items-center gap-2">
            🍏 Halal & Tayyib Eating Hub
        </h2>
        <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
            "O mankind, eat from whatever is on earth that is lawful (Halal) and good (Tayyib)" — Surah Al-Baqarah 2:168.
        </p>
    </x-slot>

    <!-- Module Hub Navigation Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <!-- Card 1: Food Checker -->
        <a href="{{ route('eating.foods') }}" class="group bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center gap-4 mb-4">
                <span class="text-3xl p-2 bg-emerald-50 dark:bg-emerald-950/40 rounded-2xl group-hover:scale-110 transition duration-300">🔍</span>
                <div>
                    <h3 class="text-base font-bold text-slate-850 dark:text-slate-100">Halal Food Checker</h3>
                    <span class="text-xs text-slate-450 font-medium">Verify additives, status, and evidence</span>
                </div>
            </div>
            <p class="text-xs text-slate-550 dark:text-slate-450 leading-relaxed mb-4">
                Search our comprehensive database to verify everyday ingredients and additives against Islamic jurisprudence rules.
            </p>
            <span class="text-xs font-bold text-emerald-650 dark:text-emerald-400 flex items-center gap-1 group-hover:underline">
                Open Checker
                <span>→</span>
            </span>
        </a>

        <!-- Card 2: 21 Etiquettes -->
        <a href="{{ route('eating.etiquettes') }}" class="group bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center gap-4 mb-4">
                <span class="text-3xl p-2 bg-teal-50 dark:bg-teal-950/40 rounded-2xl group-hover:scale-110 transition duration-300">🍽️</span>
                <div>
                    <h3 class="text-base font-bold text-slate-850 dark:text-slate-100">21 Eating Etiquettes</h3>
                    <span class="text-xs text-slate-450 font-medium">Learn the Sunnah of dining</span>
                </div>
            </div>
            <p class="text-xs text-slate-550 dark:text-slate-450 leading-relaxed mb-4">
                Review the twenty-one authentic manners, etiquettes, and prohibitions surrounding food and beverage consumption.
            </p>
            <span class="text-xs font-bold text-teal-650 dark:text-teal-400 flex items-center gap-1 group-hover:underline">
                Explore Manners
                <span>→</span>
            </span>
        </a>

        <!-- Card 3: Eating Duas -->
        <a href="{{ route('eating.duas') }}" class="group bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center gap-4 mb-4">
                <span class="text-3xl p-2 bg-amber-50 dark:bg-amber-950/40 rounded-2xl group-hover:scale-110 transition duration-300">🤲</span>
                <div>
                    <h3 class="text-base font-bold text-slate-850 dark:text-slate-100">Eating & Fasting Duas</h3>
                    <span class="text-xs text-slate-450 font-medium">Blessings & supplications</span>
                </div>
            </div>
            <p class="text-xs text-slate-550 dark:text-slate-450 leading-relaxed mb-4">
                Learn, listen, and recite supplications before, during, and after eating, drinking, or breaking fasts.
            </p>
            <span class="text-xs font-bold text-amber-650 dark:text-amber-400 flex items-center gap-1 group-hover:underline">
                View Duas
                <span>→</span>
            </span>
        </a>
    </div>

    <!-- Rule of Thirds Panel & Blessed Superfoods Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Rule of Thirds Graphic -->
        <div class="lg:col-span-1 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-6 shadow-sm">
            <div class="text-center border-b border-slate-50 dark:border-slate-850 pb-4 mb-6">
                <span class="text-xs font-bold uppercase tracking-wider text-teal-650 dark:text-teal-400">Prophetic Moderation</span>
                <h3 class="text-lg font-bold text-slate-855 dark:text-slate-100 mt-0.5">📏 Rule of Thirds</h3>
                <p class="text-xs text-slate-500 font-medium mt-1">Based on the authentic Miqdam ibn Ma'dikarib narration.</p>
            </div>

            <!-- Visual Bar Representation -->
            <div class="flex flex-col gap-4 mb-6">
                <!-- Food Third -->
                <div class="p-3 rounded-2xl bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-100 dark:border-emerald-900/60 shadow-inner">
                    <div class="flex justify-between items-center text-xs mb-1.5 font-bold">
                        <span class="text-emerald-800 dark:text-emerald-300">1/3 Food Portion</span>
                        <span class="text-emerald-700 dark:text-emerald-450">33.3% capacity</span>
                    </div>
                    <div class="w-full h-2.5 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                        <div class="h-full bg-emerald-500 rounded-full" style="width: 33.3%"></div>
                    </div>
                </div>

                <!-- Water Third -->
                <div class="p-3 rounded-2xl bg-blue-50 dark:bg-blue-950/20 border border-blue-100 dark:border-blue-900/60 shadow-inner">
                    <div class="flex justify-between items-center text-xs mb-1.5 font-bold">
                        <span class="text-blue-800 dark:text-blue-300">1/3 Water Portion</span>
                        <span class="text-blue-700 dark:text-blue-450">33.3% capacity</span>
                    </div>
                    <div class="w-full h-2.5 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                        <div class="h-full bg-blue-500 rounded-full" style="width: 33.3%"></div>
                    </div>
                </div>

                <!-- Air Third -->
                <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-950/20 border border-slate-150 dark:border-slate-900 shadow-inner">
                    <div class="flex justify-between items-center text-xs mb-1.5 font-bold">
                        <span class="text-slate-700 dark:text-slate-350 font-semibold">1/3 Air (Free Space)</span>
                        <span class="text-slate-500">33.3% capacity</span>
                    </div>
                    <div class="w-full h-2.5 rounded-full bg-slate-200 dark:bg-slate-800 overflow-hidden">
                        <div class="h-full bg-slate-400 rounded-full" style="width: 33.3%"></div>
                    </div>
                </div>
            </div>

            <!-- Hadith snippet -->
            <p class="text-xs text-slate-500 leading-relaxed font-semibold italic text-center p-3 rounded-xl bg-slate-50 dark:bg-slate-950/30">
                "A human being fills no vessel worse than his stomach. It is sufficient for a human being to eat a few mouthfuls to keep his spine straight..."
            </p>
        </div>

        <!-- Blessed Quranic Foods Slider/Showcase -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-6 shadow-sm">
            <h3 class="text-base font-bold text-slate-800 dark:text-slate-105 mb-6 border-b border-slate-50 dark:border-slate-850 pb-3">
                ⭐ Blessed Quranic Superfoods
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($foods as $food)
                    <div class="p-4 rounded-2xl border border-slate-100 dark:border-slate-850 hover:border-emerald-100 transition duration-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-extrabold text-slate-800 dark:text-slate-150">{{ $food->name }}</h4>
                                <span class="font-arabic text-emerald-650 dark:text-emerald-450 font-bold" dir="rtl">{{ $food->arabic_name }}</span>
                            </div>
                            <p class="text-xs text-slate-550 dark:text-slate-450 leading-relaxed mb-3">
                                {{ $food->reason }}
                            </p>
                        </div>
                        @if($food->quran_reference)
                            <div class="pt-2 border-t border-slate-50 dark:border-slate-850 text-[10px] text-slate-400 font-semibold tracking-tight">
                                📖 Quran: {{ $food->quran_reference }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>
