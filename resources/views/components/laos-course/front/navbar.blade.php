<nav
    class="fixed w-full z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <a href="{{ route('course.index') }}" class="flex items-center space-x-3">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                <span class="text-xl font-bold text-gray-900 dark:text-white transition-colors">LAOS <span
                        class="gradient-text">COURSE</span></span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                @foreach ($menus as $menu)
                    <a href="{{ route($menu['route']) }}"
                        class="text-gray-700 dark:text-gray-300 hover:text-green-500 dark:hover:text-green-400 font-medium transition-colors {{ request()->routeIs($menu['active'] ?? $menu['route']) ? 'text-green-500 dark:text-green-400' : '' }}">
                        {{ $menu['title'] }}
                    </a>
                @endforeach

                <!-- Search Button for Desktop -->
                <button id="search-button"
                    class="text-gray-700 dark:text-gray-300 hover:text-green-500 dark:hover:text-green-400 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                <button id="theme-toggle"
                    class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors cursor-pointer">
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
                @auth
                    <a href="{{ route('course.dashboard.index') }}"
                        class="px-6 py-2 border-2 border-green-400 hover:bg-green-600 dark:border-green-600 text-green-400 hover:text-white rounded-md dark:hover:bg-green-700 dark:hover:text-white transition-colors font-medium text-center">
                        Dashboard
                    </a>
                @endauth

                @guest
                    <a href="{{ route('course.auth.login') }}"
                        class="px-6 py-2 border-2 border-green-400 hover:bg-green-600 dark:border-green-600 text-green-400 hover:text-white rounded-md dark:hover:bg-green-700 dark:hover:text-white transition-colors font-medium text-center">
                        Masuk
                    </a>
                    <a href="{{ route('course.auth.register') }}"
                        class="px-6 py-2 border-2 border-yellow-400 hover:bg-yellow-600 text-yellow-400 hover:text-white rounded-md dark:border-yellow-600 dark:hover:bg-yellow-700 dark:hover:text-white transition-colors font-medium text-center">
                        Daftar
                    </a>
                @endguest
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center space-x-4">
                <!-- Search Button for Mobile -->
                <button id="mobile-search-button"
                    class="text-gray-700 dark:text-gray-300 hover:text-green-500 dark:hover:text-green-400 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
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
    <div id="mobile-menu" class="mobile-menu md:hidden">
        <div class="p-6 bg-white dark:bg-gray-900 transition-colors">
            <div class="flex justify-between items-center mb-8">
                <a href="{{ route('course.index') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="w-10 h-10">
                    <span class="text-xl font-bold text-gray-900 dark:text-white transition-colors">Laos <span
                            class="gradient-text">Course</span></span>
                </a>
                <button id="close-menu" class="text-gray-500 dark:text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-col space-y-6 bg-white dark:bg-gray-900 h-screen transition-colors">
                @foreach ($menus as $menu)
                    <a href="{{ route($menu['route']) }}"
                        class="text-gray-700 dark:text-gray-300 hover:text-green-500 dark:hover:text-green-400 font-medium text-lg transition-colors {{ request()->routeIs($menu['active'] ?? $menu['route']) ? 'text-green-500 dark:text-green-400' : '' }}">
                        {{ $menu['title'] }}
                    </a>
                @endforeach
                <button id="mobile-theme-toggle"
                    class="flex items-center space-x-2 text-gray-700 dark:text-gray-300 hover:text-green-500 dark:hover:text-green-400">
                    <!-- Sun icon for dark mode -->
                    <svg class="w-6 h-6 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707">
                        </path>
                    </svg>
                    <!-- Moon icon for light mode -->
                    <svg class="w-6 h-6 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                        </path>
                    </svg>
                    <span>Dark Mode</span>
                </button>
                @auth
                    <a href="{{ route('course.dashboard.index') }}"
                        class="px-6 py-2 border-2 border-green-400 hover:bg-green-600 dark:border-green-600 text-green-400 hover:text-white rounded-md dark:hover:bg-green-700 dark:hover:text-white transition-colors font-medium text-center">
                        Dashboard
                    </a>
                @endauth
                @guest
                    <a href="{{ route('course.auth.login') }}"
                        class="px-6 py-2 border-2 border-green-400 hover:bg-green-600 dark:border-green-600 text-green-400 hover:text-white rounded-md dark:hover:bg-green-700 dark:hover:text-white transition-colors font-medium text-center">
                        Masuk
                    </a>
                    <a href="{{ route('course.auth.register') }}"
                        class="px-6 py-2 border-2 border-yellow-400 hover:bg-yellow-600 text-yellow-400 hover:text-white rounded-md dark:border-yellow-600 dark:hover:bg-yellow-700 dark:hover:text-white transition-colors font-medium text-center">
                        Daftar
                    </a>

                @endguest
            </div>
        </div>
    </div>
</nav>

