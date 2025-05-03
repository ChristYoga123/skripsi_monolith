<header
    class="lg:hidden fixed top-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-md p-4 z-[40] flex justify-between items-center">
    <div class="flex items-center">
        <button id="mobileMenuToggle" class="mr-4 text-gray-600 dark:text-gray-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <a href="#" class="flex items-center">
            <div class="relative">
                <div
                    class="absolute inset-0 bg-green-200 dark:bg-green-700 rounded-lg transform rotate-6 transition-all duration-300">
                </div>
                <div
                    class="relative w-8 h-8 flex items-center justify-center bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <img src="{{ asset('logo.png') }}" alt="Logo Laos">

                </div>
            </div>
            <h1 class="ml-2 text-lg font-bold text-gray-900 dark:text-white">
                LAOS<span class="gradient-text"> COURSE</span>
            </h1>
        </a>
    </div>
    <div class="flex items-center gap-2">
        @if (Auth::user()->hasRole('super_admin'))
            <a href="{{ route('filament.super_admin.pages.dashboard') }}"
                class="relative p-2 bg-green-500 text-white rounded-lg transition-colors duration-300 hover:bg-green-600 font-semibold">
                Admin Panel
            </a>
        @elseif(Auth::user()->hasRole('mentor'))
            <a href="{{ route('filament.mentor.pages.dashboard') }}"
                class="relative p-2 bg-green-500 text-white rounded-lg transition-colors duration-300 hover:bg-green-600 font-semibold">
                Mentor Panel
            </a>
        @endif
        <div class="relative">
            <img src="{{ Auth::user()->avatar_url ? asset('storage/' . Auth::user()?->avatar_url) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name . '&background=16a34a&color=fff&bold=true&font-family=Poppins' }}"
                alt="User" class="w-8 h-8 rounded-full border-2 border-white dark:border-gray-700">
        </div>
    </div>
</header>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('closeSidebar');
            const body = document.body;

            if (mobileMenuToggle && sidebar) {
                mobileMenuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                    // Add overlay when sidebar is open
                    if (!sidebar.classList.contains('-translate-x-full')) {
                        const overlay = document.createElement('div');
                        overlay.id = 'sidebar-overlay';
                        overlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden';
                        overlay.addEventListener('click', function() {
                            sidebar.classList.add('-translate-x-full');
                            overlay.remove();
                        });
                        body.appendChild(overlay);
                    } else {
                        const overlay = document.getElementById('sidebar-overlay');
                        if (overlay) overlay.remove();
                    }
                });
            }

            if (closeSidebar && sidebar) {
                closeSidebar.addEventListener('click', function() {
                    sidebar.classList.add('-translate-x-full');
                    const overlay = document.getElementById('sidebar-overlay');
                    if (overlay) overlay.remove();
                });
            }

            // Handle resize events
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) { // lg breakpoint
                    const overlay = document.getElementById('sidebar-overlay');
                    if (overlay) overlay.remove();
                }
            });
        });
    </script>
@endpush
