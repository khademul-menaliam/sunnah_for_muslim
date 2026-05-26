<nav x-data="{ open: false }" class="bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800 shadow-sm sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-emerald-600 to-teal-500 bg-clip-text text-transparent flex items-center">
                            <span class="text-2xl mr-1">🕌</span> Sunnah Life
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-sm font-medium">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('prayers.tracker')" :active="request()->routeIs('prayers.*') || request()->routeIs('prayer-times.*') || request()->routeIs('qibla.*')" class="text-sm font-medium">
                        {{ __('Prayers') }}
                    </x-nav-link>

                    <x-nav-link :href="route('eating.index')" :active="request()->routeIs('eating.*')" class="text-sm font-medium">
                        {{ __('Halal Eating') }}
                    </x-nav-link>

                    <x-nav-link :href="route('sunnahs.index')" :active="request()->routeIs('sunnahs.*') || request()->routeIs('adhkar.*')" class="text-sm font-medium">
                        {{ __('Sunnah Checklist') }}
                    </x-nav-link>

                    <x-nav-link :href="route('income.index')" :active="request()->routeIs('income.*')" class="text-sm font-medium">
                        {{ __('Halal Rizq') }}
                    </x-nav-link>

                    <x-nav-link :href="route('hadiths.index')" :active="request()->routeIs('hadiths.*')" class="text-sm font-medium">
                        {{ __('Hadith Library') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown / Guest buttons -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3.5 py-2 border border-slate-100 dark:border-slate-800 text-sm leading-4 font-semibold rounded-xl text-slate-650 dark:text-slate-350 bg-slate-50 dark:bg-slate-950/30 hover:text-slate-800 dark:hover:text-slate-100 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                                <span class="mr-1">👤</span>
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1.5">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="font-medium">
                                {{ __('Profile & Settings') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="font-medium text-red-650 dark:text-red-400">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="px-3.5 py-1.5 text-xs font-bold text-slate-600 hover:text-slate-800 dark:text-slate-400 dark:hover:text-slate-200">
                            Log In
                        </a>
                        <a href="{{ route('register') }}" class="px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold shadow-sm transition">
                            Register
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 dark:text-slate-440 hover:text-slate-700 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-50 dark:bg-slate-950 border-t border-slate-100 dark:border-slate-900">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('prayers.tracker')" :active="request()->routeIs('prayers.*') || request()->routeIs('prayer-times.*') || request()->routeIs('qibla.*')">
                {{ __('Daily Prayers') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('eating.index')" :active="request()->routeIs('eating.*')">
                {{ __('Halal Eating') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('sunnahs.index')" :active="request()->routeIs('sunnahs.*') || request()->routeIs('adhkar.*')">
                {{ __('Sunnah Checklist') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('income.index')" :active="request()->routeIs('income.*')">
                {{ __('Halal Rizq') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('hadiths.index')" :active="request()->routeIs('hadiths.*')">
                {{ __('Hadith Library') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-200 dark:border-slate-800">
            @auth
                <div class="px-4">
                    <div class="font-semibold text-base text-slate-800 dark:text-slate-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-550">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile & Settings') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="text-red-650">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4 py-2 flex flex-col gap-2">
                    <a href="{{ route('login') }}" class="w-full text-center px-4 py-2 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-xl text-sm font-bold">
                        Log In
                    </a>
                    <a href="{{ route('register') }}" class="w-full text-center px-4 py-2 bg-emerald-600 text-white rounded-xl text-sm font-bold">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
