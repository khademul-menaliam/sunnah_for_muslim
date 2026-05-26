<x-app-layout>
    <x-slot name="header">
        <div>
            <a href="{{ route('income.index') }}" class="text-xs font-bold text-emerald-650 hover:underline dark:text-emerald-400 mb-1 inline-block">← Back to Income Center</a>
            <h2 class="text-2xl font-bold text-slate-805 dark:text-slate-100 flex items-center gap-2">
                📖 Islamic Finance Concepts Glossary
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
                Explore the primary forms of Shariah-compliant trade, investments, insurance, and lending structures.
            </p>
        </div>
    </x-slot>

    <!-- Concepts Grid -->
    <div class="space-y-8 max-w-4xl mx-auto">
        @foreach($concepts as $cp)
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-850 rounded-3xl p-6 shadow-sm hover:shadow-md transition">
                
                <!-- Header with Arabic -->
                <div class="flex items-center justify-between border-b border-slate-50 dark:border-slate-850 pb-3 mb-4">
                    <h3 class="text-base font-extrabold text-slate-855 dark:text-slate-100 flex items-center gap-2">
                        <span>🏷️</span> {{ $cp->name }}
                    </h3>
                    <span class="font-arabic text-xl text-emerald-650 dark:text-emerald-450 font-bold" dir="rtl">
                        {{ $cp->arabic_name }}
                    </span>
                </div>

                <!-- Explanation / Description -->
                <p class="text-xs text-slate-655 dark:text-slate-350 leading-relaxed mb-5 font-semibold">
                    {{ $cp->description }}
                </p>

                <!-- Practical Real-World Example Box -->
                <div class="mb-5 p-4 rounded-2xl bg-slate-50 dark:bg-slate-955 border border-slate-100 dark:border-slate-900">
                    <span class="text-[9px] font-black uppercase tracking-wider text-emerald-650 dark:text-emerald-450 block mb-1.5">💼 Practical Application Example</span>
                    <p class="text-xs text-slate-650 dark:text-slate-350 leading-relaxed font-semibold">
                        {{ $cp->example }}
                    </p>
                </div>

                <!-- Scriptural Evidences -->
                @if($cp->hadith)
                    <div class="pt-3 border-t border-slate-50 dark:border-slate-850 flex items-center justify-between text-[10px] text-slate-400 font-bold">
                        <span>Narrator: {{ $cp->hadith->narrator }}</span>
                        <a href="{{ route('hadiths.show', $cp->hadith->id) }}" class="text-emerald-650 dark:text-emerald-400 hover:underline flex items-center gap-0.5">
                            Check Hadith Context ({{ $cp->hadith->source }})
                            <span>→</span>
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>