<!-- Search Modal -->
<div id="search-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" id="search-backdrop"></div>
    <div class="relative bg-white dark:bg-gray-900 rounded-xl shadow-xl w-full max-w-2xl mx-auto transition-all transform duration-300 scale-95 opacity-0"
        id="search-content">
        <div class="p-4 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Cari Kursus</h3>
            <button id="close-search"
                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <div class="p-4">
            <div class="relative">
                <input type="text" id="search-input"
                    class="w-full px-4 py-3 pl-12 rounded-lg border border-gray-200 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 bg-white dark:bg-gray-800 text-gray-900 dark:text-white transition-colors"
                    placeholder="Masukkan kata kunci pencarian..." autocomplete="off">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute left-3 top-3 text-gray-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <div id="search-loading" class="absolute right-3 top-3 hidden">
                    <svg class="animate-spin h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
            </div>

            <!-- Search Results -->
            <div id="search-results" class="mt-4 space-y-4 max-h-96 overflow-y-auto">
                <!-- Results will be populated dynamically -->
            </div>

            <!-- Empty State -->
            @EmptyStateFrontCourse()

            <!-- Initial State -->
            @InitStateFrontCourse()
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // DOM Elements
            const $searchButton = $('#search-button');
            const $mobileSearchButton = $('#mobile-search-button');
            const $searchModal = $('#search-modal');
            const $searchBackdrop = $('#search-backdrop');
            const $searchContent = $('#search-content');
            const $closeSearch = $('#close-search');
            const $searchInput = $('#search-input');
            const $searchResults = $('#search-results');
            const $emptyState = $('#empty-state');
            const $initialState = $('#initial-state');
            const $searchLoading = $('#search-loading');

            // Open search modal
            function openSearchModal() {
                $searchModal.removeClass('hidden');
                setTimeout(() => {
                    $searchContent.removeClass('scale-95 opacity-0')
                        .addClass('scale-100 opacity-100');
                    $searchInput.focus();
                }, 10);
            }

            // Close search modal
            function closeSearchModal() {
                $searchContent.removeClass('scale-100 opacity-100')
                    .addClass('scale-95 opacity-0');
                setTimeout(() => {
                    $searchModal.addClass('hidden');
                }, 300);
            }

            // Event Listeners for opening/closing the modal
            $searchButton.on('click', openSearchModal);
            $mobileSearchButton.on('click', openSearchModal);
            $closeSearch.on('click', closeSearchModal);
            $searchBackdrop.on('click', closeSearchModal);

            // Close modal with Escape key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && !$searchModal.hasClass('hidden')) {
                    closeSearchModal();
                }
            });

            // Debounce function
            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    const context = this;
                    clearTimeout(timeout);
                    $searchLoading.removeClass('hidden');
                    timeout = setTimeout(() => {
                        func.apply(context, args);
                    }, wait);
                };
            }

            // Fetch search results
            async function fetchSearchResults(query) {
                try {
                    const response = await $.ajax({
                        url: `/course/kelas/search?query=${encodeURIComponent(query)}`,
                        type: 'GET',
                        dataType: 'json'
                    });
                    return response.courses;
                } catch (error) {
                    console.error('Error fetching search results:', error);
                    return [];
                } finally {
                    $searchLoading.addClass('hidden');
                }
            }

            // Render search results
            function renderSearchResults(courses) {
                $searchResults.empty();

                if (courses.length === 0) {
                    $emptyState.removeClass('hidden');
                    $initialState.addClass('hidden');
                    $searchResults.addClass('hidden');
                    return;
                }

                $emptyState.addClass('hidden');
                $initialState.addClass('hidden');
                $searchResults.removeClass('hidden');

                $.each(courses, function(i, course) {
                    const thumbnailUrl = course.thumbnail || '/path/to/default-thumbnail.jpg';

                    const $courseElement = $(`
                <a href="${course.url}" class="block p-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <img src="${thumbnailUrl}" alt="${course.title}" class="w-20 h-14 object-cover rounded-md">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">${course.title}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">${course.category || 'Uncategorized'}</p>
                            <p class="text-xs font-medium text-green-500 mt-1">${course.price}</p>
                        </div>
                    </div>
                </a>
            `);

                    $searchResults.append($courseElement);
                });
            }

            // Handle search input with debounce
            const handleSearchInput = debounce(async function() {
                const query = $searchInput.val().trim();

                if (query.length < 3) {
                    $searchResults.addClass('hidden');
                    $emptyState.addClass('hidden');
                    $initialState.removeClass('hidden');
                    $searchLoading.addClass('hidden');
                    return;
                }

                const courses = await fetchSearchResults(query);
                renderSearchResults(courses);
            }, 500); // 500ms debounce delay

            // Event listener for search input
            $searchInput.on('input', handleSearchInput);

            // Clear search results when modal is closed
            $closeSearch.on('click', function() {
                $searchInput.val('');
                $searchResults.empty();
                $searchResults.addClass('hidden');
                $emptyState.addClass('hidden');
                $initialState.removeClass('hidden');
            });
        });
    </script>
@endpush
