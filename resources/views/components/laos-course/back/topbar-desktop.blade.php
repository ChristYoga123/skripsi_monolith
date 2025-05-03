<header class="hidden lg:flex bg-white dark:bg-gray-800 shadow-md p-4 justify-between items-center">
    <div>
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Dashboard <span
                class="gradient-text">Student</span></h2>
    </div>
    <div class="flex items-center space-x-4">
        <!-- Notifications -->
        @if (Auth::user()->hasRole('super_admin'))
            <a href="{{ route('filament.super_admin.pages.dashboard') }}"
                class="relative p-2 border-2 border-green-500 text-green-500 hover:text-white rounded-md transition-colors duration-300 hover:bg-green-600 font-semibold">
                Admin Panel
            </a>
        @elseif(Auth::user()->hasRole('mentor'))
            <a href="{{ route('filament.mentor.pages.dashboard') }}"
                class="relative p-2 border-2 border-green-500 text-green-500 hover:text-white rounded-md transition-colors duration-300 hover:bg-green-600 font-semibold">
                Mentor Panel
            </a>
        @endif

        <!-- User Menu -->
        <div class="relative">
            <button class="flex items-center space-x-3 focus:outline-none">
                <div class="relative w-10 h-10">
                    <div
                        class="absolute inset-0 bg-green-200 dark:bg-green-700 rounded-full blur-[2px] group-hover:bg-green-300 dark:group-hover:bg-green-600 transition-colors duration-300">
                    </div>
                    <img src="{{ Auth::user()->avatar_url ? asset('storage/' . Auth::user()?->avatar_url) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name . '&background=16a34a&color=fff&bold=true&font-family=Poppins' }}"
                        alt="User"
                        class="relative w-10 h-10 rounded-full border-2 border-white dark:border-gray-700">
                </div>
                <div class="hidden md:block text-left">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ strtoupper(implode(',', str_replace('_', ' ', Auth::user()->getRoleNames()->toArray()) ?? [])) }}
                    </p>
                </div>
            </button>
        </div>
    </div>
</header>
