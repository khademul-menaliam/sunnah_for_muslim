<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-100 flex items-center gap-2">
                    📚 Hadith Repository
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">
                    Explore {{ \App\Models\Hadith::count() }} authentic narrations of the Prophet Muhammad ﷺ guiding our daily life.
                </p>
            </div>
            
            <!-- Quick search form -->
            <form action="{{ route('hadiths.index') }}" method="GET" class="w-full md:w-auto flex gap-2">
                <input type="text" name="topic" value="{{ request('topic') }}" placeholder="Search by topic (e.g., sleep, charity)..." class="w-full md:w-72 px-4 py-2 border border-slate-200 dark:border-slate-800 rounded-xl bg-white dark:bg-slate-900 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold text-sm transition shadow-sm">
                    Search
                </button>
            </form>
        </div>
    </x-slot>

    <!-- Module filters -->
    <div class="mb-8 flex flex-wrap gap-2">
        <a href="{{ route('hadiths.index') }}" class="px-4 py-2 text-sm font-semibold rounded-xl transition {{ !request('module') ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white dark:bg-slate-900 text-slate-650 hover:bg-slate-50 border border-slate-100 dark:border-slate-800' }}">
            All Hadiths
        </a>
        <a href="{{ route('hadiths.index', ['module' => 'prayer']) }}" class="px-4 py-2 text-sm font-semibold rounded-xl transition {{ request('module') === 'prayer' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white dark:bg-slate-900 text-slate-650 hover:bg-slate-50 border border-slate-100 dark:border-slate-800' }}">
            🕌 Daily Prayers
        </a>
        <a href="{{ route('hadiths.index', ['module' => 'eating']) }}" class="px-4 py-2 text-sm font-semibold rounded-xl transition {{ request('module') === 'eating' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white dark:bg-slate-900 text-slate-650 hover:bg-slate-50 border border-slate-100 dark:border-slate-800' }}">
            🍏 Halal Eating
        </a>
        <a href="{{ route('hadiths.index', ['module' => 'sunnah']) }}" class="px-4 py-2 text-sm font-semibold rounded-xl transition {{ request('module') === 'sunnah' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white dark:bg-slate-900 text-slate-650 hover:bg-slate-50 border border-slate-100 dark:border-slate-800' }}">
            ✨ Daily Sunnahs
        </a>
        <a href="{{ route('hadiths.index', ['module' => 'income']) }}" class="px-4 py-2 text-sm font-semibold rounded-xl transition {{ request('module') === 'income' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white dark:bg-slate-900 text-slate-650 hover:bg-slate-50 border border-slate-100 dark:border-slate-800' }}">
            💼 Halal Income
        </a>
    </div>

    <!-- Hadiths Listing -->
    @if($hadiths->isEmpty())
        <div class="bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-12 text-center shadow-sm">
            <span class="text-4xl">🔍</span>
            <h3 class="text-lg font-bold mt-4 text-slate-700 dark:text-slate-300">No Hadiths Found</h3>
            <p class="text-sm text-slate-500 dark:text-slate-450 mt-1">Try clearing your filters or altering your search text.</p>
            <a href="{{ route('hadiths.index') }}" class="inline-block mt-4 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition">
                Reset Filters
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 gap-6">
            @foreach($hadiths as $hadith)
                <x-hadith-card :hadith="$hadith" />
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $hadiths->appends(request()->query())->links() }}
        </div>
    @endif
</x-app-layout>
