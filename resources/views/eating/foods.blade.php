<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <a href="{{ route('eating.index') }}" class="text-xs font-bold text-emerald-650 hover:underline dark:text-emerald-400 mb-1 inline-block">← Back to Eating Hub</a>
                <h2 class="text-2xl font-bold text-slate-805 dark:text-slate-100 flex items-center gap-2">
                    🔍 Halal Food & Ingredient Checker
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
                    Check if ingredients, additives, or foods are lawful (Halal), unlawful (Haram), or doubtful (Shubhat).
                </p>
            </div>
            
            <!-- Food search Form -->
            <form action="{{ route('eating.foods') }}" method="GET" class="w-full md:w-auto flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search food, ingredient, E-number..." class="w-full md:w-72 px-4 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-900 text-sm focus:ring-emerald-500 focus:border-emerald-500 font-semibold shadow-inner">
                <button type="submit" class="px-4.5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-sm shadow-sm transition">
                    Check
                </button>
            </form>
        </div>
    </x-slot>

    <!-- Filters -->
    <div class="mb-8 flex flex-wrap gap-2">
        <a href="{{ route('eating.foods') }}" class="px-3.5 py-1.5 text-xs font-bold rounded-lg border {{ !request('status') ? 'bg-emerald-650 text-white border-emerald-650' : 'bg-white dark:bg-slate-900 text-slate-650 border-slate-100 dark:border-slate-800 hover:bg-slate-50' }}">
            All Items
        </a>
        <a href="{{ route('eating.foods', ['status' => 'halal']) }}" class="px-3.5 py-1.5 text-xs font-bold rounded-lg border {{ request('status') === 'halal' ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white dark:bg-slate-900 text-slate-650 border-slate-100 dark:border-slate-800 hover:bg-slate-50' }}">
            🍏 Halal & Blessed Foods
        </a>
        <a href="{{ route('eating.foods', ['status' => 'haram']) }}" class="px-3.5 py-1.5 text-xs font-bold rounded-lg border {{ request('status') === 'haram' ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white dark:bg-slate-900 text-slate-650 border-slate-100 dark:border-slate-800 hover:bg-slate-50' }}">
            ❌ Haram (Forbidden)
        </a>
        <a href="{{ route('eating.foods', ['status' => 'doubtful']) }}" class="px-3.5 py-1.5 text-xs font-bold rounded-lg border {{ request('status') === 'doubtful' ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white dark:bg-slate-900 text-slate-650 border-slate-100 dark:border-slate-800 hover:bg-slate-50' }}">
            ⚠️ Doubtful (Shubhat)
        </a>
        <a href="{{ route('eating.foods', ['status' => 'makruh']) }}" class="px-3.5 py-1.5 text-xs font-bold rounded-lg border {{ request('status') === 'makruh' ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white dark:bg-slate-900 text-slate-650 border-slate-100 dark:border-slate-800 hover:bg-slate-50' }}">
            🍂 Makruh (Disliked)
        </a>
    </div>

    <!-- Results -->
    @if($allFoods->isEmpty())
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-12 text-center">
            <span class="text-4xl">🔎</span>
            <h3 class="text-lg font-bold text-slate-700 dark:text-slate-300 mt-4">No results matches your check</h3>
            <p class="text-sm text-slate-550 mt-1">If in absolute doubt, avoid it! "Leave that which makes you doubt for that which does not make you doubt."</p>
            <a href="{{ route('eating.foods') }}" class="inline-block mt-4 px-4 py-2 bg-emerald-600 text-white text-xs font-bold rounded-xl shadow-sm hover:bg-emerald-700 transition">Reset Search</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($allFoods as $food)
                <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/80 rounded-3xl p-6 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <!-- Header with Status Badge -->
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-base font-bold text-slate-850 dark:text-slate-100">{{ $food->name }}</h3>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ $food->category }}</span>
                            </div>
                            
                            @if($food->status === 'halal')
                                <span class="px-2.5 py-1 text-xs font-extrabold rounded-lg bg-emerald-50 text-emerald-800 dark:bg-emerald-950/40 dark:text-emerald-300 border border-emerald-100/50">
                                    HALAL
                                </span>
                            @elseif($food->status === 'haram')
                                <span class="px-2.5 py-1 text-xs font-extrabold rounded-lg bg-red-50 text-red-800 dark:bg-red-950/40 dark:text-red-300 border border-red-100/50">
                                    HARAM
                                </span>
                            @elseif($food->status === 'doubtful')
                                <span class="px-2.5 py-1 text-xs font-extrabold rounded-lg bg-amber-50 text-amber-800 dark:bg-amber-950/40 dark:text-amber-300 border border-amber-100/50">
                                    DOUBTFUL
                                </span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-extrabold rounded-lg bg-slate-100 text-slate-805 dark:bg-slate-800 dark:text-slate-350 border border-slate-200">
                                    MAKRUH
                                </span>
                            @endif
                        </div>

                        <!-- Arabic Translation -->
                        @if($food->arabic_name)
                            <div class="mb-3 text-right" dir="rtl">
                                <span class="font-arabic text-lg text-emerald-650 dark:text-emerald-450 font-bold">{{ $food->arabic_name }}</span>
                            </div>
                        @endif

                        <!-- Detailed Explanation -->
                        <p class="text-xs text-slate-650 dark:text-slate-350 leading-relaxed mb-5">
                            {{ $food->reason }}
                        </p>
                    </div>

                    <!-- Scriptural Evidences -->
                    <div class="pt-4 border-t border-slate-50 dark:border-slate-850 flex flex-wrap gap-2 items-center justify-between text-[10px] text-slate-400 font-bold tracking-tight">
                        <div>
                            @if($food->quran_reference)
                                <span class="inline-block bg-slate-50 dark:bg-slate-950/30 px-2 py-0.5 rounded border border-slate-100 dark:border-slate-850">
                                    📖 Quran: {{ $food->quran_reference }}
                                </span>
                            @endif
                        </div>
                        
                        @if($food->hadith)
                            <a href="{{ route('hadiths.show', $food->hadith->id) }}" class="text-emerald-650 dark:text-emerald-400 hover:underline">
                                🔗 Hadith: {{ $food->hadith->source }}
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
