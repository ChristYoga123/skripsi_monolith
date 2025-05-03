<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Selamat Datang' }} - LAOS Course</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/laos-course/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/build/toastr.css') }}">
    <link rel="icon" href="{{ asset('logo.png') }}" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    <!-- Modern Navbar -->
    @NavbarFrontCourse()

    @yield('content')

    <!-- Footer -->
    @FooterFrontCourse()
    {{-- @Toastr() --}}

    <script src="{{ asset('toastr/build/toastr.min.js') }}"></script>
    <script>
        $(document).ready(function() {
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

            // Add click listeners to both desktop and mobile toggle buttons
            $('#theme-toggle').on('click', toggleDarkMode);
            $('#mobile-theme-toggle').on('click', toggleDarkMode);

            // Listen for system theme changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
                if (!localStorage.getItem('color-theme')) {
                    if (e.matches) {
                        $('html').addClass('dark');
                        updateDarkModeButtons(true);
                    } else {
                        $('html').removeClass('dark');
                        updateDarkModeButtons(false);
                    }
                }
            });

            // Initialize button states
            updateDarkModeButtons($('html').hasClass('dark'));

            // Mobile menu functionality
            function toggleMenu() {
                $('#mobile-menu').toggleClass('active');
                $('body').toggleClass('overflow-hidden');
            }

            $('#mobile-menu-button').on('click', toggleMenu);
            $('#close-menu').on('click', toggleMenu);

            // Initialize AOS
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100,
            });
        });
    </script>
    @Toastr()
    @stack('scripts')
</body>

</html>
