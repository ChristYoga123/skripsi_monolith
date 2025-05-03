@extends('layouts.laos-course.front')
@push('styles')
    <style>
        /* Essential animations and styles */
        .opacity-50 {
            opacity: 0.5;
        }

        .pointer-events-none {
            pointer-events: none;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .course-card-loading {
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>
@endpush

@section('content')
    <!-- Course Header Section -->
    <section
        class="pt-20 sm:pt-24 md:pt-32 pb-10 md:pb-16 relative overflow-hidden bg-gradient-to-b from-white via-green-50/30 to-green-100/20 dark:from-gray-900 dark:via-gray-800/30 dark:to-[#151E2E]">
        <div class="absolute inset-0">
            <div
                class="absolute top-0 right-0 w-[300px] sm:w-[400px] md:w-[600px] h-[300px] sm:h-[400px] md:h-[600px] bg-green-200/30 dark:bg-green-900/30 rounded-full blur-[150px] animate-pulse">
            </div>
            <div class="absolute bottom-0 left-0 w-[300px] sm:w-[400px] md:w-[600px] h-[300px] sm:h-[400px] md:h-[600px] bg-blue-200/20 dark:bg-blue-900/20 rounded-full blur-[150px] animate-pulse"
                style="animation-delay: 1s"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
            <div class="text-center">
                <h1
                    class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 md:mb-6 text-gray-900 dark:text-white">
                    Explore Our <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-500">Courses</span>
                </h1>
                <p class="text-gray-600 dark:text-gray-300 text-base md:text-lg lg:text-xl max-w-3xl mx-auto">
                    Choose from our wide range of professional courses designed to help you achieve your career goals
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Filters Sidebar -->
                <div class="w-full lg:w-72 lg:flex-shrink-0 relative">
                    <!-- Mobile filter button -->
                    <div class="lg:hidden mb-4">
                        <button id="mobile-filter-button"
                            class="w-full px-4 py-3 bg-white/80 dark:bg-gray-800/80 rounded-xl border border-gray-200/50 dark:border-gray-700/50 text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500/50 flex items-center justify-between">
                            <span>Filters</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>

                    <!-- Sidebar content -->
                    <div id="filters-container"
                        class="hidden lg:block lg:sticky lg:top-8 space-y-6 filters-sidebar bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-2xl p-6">
                        <!-- Filter Categories with Checkboxes -->
                        <div class="space-y-3" data-aos="fade-right" data-aos-delay="200">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Kategori</h3>

                            <div
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100/50 dark:hover:bg-gray-700/50 transition-colors">
                                <input type="checkbox" id="filter-programming"
                                    class="filter-checkbox w-4 h-4 rounded text-green-500 focus:ring-green-500/50 border-gray-300 dark:border-gray-600 transition-all"
                                    data-category="programming">
                                <label for="filter-programming"
                                    class="text-gray-700 dark:text-gray-300 cursor-pointer">Programming</label>
                            </div>

                            <div
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100/50 dark:hover:bg-gray-700/50 transition-colors">
                                <input type="checkbox" id="filter-cybersecurity"
                                    class="filter-checkbox w-4 h-4 rounded text-green-500 focus:ring-green-500/50 border-gray-300 dark:border-gray-600 transition-all"
                                    data-category="cyber-security">
                                <label for="filter-cybersecurity"
                                    class="text-gray-700 dark:text-gray-300 cursor-pointer">Cyber Security</label>
                            </div>

                            <div
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100/50 dark:hover:bg-gray-700/50 transition-colors">
                                <input type="checkbox" id="filter-design"
                                    class="filter-checkbox w-4 h-4 rounded text-green-500 focus:ring-green-500/50 border-gray-300 dark:border-gray-600 transition-all"
                                    data-category="design">
                                <label for="filter-design" class="text-gray-700 dark:text-gray-300 cursor-pointer">UI/UX
                                    Design</label>
                            </div>

                            <div
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100/50 dark:hover:bg-gray-700/50 transition-colors">
                                <input type="checkbox" id="filter-marketing"
                                    class="filter-checkbox w-4 h-4 rounded text-green-500 focus:ring-green-500/50 border-gray-300 dark:border-gray-600 transition-all"
                                    data-category="digital-marketing">
                                <label for="filter-marketing"
                                    class="text-gray-700 dark:text-gray-300 cursor-pointer">Digital Marketing</label>
                            </div>
                        </div>

                        <!-- Apply Filter Button -->
                        <div class="pt-4" data-aos="fade-right" data-aos-delay="300">
                            <button id="apply-filter-button"
                                class="w-full px-4 py-3 bg-green-500 hover:bg-green-600 text-white rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-green-500/50 font-medium flex items-center justify-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                <span>Terapkan Filter</span>
                            </button>
                        </div>

                        <!-- Clear Filter Button -->
                        <div data-aos="fade-right" data-aos-delay="400">
                            <button id="clear-filter-button"
                                class="w-full px-4 py-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-xl transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500/50 font-medium">
                                Reset Filter
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Courses Grid -->
                <div class="flex-1">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8" id="courses-grid">
                        <!-- Course Cards -->
                        @forelse ($courses as $course)
                            @CourseCardFrontCourse([
                                'course' => $course,
                            ])
                        @empty
                            <div class="flex items-center justify-center col-span-2">
                                @EmptyStateFrontCourse([
                                'isHidden' => false,
                                ])
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="pagination-container mt-8">
                {{ $courses->links() }}
            </div>
        </div>
    </section>

    @VideoModalFrontCourse()
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // initCourseHoverEffects()
            // Cache DOM elements
            const $filterCheckboxes = $('.filter-checkbox');
            const $applyFilterButton = $('#apply-filter-button');
            const $clearFilterButton = $('#clear-filter-button');
            const $mobileFilterButton = $('#mobile-filter-button');
            const $filtersContainer = $('#filters-container');
            const $coursesGrid = $('#courses-grid');
            const $paginationContainer = $('.pagination-container');

            // Toggle mobile filters
            $mobileFilterButton.on('click', function() {
                $filtersContainer.slideToggle(300);
            });

            // Apply filter function
            function applyFilters() {
                // Show loading state
                showLoadingState();

                // Get selected categories
                const selectedCategories = $filterCheckboxes
                    .filter(':checked')
                    .map(function() {
                        return $(this).data('category');
                    })
                    .get();

                // Build clean query string - only use 'kategori' parameter
                let queryString = '';

                if (selectedCategories.length > 0) {
                    queryString = 'kategori=' + selectedCategories.join(',');
                }

                // Get search term if it exists
                const urlParams = new URLSearchParams(window.location.search);
                const searchTerm = urlParams.get('judul');

                if (searchTerm) {
                    queryString = queryString ? `${queryString}&judul=${searchTerm}` : `judul=${searchTerm}`;
                }

                // Update URL without refreshing
                const baseUrl = window.location.pathname;
                const newUrl = queryString ? `${baseUrl}?${queryString}` : baseUrl;
                window.history.pushState({
                    path: newUrl
                }, '', newUrl);

                // Fetch filtered results via AJAX
                $.ajax({
                    url: '{{ route('course.kelas.filter') }}',
                    type: 'GET',
                    data: queryString,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        // Parse the HTML response
                        const $html = $(response);

                        // Extract and update the courses grid
                        const $newCoursesGrid = $html.find('#courses-grid');
                        if ($newCoursesGrid.length) {
                            $coursesGrid.html($newCoursesGrid.html());
                            initCourseHoverEffects()
                        } else if ($html.find('#courses-grid').length === 0 && $html.find('body')
                            .length > 0) {
                            // If we got a full page response instead of a partial
                            const $newGrid = $($html.find('#courses-grid')[0]);
                            if ($newGrid.length) {
                                $coursesGrid.html($newGrid.html());
                                initCourseHoverEffects()
                            }
                        }

                        // Extract and update pagination
                        const $newPagination = $html.find('.pagination-container');
                        if ($newPagination.length) {
                            $paginationContainer.html($newPagination.html());
                            // Reinitialize pagination links
                            initPaginationLinks();
                        }

                        // Hide mobile filters after applying on mobile
                        if ($(window).width() < 1024) {
                            $filtersContainer.slideUp(300);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching filtered results:', error);
                    },
                    complete: function() {
                        hideLoadingState();
                    }
                });
            }

            // Clear filter function
            function clearFilters() {
                // Reset all checkboxes
                $filterCheckboxes.prop('checked', false);

                // Get only search term if it exists
                const urlParams = new URLSearchParams(window.location.search);
                const searchTerm = urlParams.get('judul');

                // Prepare clean URL
                let newUrl = window.location.pathname;
                if (searchTerm) {
                    newUrl += `?judul=${searchTerm}`;
                }

                // Update URL without refreshing
                window.history.pushState({
                    path: newUrl
                }, '', newUrl);

                // Apply the reset filters
                applyFilters();
            }

            // Initialize checkboxes based on URL parameters
            function initCheckboxes() {
                const urlParams = new URLSearchParams(window.location.search);
                const categories = urlParams.get('kategori');

                if (categories) {
                    const categoryArray = categories.split(',');

                    // Check the appropriate checkboxes
                    $filterCheckboxes.each(function() {
                        const category = $(this).data('category');
                        if (categoryArray.includes(category)) {
                            $(this).prop('checked', true);
                        }
                    });
                }
            }

            // Show loading state
            function showLoadingState() {
                // Make sure courses grid has position relative for absolute positioning
                if (!$coursesGrid.hasClass('relative')) {
                    $coursesGrid.addClass('relative');
                }

                // Add overlay with loading spinner to courses grid
                $coursesGrid.addClass('opacity-50 pointer-events-none');

                // Remove any existing loaders first
                $coursesGrid.find('.course-loading-overlay').remove();

                $coursesGrid.append(`
            <div class="course-loading-overlay absolute inset-0 flex items-center justify-center bg-white/30 dark:bg-gray-800/30 backdrop-blur-sm rounded-xl z-10">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-green-500"></div>
            </div>
        `);

                // Disable buttons during loading
                $applyFilterButton.prop('disabled', true).addClass('opacity-75');
                $clearFilterButton.prop('disabled', true).addClass('opacity-75');
                $filterCheckboxes.prop('disabled', true);
            }

            // Hide loading state
            function hideLoadingState() {
                // Remove loading overlay
                $coursesGrid.removeClass('opacity-50 pointer-events-none');
                $coursesGrid.find('.course-loading-overlay').remove();

                // Re-enable buttons
                $applyFilterButton.prop('disabled', false).removeClass('opacity-75');
                $clearFilterButton.prop('disabled', false).removeClass('opacity-75');
                $filterCheckboxes.prop('disabled', false);
            }

            // Initialize pagination links for AJAX
            function initPaginationLinks() {
                $('.pagination a').on('click', function(e) {
                    e.preventDefault();

                    // Show loading state
                    showLoadingState();

                    // Get the page URL
                    const pageUrl = $(this).attr('href');

                    // Clean up pagination URLs to maintain our filter structure
                    const pageUrlObj = new URL(pageUrl, window.location.origin);
                    const pageParams = pageUrlObj.searchParams;

                    // Make sure we're only using 'kategori' for category filtering
                    if (pageParams.has('categories')) {
                        const categories = pageParams.get('categories');
                        pageParams.delete('categories');
                        if (categories && !pageParams.has('kategori')) {
                            pageParams.set('kategori', categories);
                        }
                    }

                    // Build the clean URL
                    const cleanPageUrl = `${pageUrlObj.pathname}?${pageParams.toString()}`;

                    // Fetch page content via AJAX
                    $.ajax({
                        url: cleanPageUrl,
                        type: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(response) {
                            // Parse the HTML response
                            const $html = $(response);

                            // Extract and update the courses grid
                            const $newCoursesGrid = $html.find('#courses-grid');
                            if ($newCoursesGrid.length) {
                                $coursesGrid.html($newCoursesGrid.html());
                            }

                            // Extract and update pagination
                            const $newPagination = $html.find('.pagination-container');
                            if ($newPagination.length) {
                                $paginationContainer.html($newPagination.html());
                                // Reinitialize pagination links
                                initPaginationLinks();
                            }

                            // Update URL without refreshing
                            window.history.pushState({
                                path: cleanPageUrl
                            }, '', cleanPageUrl);

                            // Scroll to top of courses section
                            $('html, body').animate({
                                scrollTop: $coursesGrid.offset().top - 100
                            }, 500);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching page:', error);
                        },
                        complete: function() {
                            hideLoadingState();
                        }
                    });
                });
            }

            // Bind events
            $applyFilterButton.on('click', applyFilters);
            $clearFilterButton.on('click', clearFilters);

            // Initialize checkboxes based on URL parameters
            initCheckboxes();

            // Initialize pagination links
            initPaginationLinks();
        });
    </script>
@endpush
