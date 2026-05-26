<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-805 dark:text-slate-100 flex items-center gap-2">
                    📊 Daily Prayer Tracker
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
                    Log and monitor your daily prayers, including congregation status, to build a steady routine.
                </p>
            </div>
            
            <!-- Streak badge -->
            <div class="flex items-center gap-3">
                <div class="px-4 py-2.5 bg-gradient-to-br from-amber-500 to-orange-500 text-white rounded-2xl shadow-sm flex items-center gap-2">
                    <span class="text-lg">🔥</span>
                    <div>
                        <div class="text-[10px] uppercase font-bold tracking-wider opacity-90">Current Streak</div>
                        <div class="text-base font-extrabold leading-none">{{ $streak }} Days</div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Date selector -->
    <div class="mb-8 flex justify-center">
        <form action="{{ route('prayers.tracker') }}" method="GET" class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 p-3 rounded-2xl shadow-sm flex items-center gap-3">
            <span class="text-sm font-semibold text-slate-600 dark:text-slate-400 pl-2">Select Date:</span>
            <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()" class="px-3.5 py-1.5 border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-100 rounded-xl text-sm focus:ring-emerald-500 focus:border-emerald-500 font-semibold">
        </form>
    </div>

    <!-- Prayers list for selected day -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($prayers as $prayer)
            @php
                $log = $logs->get($prayer->id);
                $status = $log ? $log->status : 'unlogged';
            @endphp
            
            <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm flex flex-col justify-between transition hover:shadow-md">
                <div>
                    <!-- Header -->
                    <div class="flex items-center justify-between border-b border-slate-50 dark:border-slate-850 pb-3 mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-slate-850 dark:text-slate-100">{{ $prayer->name }}</h3>
                            <span class="text-xs text-slate-400 font-medium">Fard: {{ $prayer->rakat_fard }} Rakat</span>
                        </div>
                        <span class="font-arabic text-xl font-bold text-emerald-650 dark:text-emerald-450" dir="rtl">
                            {{ $prayer->arabic_name }}
                        </span>
                    </div>

                    <!-- Current Status Badge -->
                    <div class="mb-5 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">Log Status:</span>
                        @if($status === 'prayed')
                            <span class="px-2.5 py-1 text-xs font-bold uppercase rounded-lg bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300">
                                Prayed (Solo)
                            </span>
                        @elseif($status === 'congregation')
                            <span class="px-2.5 py-1 text-xs font-bold uppercase rounded-lg bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-300">
                                Congregation
                            </span>
                        @elseif($status === 'qada')
                            <span class="px-2.5 py-1 text-xs font-bold uppercase rounded-lg bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-300">
                                Qada
                            </span>
                        @elseif($status === 'missed')
                            <span class="px-2.5 py-1 text-xs font-bold uppercase rounded-lg bg-red-50 text-red-700 dark:bg-red-950/40 dark:text-red-300">
                                Missed
                            </span>
                        @else
                            <span class="px-2.5 py-1 text-xs font-bold uppercase rounded-lg bg-slate-100 text-slate-550 dark:bg-slate-850 dark:text-slate-400">
                                Not Logged
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Logger Forms -->
                <div>
                    <form action="{{ route('prayer-logs.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="prayer_id" value="{{ $prayer->id }}">
                        <input type="hidden" name="date" value="{{ $date }}">
                        
                        <div class="grid grid-cols-2 gap-2">
                            <!-- Prayed Solo -->
                            <button type="submit" name="status" value="prayed" class="py-2 text-xs font-bold rounded-xl transition border {{ $status === 'prayed' ? 'bg-emerald-600 text-white border-emerald-600 shadow-sm' : 'bg-slate-50 border-slate-100 text-slate-700 hover:bg-slate-100 dark:bg-slate-950/30 dark:border-slate-850 dark:text-slate-350 dark:hover:bg-slate-800' }}">
                                🙋‍♂️ Prayed (Solo)
                            </button>

                            <!-- Congregation -->
                            <button type="submit" name="status" value="congregation" class="py-2 text-xs font-bold rounded-xl transition border {{ $status === 'congregation' ? 'bg-blue-600 text-white border-blue-600 shadow-sm' : 'bg-slate-50 border-slate-100 text-slate-700 hover:bg-slate-100 dark:bg-slate-950/30 dark:border-slate-850 dark:text-slate-350 dark:hover:bg-slate-800' }}">
                                👥 Congregation
                            </button>

                            <!-- Qada -->
                            <button type="submit" name="status" value="qada" class="py-2 text-xs font-bold rounded-xl transition border {{ $status === 'qada' ? 'bg-amber-600 text-white border-amber-600 shadow-sm' : 'bg-slate-50 border-slate-100 text-slate-700 hover:bg-slate-100 dark:bg-slate-950/30 dark:border-slate-850 dark:text-slate-350 dark:hover:bg-slate-800' }}">
                                ⏳ Qada
                            </button>

                            <!-- Missed -->
                            <button type="submit" name="status" value="missed" class="py-2 text-xs font-bold rounded-xl transition border {{ $status === 'missed' ? 'bg-red-600 text-white border-red-600 shadow-sm' : 'bg-slate-50 border-slate-100 text-slate-700 hover:bg-slate-100 dark:bg-slate-950/30 dark:border-slate-850 dark:text-slate-350 dark:hover:bg-slate-800' }}">
                                ❌ Missed
                            </button>
                        </div>

                        <!-- Notes text input -->
                        <div>
                            <input type="text" name="notes" value="{{ $log ? $log->notes : '' }}" placeholder="Add quick notes (e.g. prayed in mosque, late)..." class="w-full px-3 py-1.5 text-xs border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-955 text-slate-700 dark:text-slate-300 placeholder-slate-400 focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 shadow-inner">
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
