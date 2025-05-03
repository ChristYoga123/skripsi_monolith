<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="{{ asset('logo.png') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('toastr/build/toastr.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>{{ $title }} | UKM LAOS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <script>
        // Check if dark mode is enabled
        function isDarkMode() {
            return localStorage.getItem('color-theme') === 'dark' ||
                (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
        }

        // Apply initial theme
        $(document).ready(function() {
            if (isDarkMode()) {
                $('html').addClass('dark');
            } else {
                $('html').removeClass('dark');
            }
        });
    </script>
</head>

<body class="bg-white dark:bg-gray-900 transition-colors duration-300">
    <!-- start navbar -->
    @NavbarCP()
    <!-- end navbar -->
    @yield('content')
    <!-- start footer -->
    @FooterCP()
    <!-- end footer -->

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Initialize Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('toastr/build/toastr.min.js') }}"></script>
    @Toastr()
    <script>
        // Dark mode toggle functionality
        function toggleDarkMode() {
            // Toggle dark class
            if ($('html').hasClass('dark')) {
                $('html').removeClass('dark');
                localStorage.setItem('color-theme', 'light');
                // Update button states
                updateDarkModeButtons(false);
            } else {
                $('html').addClass('dark');
                localStorage.setItem('color-theme', 'dark');
                // Update button states
                updateDarkModeButtons(true);
            }
        }

        // Update all dark mode toggle buttons
        function updateDarkModeButtons(isDark) {
            $('.dark\\:block').each(function() {
                $(this).css('display', isDark ? 'block' : 'none');
            });

            $('.block.dark\\:hidden').each(function() {
                $(this).css('display', isDark ? 'none' : 'block');
            });
        }

        // Mobile menu functionality
        function openMobileMenu() {
            const $mobileMenu = $('#mobile-menu');
            if (!$mobileMenu.length) return;

            $mobileMenu.removeClass('hidden');
            $('body').addClass('overflow-hidden');

            setTimeout(() => {
                const $menuPanel = $mobileMenu.find('div:last-child');
                if ($menuPanel.length) {
                    $menuPanel.removeClass('translate-x-full');
                }
            }, 10);
        }

        function closeMobileMenu() {
            const $mobileMenu = $('#mobile-menu');
            if (!$mobileMenu.length) return;

            const $menuPanel = $mobileMenu.find('div:last-child');
            if ($menuPanel.length) {
                $menuPanel.addClass('translate-x-full');
            }

            setTimeout(() => {
                $mobileMenu.addClass('hidden');
                $('body').removeClass('overflow-hidden');
            }, 300);
        }

        function handleWindowResize() {
            const $mobileMenu = $('#mobile-menu');
            if ($mobileMenu.length && $(window).width() >= 768 && !$mobileMenu.hasClass('hidden')) {
                closeMobileMenu();
            }
        }

        function handleEscapeKey(e) {
            const $mobileMenu = $('#mobile-menu');
            if (e.key === 'Escape' && $mobileMenu.length && !$mobileMenu.hasClass('hidden')) {
                closeMobileMenu();
            }
        }

        function toggleChildren(event) {
            event.preventDefault();
            const $submenu = $(event.currentTarget).next();
            if ($submenu.length) {
                $submenu.toggleClass('hidden');
                // arrow rotasi 180 derajat
                const $arrow = $(event.currentTarget).find('svg');
                if ($arrow.length) {
                    $arrow.toggleClass('rotate-180');
                    $arrow.addClass('transition-transform duration-300');
                }
            }
        }

        function initializeSwiperSlider() {
            return new Swiper('.mySwiper', {
                slidesPerView: 1, // Default for mobile
                spaceBetween: 20,
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                // Responsive breakpoints
                breakpoints: {
                    // >= 640px (sm)
                    640: {
                        slidesPerView: 2, // Tablet view
                        spaceBetween: 20,
                    },
                    // >= 1024px (lg)
                    1024: {
                        slidesPerView: 3, // Desktop view
                        spaceBetween: 30,
                    }
                }
            });
        }

        function setupEventListeners() {
            // Add click listeners to toggle buttons
            $('#theme-toggle').on('click', toggleDarkMode);
            $('#mobile-theme-toggle').on('click', toggleDarkMode);

            // Mobile menu event listeners
            const $mobileMenuButton = $('#mobile-menu-button');
            const $closeMenu = $('#close-menu');
            const $mobileBackdrop = $('#mobile-backdrop');
            const $mobileMenu = $('#mobile-menu');

            if ($mobileMenuButton.length) {
                $mobileMenuButton.on('click', openMobileMenu);
            }

            if ($closeMenu.length) {
                $closeMenu.on('click', closeMobileMenu);
            }

            if ($mobileBackdrop.length) {
                $mobileBackdrop.on('click', closeMobileMenu);
            }

            // Window resize handler
            $(window).on('resize', handleWindowResize);

            // Close mobile menu when clicking a link
            if ($mobileMenu.length) {
                $mobileMenu.find('a').on('click', closeMobileMenu);
            }

            // Close mobile menu with Escape key
            $(document).on('keydown', handleEscapeKey);
        }

        // Initialize everything when document is ready
        $(function() {
            setupEventListeners();
            initializeSwiperSlider();
            updateDarkModeButtons($('html').hasClass('dark'));
        });
    </script>
    @stack('scripts')
</body>

</html>
