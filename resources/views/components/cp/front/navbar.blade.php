<nav
    class="fixed w-full z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-3">
                <img alt="Laos logo" src="{{ asset('logo.png') }}" class="w-10 h-10 object-contain" />
                <span class="text-xl font-bold text-gray-900 dark:text-white">UKM
                    <span class="gradient-text">LAOS</span>
                </span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                @foreach ($menus as $menu)
                    @include('components.cp.front.navbar-partial', ['menu' => $menu])
                @endforeach

                <button id="theme-toggle"
                    class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer">
                    <!-- Sun icon for dark mode -->
                    <svg class="w-6 h-6 hidden dark:block text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707">
                        </path>
                    </svg>
                    <!-- Moon icon for light mode -->
                    <svg class="w-6 h-6 block dark:hidden text-gray-700" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center space-x-4">
                <button id="mobile-theme-toggle"
                    class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer">
                    <!-- Sun icon for dark mode -->
                    <svg class="w-6 h-6 hidden dark:block text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707">
                        </path>
                    </svg>
                    <!-- Moon icon for light mode -->
                    <svg class="w-6 h-6 block dark:hidden text-gray-700" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                        </path>
                    </svg>
                </button>

                <button id="mobile-menu-button" class="flex items-center">
                    <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden h-screen">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40" id="mobile-backdrop"></div>
        <div
            class="fixed inset-y-0 right-0 w-full bg-white dark:bg-gray-900 p-6 shadow-xl z-[60] transform transition-transform duration-300 translate-x-full">
            <div class="flex justify-between items-center mb-8">
                <a href="/" class="flex items-center space-x-3">
                    <img alt="Laos logo" src="{{ asset('logo.png') }}" class="w-8 h-8" />
                    <span class="text-lg font-bold text-gray-900 dark:text-white">UKM
                        <span class="gradient-text">LAOS</span>
                    </span>
                </a>
                <button id="close-menu" class="text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="space-y-6">
                @foreach ($menus as $menu)
                    @include('components.cp.front.navbar-partial', ['menu' => $menu, 'isMobile' => true])
                @endforeach
            </div>
        </div>
    </div>
</nav>
