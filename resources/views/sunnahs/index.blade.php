<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-805 dark:text-slate-100 flex items-center gap-2">
                    ✨ Daily Sunnah Checklist
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
                    "Say, if you love Allah, then follow me; Allah will love you and forgive you your sins" — Surah Ali 'Imran 3:31.
                </p>
            </div>
            
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('adhkar.index') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-sm shadow-sm transition flex items-center gap-1.5">
                    📿 Adhkar & Dhikr Library
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Difficulty / Practice Mode Toggle and Date Selector -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8 items-center">
        <!-- Date Selector -->
        <div class="lg:col-span-1 flex justify-start">
            <form action="{{ route('sunnahs.index') }}" method="GET" class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 p-2.5 rounded-2xl shadow-sm flex items-center gap-3">
                <span class="text-xs font-bold text-slate-550 pl-2">Track Date:</span>
                <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()" class="px-3 py-1.5 border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-850 dark:text-slate-150 rounded-xl text-xs focus:ring-emerald-500 focus:border-emerald-500 font-bold">
                <!-- Keep existing filters -->
                @if(request('difficulty')) <input type="hidden" name="difficulty" value="{{ request('difficulty') }}"> @endif
                @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
            </form>
        </div>

        <!-- Beginner vs Advanced Mode Toggle -->
        <div class="lg:col-span-2 flex justify-end gap-2">
            <span class="text-xs font-bold text-slate-400 self-center uppercase tracking-wider mr-2">Practice Level:</span>
            
            <a href="{{ route('sunnahs.index', array_merge(request()->query(), ['difficulty' => 'easy'])) }}" class="px-4 py-2 text-xs font-extrabold rounded-xl border transition {{ request('difficulty') === 'easy' ? 'bg-emerald-650 text-white border-emerald-650 shadow-sm' : 'bg-white dark:bg-slate-900 text-slate-655 border-slate-150 dark:border-slate-800 hover:bg-slate-50' }}">
                🌱 Beginner (Easy only)
            </a>
            
            <a href="{{ route('sunnahs.index', array_merge(request()->query(), ['difficulty' => ''])) }}" class="px-4 py-2 text-xs font-extrabold rounded-xl border transition {{ !request('difficulty') ? 'bg-emerald-650 text-white border-emerald-650 shadow-sm' : 'bg-white dark:bg-slate-900 text-slate-655 border-slate-150 dark:border-slate-800 hover:bg-slate-50' }}">
                🚀 Advanced (All levels)
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Checklist Area -->
        <div class="lg:col-span-2 space-y-4">
            <!-- Category Filters -->
            <div class="flex flex-wrap gap-1.5 pb-2 border-b border-slate-100 dark:border-slate-850 mb-4">
                @php $cats = ['sleep' => '🛌 Sleep', 'hygiene' => '🧼 Hygiene', 'eating' => '🍏 Eating', 'social' => '🤝 Social', 'worship' => '🕌 Worship', 'travel' => '🚗 Travel', 'general' => '✨ General']; @endphp
                <a href="{{ route('sunnahs.index', array_merge(request()->query(), ['category' => ''])) }}" class="px-2.5 py-1 text-xs font-bold rounded-lg transition {{ !request('category') ? 'bg-slate-100 dark:bg-slate-800 text-slate-805' : 'text-slate-400 hover:bg-slate-50' }}">
                    All Categories
                </a>
                @foreach($cats as $k => $label)
                    <a href="{{ route('sunnahs.index', array_merge(request()->query(), ['category' => $k])) }}" class="px-2.5 py-1 text-xs font-bold rounded-lg transition {{ request('category') === $k ? 'bg-slate-100 dark:bg-slate-800 text-slate-805' : 'text-slate-400 hover:bg-slate-50' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <!-- Sunnah checklist cards -->
            @if($sunnahs->isEmpty())
                <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-12 text-center">
                    <span class="text-3xl">🌴</span>
                    <h4 class="text-sm font-bold text-slate-700 dark:text-slate-300 mt-4">No Sunnahs match the level/filters</h4>
                    <p class="text-xs text-slate-450 mt-1">Try switching to Advanced mode or clearing your category filters.</p>
                </div>
            @else
                @foreach($sunnahs as $sunnah)
                    @php
                        $isCompleted = in_array($sunnah->id, $logs);
                    @endphp
                    
                    <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/80 rounded-3xl p-5 shadow-sm hover:shadow-md transition flex items-start gap-4">
                        <!-- Toggle Checkbox Form -->
                        <form action="{{ route('sunnah-logs.store') }}" method="POST" class="shrink-0 pt-0.5">
                            @csrf
                            <input type="hidden" name="sunnah_id" value="{{ $sunnah->id }}">
                            <input type="hidden" name="date" value="{{ $date }}">
                            <input type="hidden" name="completed" value="{{ $isCompleted ? 0 : 1 }}">
                            
                            <button type="submit" class="w-7 h-7 rounded-xl border flex items-center justify-center transition shadow-inner {{ $isCompleted ? 'bg-emerald-500 border-emerald-500 text-white hover:bg-emerald-600' : 'bg-slate-50 border-slate-200 dark:bg-slate-950 dark:border-slate-800 hover:bg-slate-100' }}">
                                @if($isCompleted)
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                @endif
                            </button>
                        </form>

                        <div class="w-full">
                            <!-- Title & Badges -->
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-1.5">
                                <h3 class="text-sm font-bold text-slate-850 dark:text-slate-100 flex items-center gap-1.5">
                                    {{ $sunnah->title }}
                                </h3>
                                
                                <div class="flex gap-1">
                                    <span class="px-2 py-0.5 text-[9px] font-bold uppercase rounded bg-slate-50 text-slate-500 dark:bg-slate-800 dark:text-slate-400 border border-slate-100 dark:border-slate-850">
                                        {{ $sunnah->category }}
                                    </span>
                                    
                                    @if($sunnah->difficulty === 'easy')
                                        <span class="px-2 py-0.5 text-[9px] font-bold uppercase rounded bg-emerald-50 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400 border border-emerald-100/50">
                                            Easy
                                        </span>
                                    @elseif($sunnah->difficulty === 'medium')
                                        <span class="px-2 py-0.5 text-[9px] font-bold uppercase rounded bg-amber-50 text-amber-700 dark:bg-amber-950/30 dark:text-amber-400 border border-amber-100/50">
                                            Medium
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 text-[9px] font-bold uppercase rounded bg-red-50 text-red-700 dark:bg-red-950/30 dark:text-red-400 border border-red-100/50">
                                            Advanced
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Description -->
                            <p class="text-xs text-slate-550 dark:text-slate-400 leading-relaxed mb-3">
                                {{ $sunnah->description }}
                            </p>

                            <!-- Authentic Hadith Link -->
                            @if($sunnah->hadith)
                                <div class="flex justify-between items-center text-[10px] text-slate-400 font-bold border-t border-slate-50 dark:border-slate-850 pt-2.5">
                                    <span>Narrator: {{ $sunnah->hadith->narrator }}</span>
                                    <a href="{{ route('hadiths.show', $sunnah->hadith->id) }}" class="text-emerald-650 dark:text-emerald-400 hover:underline">
                                        📚 Hadith context ({{ $sunnah->hadith->source }}) →
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Charts and Progress Bar -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-6 shadow-sm">
                <div class="text-center border-b border-slate-50 dark:border-slate-850 pb-4 mb-6">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-650 dark:text-emerald-400">Weekly Progress</span>
                    <h3 class="text-base font-bold text-slate-855 dark:text-slate-100 mt-0.5">📊 Completion Rate</h3>
                    <p class="text-xs text-slate-400 mt-1">Percentage of daily sunnahs checked over the last 7 days.</p>
                </div>

                <!-- Pure Tailwind Custom Bar Graph -->
                <div class="flex items-end justify-between h-44 px-2 pt-4 pb-2 bg-slate-50 dark:bg-slate-950/30 rounded-2xl border border-slate-100 dark:border-slate-900 shadow-inner">
                    @foreach($weeklyProgress as $p)
                        <div class="flex flex-col items-center gap-1.5 w-8 group">
                            <!-- Tooltip percentage on hover -->
                            <div class="hidden group-hover:block absolute -mt-10 bg-slate-800 text-white text-[10px] font-black px-1.5 py-0.5 rounded shadow-md z-10 font-mono">
                                {{ $p['percentage'] }}%
                            </div>
                            
                            <!-- Bar height relative to percentage -->
                            <div class="w-4 rounded-t-lg bg-emerald-500 transition-all duration-500 hover:bg-emerald-600 shadow-sm" style="height: {{ max(4, $p['percentage']) }}%"></div>
                            
                            <span class="text-[9px] font-bold text-slate-450 uppercase">{{ $p['day'] }}</span>
                        </div>
                    @endforeach
                </div>
                
                <div class="flex justify-between items-center text-[10px] text-slate-400 font-bold px-1 mt-4">
                    <span>Mon - Sun</span>
                    <span class="text-slate-550 dark:text-slate-350">Avg Completion</span>
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
