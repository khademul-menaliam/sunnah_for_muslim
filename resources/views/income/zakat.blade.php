<x-app-layout>
    <x-slot name="header">
        <div>
            <a href="{{ route('income.index') }}" class="text-xs font-bold text-emerald-650 hover:underline dark:text-emerald-400 mb-1 inline-block">← Back to Income Center</a>
            <h2 class="text-2xl font-bold text-slate-805 dark:text-slate-100 flex items-center gap-2">
                🧮 Shariah Zakat Calculator & Center
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
                "Take, [O Muhammad], from their wealth a charity by which you purify them and cause them increase..." — Surah At-Tawbah 9:103.
            </p>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Calculator Form & Results -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/80 rounded-3xl p-6 shadow-sm">
                <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 border-b border-slate-55 dark:border-slate-850 pb-3 mb-5">
                    🧮 Zakat Obligation Calculator
                </h3>

                <form action="{{ route('income.zakat.calculate') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Cash savings -->
                        <div>
                            <label class="block text-xs font-bold text-slate-550 dark:text-slate-400 uppercase tracking-wider mb-1.5">Cash & Savings ($)</label>
                            <input type="number" step="0.01" name="cash_savings" value="{{ old('cash_savings', $results['cash'] ?? 0) }}" required class="w-full px-4 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-950 text-sm focus:ring-emerald-500 focus:border-emerald-500 font-bold shadow-inner">
                            <span class="text-[9px] text-slate-400 mt-1 block">Cash in hand, bank accounts, liquid investments.</span>
                        </div>

                        <!-- Business assets -->
                        <div>
                            <label class="block text-xs font-bold text-slate-550 dark:text-slate-400 uppercase tracking-wider mb-1.5">Business Assets & Inventory ($)</label>
                            <input type="number" step="0.01" name="business_assets" value="{{ old('business_assets', $results['business_assets'] ?? 0) }}" required class="w-full px-4 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-950 text-sm focus:ring-emerald-500 focus:border-emerald-500 font-bold shadow-inner">
                            <span class="text-[9px] text-slate-400 mt-1 block">Value of merchandise, shop stock, shares value.</span>
                        </div>

                        <!-- Gold weight & price -->
                        <div class="bg-slate-50/50 dark:bg-slate-950/20 p-4 rounded-2xl border border-slate-100 dark:border-slate-850/60">
                            <label class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-2">⭐ Gold Holdings</label>
                            <div class="space-y-3">
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400">Weight (grams)</span>
                                    <input type="number" step="0.01" name="gold_weight" value="{{ old('gold_weight', 0) }}" required class="w-full px-3 py-1.5 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-900 text-xs focus:ring-emerald-500 focus:border-emerald-500 font-bold">
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400">Current Price per gram ($)</span>
                                    <input type="number" step="0.01" name="gold_price" value="{{ old('gold_price', 75) }}" required class="w-full px-3 py-1.5 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-900 text-xs focus:ring-emerald-500 focus:border-emerald-500 font-bold font-mono">
                                </div>
                            </div>
                        </div>

                        <!-- Silver weight & price -->
                        <div class="bg-slate-50/50 dark:bg-slate-950/20 p-4 rounded-2xl border border-slate-100 dark:border-slate-850/60">
                            <label class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-2">💿 Silver Holdings</label>
                            <div class="space-y-3">
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400">Weight (grams)</span>
                                    <input type="number" step="0.01" name="silver_weight" value="{{ old('silver_weight', 0) }}" required class="w-full px-3 py-1.5 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-900 text-xs focus:ring-emerald-500 focus:border-emerald-500 font-bold">
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400">Current Price per gram ($)</span>
                                    <input type="number" step="0.01" name="silver_price" value="{{ old('silver_price', 1) }}" required class="w-full px-3 py-1.5 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-900 text-xs focus:ring-emerald-500 focus:border-emerald-500 font-bold font-mono">
                                </div>
                            </div>
                        </div>

                        <!-- Receivables -->
                        <div>
                            <label class="block text-xs font-bold text-slate-550 dark:text-slate-450 uppercase tracking-wider mb-1.5">Money Owed to You ($)</label>
                            <input type="number" step="0.01" name="receivables" value="{{ old('receivables', $results['receivables'] ?? 0) }}" required class="w-full px-4 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-950 text-sm focus:ring-emerald-500 focus:border-emerald-500 font-bold shadow-inner">
                            <span class="text-[9px] text-slate-400 mt-1 block">Collectable loans extended, receivables due.</span>
                        </div>

                        <!-- Liabilities -->
                        <div>
                            <label class="block text-xs font-bold text-slate-550 dark:text-slate-455 uppercase tracking-wider mb-1.5">Liabilities & Debts ($)</label>
                            <input type="number" step="0.01" name="liabilities" value="{{ old('liabilities', $results['liabilities'] ?? 0) }}" required class="w-full px-4 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-955 text-sm focus:ring-emerald-500 focus:border-emerald-500 font-bold shadow-inner">
                            <span class="text-[9px] text-slate-400 mt-1 block">Outstanding short-term debts, house bills, employee wages.</span>
                        </div>
                    </div>

                    <!-- Nisab basis selection -->
                    <div class="p-4 bg-slate-50 dark:bg-slate-950/20 border border-slate-100 dark:border-slate-850 rounded-2xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-350 block">Select Nisab Threshold Basis</span>
                            <span class="text-[10px] text-slate-400 font-medium">Gold basis (87.48g) is standard; Silver basis (612.36g) is more beneficial for the poor.</span>
                        </div>
                        
                        <div class="flex gap-4 shrink-0">
                            <label class="inline-flex items-center text-xs font-bold text-slate-700 dark:text-slate-300">
                                <input type="radio" name="nisab_basis" value="gold" {{ old('nisab_basis', $results['nisab_basis'] ?? 'gold') === 'gold' ? 'checked' : '' }} class="mr-1.5 text-emerald-600 focus:ring-emerald-500">
                                Gold (87.48g)
                            </label>
                            <label class="inline-flex items-center text-xs font-bold text-slate-700 dark:text-slate-300">
                                <input type="radio" name="nisab_basis" value="silver" {{ old('nisab_basis', $results['nisab_basis'] ?? '') === 'silver' ? 'checked' : '' }} class="mr-1.5 text-emerald-600 focus:ring-emerald-500">
                                Silver (612.36g)
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-550 dark:text-slate-400 uppercase tracking-wider mb-1.5">Calculation Notes / Year</label>
                        <input type="text" name="notes" placeholder="e.g. Ramadan Zakat 2026..." class="w-full px-4 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-950 text-sm focus:ring-emerald-500 focus:border-emerald-500 font-semibold shadow-inner">
                    </div>

                    <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-sm shadow-sm transition">
                        Calculate Zakat Due
                    </button>
                </form>
            </div>

            <!-- Calculation Results View -->
            @if(isset($results))
                <div class="bg-white dark:bg-slate-900 border border-emerald-100 dark:border-emerald-950 rounded-3xl p-6 shadow-md animate-fade-in relative overflow-hidden">
                    <!-- Ribbon -->
                    <div class="absolute top-0 right-0 h-16 w-16">
                        <div class="absolute transform rotate-45 bg-emerald-500 text-white text-[9px] font-black text-center py-1 w-28 -right-8 top-3 uppercase shadow-sm">
                            Result
                        </div>
                    </div>
                    
                    <h3 class="text-base font-bold text-slate-850 dark:text-slate-100 border-b pb-3 mb-5 border-slate-50">
                        📊 Calculation Summary
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-950/20 text-center font-bold">
                            <span class="text-[10px] text-slate-400 block uppercase tracking-wider mb-1">Total Assets</span>
                            <span class="text-lg text-slate-800 dark:text-slate-200 font-mono">${{ number_format($results['total_assets'], 2) }}</span>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-955 text-center font-bold">
                            <span class="text-[10px] text-slate-400 block uppercase tracking-wider mb-1">Net Zakatable Assets</span>
                            <span class="text-lg text-slate-805 dark:text-slate-200 font-mono">${{ number_format($results['net_zakatable'], 2) }}</span>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-955 text-center font-bold">
                            <span class="text-[10px] text-slate-400 block uppercase tracking-wider mb-1">Nisab Threshold</span>
                            <span class="text-lg text-slate-805 dark:text-slate-200 font-mono">${{ number_format($results['nisab_threshold'], 2) }}</span>
                        </div>
                    </div>

                    <div class="p-6 rounded-2xl text-center shadow-inner border border-dashed {{ $results['eligible'] ? 'bg-emerald-50/50 dark:bg-emerald-950/20 border-emerald-300' : 'bg-slate-50 border-slate-200 text-slate-500' }}">
                        <span class="text-xs font-extrabold uppercase tracking-widest block mb-1">Zakat Obligation</span>
                        @if($results['eligible'])
                            <span class="text-4xl font-black text-emerald-650 dark:text-emerald-400 font-mono block mb-2">
                                font-mono ${{ number_format($results['zakat_due'], 2) }}
                            </span>
                            <span class="text-xs text-emerald-800 dark:text-emerald-300 font-bold block">
                                ✅ Zakat is obligatory. Your net assets exceed the Nisab threshold.
                            </span>
                        @else
                            <span class="text-4xl font-black text-slate-400 dark:text-slate-600 block mb-2 font-mono">
                                $0.00
                            </span>
                            <span class="text-xs text-slate-500 font-semibold block">
                                ❌ Zakat is not obligatory. Your net assets ($<span>{{ number_format($results['net_zakatable'], 2) }}</span>) are below the Nisab threshold ($<span>{{ number_format($results['nisab_threshold'], 2) }}</span>).
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Historical logs Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Nisab Threshold details box -->
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-6 shadow-sm">
                <h4 class="text-xs font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider mb-4 border-b border-slate-50 pb-2">
                    ⚖️ Nisab Guideline
                </h4>
                <div class="space-y-4 text-xs font-semibold leading-relaxed text-slate-655 dark:text-slate-350">
                    <p>
                        Zakat is obligatory only when net savings reach or exceed the minimum threshold value, known as <strong>Nisab</strong>, held consecutively for one lunar year (Hawl).
                    </p>
                    <ul class="list-disc pl-4 space-y-1.5">
                        <li><strong>Gold Nisab Basis:</strong> Value equivalent to 87.48 grams of pure gold.</li>
                        <li><strong>Silver Nisab Basis:</strong> Value equivalent to 612.36 grams of pure silver.</li>
                    </ul>
                </div>
            </div>

            <!-- Historical calculations -->
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-3xl p-6 shadow-sm">
                <h4 class="text-xs font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider mb-4 border-b border-slate-50 pb-2">
                    ⏳ Calculation History
                </h4>
                @if(empty($history))
                    <p class="text-xs text-slate-400 text-center font-medium">No calculations logged yet.</p>
                @else
                    <div class="space-y-3 max-h-80 overflow-y-auto">
                        @foreach($history as $h)
                            <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-950/20 border border-slate-150/60 dark:border-slate-850/60 text-xs flex justify-between items-center font-bold">
                                <div>
                                    <span class="block text-[10px] text-slate-400">{{ $h->created_at->format('M d, Y') }}</span>
                                    <span class="text-slate-700 dark:text-slate-355">{{ $h->notes ?? 'Calculation' }}</span>
                                </div>
                                <span class="font-mono text-emerald-650 dark:text-emerald-400">${{ number_format($h->zakat_due, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- Eligible Recipients Categories (Surah At-Tawbah 9:60) -->
    <div class="mt-12">
        <h3 class="text-lg font-bold text-slate-805 dark:text-slate-150 mb-6 flex items-center gap-2 border-l-4 border-emerald-600 pl-3">
            📦 The Eight Eligible Recipients of Zakat (Asnaf)
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $recipients = [
                    ['arabic' => 'الفقراء', 'name' => 'Al-Fuqara (The Poor)', 'description' => 'Those who do not have any property or livelihood to support their basic needs.'],
                    ['arabic' => 'المساكين', 'name' => 'Al-Masakin (The Needy)', 'description' => 'Those who have some income but it is insufficient to cover their core expenses.'],
                    ['arabic' => 'العاملين عليها', 'name' => 'Al-Amilina \'Alayha', 'description' => 'Those authorized to collect, manage, and distribute the Zakat funds.'],
                    ['arabic' => 'المؤلفة قلوبهم', 'name' => 'Al-Mu\'allafah', 'description' => 'Those whose hearts are to be reconciled or inclined towards Islam.'],
                    ['arabic' => 'في الرقاب', 'name' => 'Fir-Riqab (Captives)', 'description' => 'To aid in liberating captives, slaves, or victims of human trafficking.'],
                    ['arabic' => 'الغارمين', 'name' => 'Al-Gharimin (Debtors)', 'description' => 'Those overwhelmed by debt incurred for basic needs or community welfare.'],
                    ['arabic' => 'في سبيل الله', 'name' => 'Fi Sabilillah', 'description' => 'Those striving in the path of Allah for community welfare and education.'],
                    ['arabic' => 'ابن السبيل', 'name' => 'Ibnus-Sabil (Wayfarer)', 'description' => 'Stranded travelers who do not have enough funds to reach their home safely.']
                ];
            @endphp

            @foreach($recipients as $rc)
                <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-5 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <span class="font-arabic text-lg text-emerald-650 dark:text-emerald-450 font-bold" dir="rtl">{{ $rc['arabic'] }}</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    </div>
                    <h4 class="text-xs font-black text-slate-850 dark:text-slate-100 mb-2">{{ $rc['name'] }}</h4>
                    <p class="text-[11px] text-slate-550 dark:text-slate-450 leading-relaxed font-semibold">
                        {{ $rc['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
