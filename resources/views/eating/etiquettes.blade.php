<x-app-layout>
    <x-slot name="header">
        <div>
            <a href="{{ route('eating.index') }}" class="text-xs font-bold text-emerald-650 hover:underline dark:text-emerald-400 mb-1 inline-block">← Back to Eating Hub</a>
            <h2 class="text-2xl font-bold text-slate-805 dark:text-slate-100 flex items-center gap-2">
                🍽️ 21 Prophetic Eating Etiquettes
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
                Explore the complete etiquette, sunnahs, and prohibitions surrounding food and water consumption.
            </p>
        </div>
    </x-slot>

    <!-- Etiquettes list -->
    <div class="space-y-6 max-w-4xl mx-auto">
        @foreach($etiquettes as $et)
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-md transition flex gap-4 md:gap-6 items-start">
                
                <!-- Circular Ordered Index -->
                <span class="w-10 h-10 rounded-full bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 font-extrabold text-sm flex items-center justify-center shrink-0 shadow-sm border border-emerald-100 dark:border-emerald-900">
                    {{ $et->order_number }}
                </span>

                <div class="w-full">
                    <!-- Title & Type Badge -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-3 gap-2">
                        <h3 class="text-base font-bold text-slate-850 dark:text-slate-100">{{ $et->title }}</h3>
                        
                        @if($et->type === 'sunnah')
                            <span class="px-2 py-0.5 text-[9px] font-black uppercase rounded bg-emerald-50 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400 border border-emerald-100/50 self-start">
                                Sunnah
                            </span>
                        @elseif($et->type === 'prohibition')
                            <span class="px-2 py-0.5 text-[9px] font-black uppercase rounded bg-red-50 text-red-750 dark:bg-red-950/30 dark:text-red-400 border border-red-100/50 self-start">
                                Prohibition
                            </span>
                        @else
                            <span class="px-2 py-0.5 text-[9px] font-black uppercase rounded bg-blue-50 text-blue-755 dark:bg-blue-950/30 dark:text-blue-400 border border-blue-100/50 self-start">
                                Adab / Manner
                            </span>
                        @endif
                    </div>

                    <!-- Explanatory Description -->
                    <p class="text-xs text-slate-650 dark:text-slate-350 leading-relaxed mb-4">
                        {{ $et->description }}
                    </p>

                    <!-- Arabic phrase inline if exists -->
                    @if($et->arabic_text)
                        <div class="mb-4 p-3 rounded-xl bg-slate-50 dark:bg-slate-950/30 border border-slate-150/60 dark:border-slate-850/50 text-right" dir="rtl">
                            <span class="font-arabic text-lg font-bold text-emerald-650 dark:text-emerald-450 leading-none select-all">{{ $et->arabic_text }}</span>
                        </div>
                    @endif

                    <!-- Scriptural Hadith Link -->
                    @if($et->hadith)
                        <div class="pt-3 border-t border-slate-50 dark:border-slate-850 flex items-center justify-between text-[10px] text-slate-400 font-bold">
                            <span>Narrator: {{ $et->hadith->narrator }}</span>
                            <a href="{{ route('hadiths.show', $et->hadith->id) }}" class="text-emerald-650 dark:text-emerald-400 hover:underline flex items-center gap-0.5">
                                Read Authentic Hadith ({{ $et->hadith->source }})
                                <span>→</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
