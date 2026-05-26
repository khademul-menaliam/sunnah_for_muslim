<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-805 dark:text-slate-100 flex items-center gap-2">
                    💼 Halal Income & Career Center
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
                    "O you who have believed, spend from the good things which you have earned..." — Surah Al-Baqarah 2:267.
                </p>
            </div>
            
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('income.zakat') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-sm shadow-sm transition flex items-center gap-1.5">
                    🧮 Zakat Calculator
                </a>
                <a href="{{ route('income.finance') }}" class="px-4 py-2 bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 text-slate-700 dark:text-slate-350 rounded-xl font-bold text-sm hover:bg-slate-50 transition">
                    📖 Finance Glossary
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Career Lookup Checker Section -->
    <div class="mb-12">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-slate-55 dark:border-slate-850 pb-4 mb-6 gap-3">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-150 flex items-center gap-2 border-l-4 border-emerald-600 pl-3">
                🔍 Shariah Career & Industry Checker
            </h3>
            
            <!-- Quick Search Form -->
            <form action="{{ route('income.index') }}" method="GET" class="flex gap-2 w-full md:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search industry, career, job title..." class="w-full md:w-72 px-4 py-1.5 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-900 text-xs focus:ring-emerald-500 focus:border-emerald-500 font-semibold shadow-inner">
                <button type="submit" class="px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-xs shadow-sm transition">
                    Check
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($jobs as $job)
                <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/80 rounded-3xl p-6 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h4 class="text-sm font-extrabold text-slate-850 dark:text-slate-100 leading-snug">{{ $job->title }}</h4>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ $job->industry }}</span>
                            </div>

                            @if($job->category === 'halal')
                                <span class="px-2.5 py-0.5 text-[9px] font-black rounded bg-emerald-50 text-emerald-850 dark:bg-emerald-950/40 dark:text-emerald-400 border border-emerald-100/50">HALAL</span>
                            @elseif($job->category === 'haram')
                                <span class="px-2.5 py-0.5 text-[9px] font-black rounded bg-red-50 text-red-850 dark:bg-red-950/40 dark:text-red-400 border border-red-100/50">HARAM</span>
                            @else
                                <span class="px-2.5 py-0.5 text-[9px] font-black rounded bg-amber-50 text-amber-850 dark:bg-amber-950/40 dark:text-amber-400 border border-amber-100/50">DOUBTFUL</span>
                            @endif
                        </div>

                        <p class="text-xs text-slate-650 dark:text-slate-350 leading-relaxed mb-5">
                            {{ $job->explanation }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-50 dark:border-slate-850 flex items-center justify-between text-[10px] text-slate-400 font-bold">
                        <span>
                            @if($job->quran_reference)
                                📖 Quran Reference
                            @endif
                        </span>
                        @if($job->hadith)
                            <a href="{{ route('hadiths.show', $job->hadith->id) }}" class="text-emerald-650 dark:text-emerald-400 hover:underline">
                                🔗 Hadith Evidence ({{ $job->hadith->source }}) →
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Islamic Business Ethics Principles Table -->
    <div>
        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-150 mb-6 flex items-center gap-2 border-l-4 border-emerald-600 pl-3">
            ⚖️ Prophetic Principles of Business & Ethics
        </h3>

        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-950/50 text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100 dark:border-slate-800">
                        <th class="p-4">Ethical Principle</th>
                        <th class="p-4 w-32">Classification</th>
                        <th class="p-4 w-56 text-right">Scriptural Reference</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-850">
                    @foreach($ethics as $et)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-950/30 transition font-semibold">
                            <td class="p-4 text-slate-700 dark:text-slate-300 leading-relaxed">
                                {{ $et->principle }}
                            </td>
                            <td class="p-4">
                                @if($et->category === 'recommended')
                                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-100/50">Encouraged</span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full bg-red-50 text-red-800 border border-red-100/50">Prohibited</span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                @if($et->quran_reference)
                                    <span class="block text-slate-450 text-[10px]">📖 Quran: {{ $et->quran_reference }}</span>
                                @endif
                                @if($et->hadith)
                                    <a href="{{ route('hadiths.show', $et->hadith->id) }}" class="inline-block text-emerald-650 dark:text-emerald-400 hover:underline text-[10px] mt-0.5">
                                        🔗 Hadith: {{ $et->hadith->source }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
