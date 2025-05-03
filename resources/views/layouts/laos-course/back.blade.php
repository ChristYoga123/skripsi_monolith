<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('logo.png') }}" />
    <title>{{ $title }} | Laos Course</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

        * {
            font-family: "Poppins", sans-serif;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('toastr/build/toastr.css') }}">

    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen font-poppins">
    <!-- Mobile Menu Overlay -->
    <div id="menuOverlay" class="fixed inset-0 bg-black/50 z-20 hidden transition-opacity duration-300"></div>

    <div class="flex">
        <!-- Mobile Header -->
        @TopbarBackCourse

        <!-- Sidebar -->
        @AsideBackCourse

        <!-- Main Content -->
        <main class="w-full lg:ml-64 min-h-screen pt-16 lg:pt-0">
            <!-- Top Bar (Desktop) -->
            @TopbarDesktopBackCourse()

            <!-- Dashboard Content -->
            <div class="p-4 md:p-6">
                <!-- Welcome Box -->
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('toastr/build/toastr.min.js') }}"></script>
    <script>
        // Dark mode toggle functionality
        const darkModeToggle = document.getElementById('darkModeToggle');
        const html = document.documentElement;

        // Check for saved theme preference or use system preference
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }

        // Toggle dark mode
        darkModeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');

            // Save preference to localStorage
            if (html.classList.contains('dark')) {
                localStorage.setItem('color-theme', 'dark');
            } else {
                localStorage.setItem('color-theme', 'light');
            }
        });

        // Mobile menu functionality
        const sidebar = document.getElementById('sidebar');
        const menuOverlay = document.getElementById('menuOverlay');
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const closeSidebar = document.getElementById('closeSidebar');

        function openSidebar() {
            sidebar.classList.add('sidebar-slide-in');
            sidebar.classList.remove('-translate-x-full', 'sidebar-slide-out');
            menuOverlay.classList.remove('hidden');
            setTimeout(() => {
                menuOverlay.classList.remove('opacity-0');
            }, 10);
        }

        function closeSidebarMenu() {
            sidebar.classList.add('sidebar-slide-out');
            sidebar.classList.remove('sidebar-slide-in');
            menuOverlay.classList.add('opacity-0');
            setTimeout(() => {
                sidebar.classList.add('-translate-x-full');
                menuOverlay.classList.add('hidden');
            }, 300);
        }

        mobileMenuToggle.addEventListener('click', openSidebar);
        closeSidebar.addEventListener('click', closeSidebarMenu);
        menuOverlay.addEventListener('click', closeSidebarMenu);

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('sidebar-slide-in', 'sidebar-slide-out', '-translate-x-full');
                menuOverlay.classList.add('hidden');
            } else if (!sidebar.classList.contains('sidebar-slide-in')) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
    @Toastr()
    @stack('scripts')
</body>

</html>
