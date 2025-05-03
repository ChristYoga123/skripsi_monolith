{{-- resources/views/components/menu-item.blade.php --}}
@props(['menu', 'isMobile' => false])

@if (isset($menu['children']))
    <div class="relative {{ $isMobile ? '' : 'group inline-block' }}">
        {{-- Parent menu item with dropdown --}}
        <button onclick="toggleChildren(event)"
            class="flex items-center {{ $isMobile ? 'w-full justify-between' : '' }} text-gray-700 dark:text-gray-300 hover:text-green-500 dark:hover:text-green-400 font-medium">
            <span>{{ $menu['title'] }}</span>
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        {{-- Dropdown for desktop --}}
        @if (!$isMobile)
            <div
                class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hidden z-50">
                <div class="py-1">
                    @foreach ($menu['children'] as $child)
                        @if (isset($child['children']))
                            {{-- <x-menu-item :menu="$child" /> --}}
                            @include('components.cp.front.navbar-partial', [
                                'menu' => $child,
                                'isMobile' => false,
                            ])
                        @else
                            <a href="{{ $child['url'] }}"
                                class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-green-500 dark:hover:text-green-400">
                                {{ $child['title'] }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            {{-- Dropdown for mobile (accordion style) --}}
        @else
            <div class="mt-2 ml-4 border-l-2 border-gray-200 dark:border-gray-700 pl-4 hidden"
                id="mobile-submenu-{{ Str::slug($menu['title']) }}">
                @foreach ($menu['children'] as $child)
                    @if (isset($child['children']))
                        {{-- <x-menu-item :menu="$child" /> --}}
                        @include('components.cp.front.navbar-partial', [
                            'menu' => $child,
                            'isMobile' => true,
                        ])
                    @else
                        <a href="{{ $child['url'] }}"
                            class="block py-2 text-gray-700 dark:text-gray-300 hover:text-green-500 dark:hover:text-green-400">
                            {{ $child['title'] }}
                        </a>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
@else
    {{-- Regular menu item without children --}}
    <a href="{{ isset($menu['route']) ? route($menu['route']) : '#' }}"
        class="{{ $isMobile ? 'block py-2' : '' }} text-gray-700 dark:text-gray-300 hover:text-green-500 dark:hover:text-green-400 font-medium {{ isset($menu['route']) && Request::routeIs(isset($menu['active']) ? $menu['active'] : $menu['route']) ? 'text-green-500 dark:text-green-400' : '' }}">
        {{ $menu['title'] }}
    </a>
@endif
