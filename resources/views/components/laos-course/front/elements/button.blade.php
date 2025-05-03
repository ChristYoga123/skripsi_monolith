@props(['text', 'type'])
<div>
    <button type="{{ $type }}"
        class="w-full px-4 py-3 bg-green-500 dark:bg-green-600 text-white rounded-lg hover:bg-green-600 dark:hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 font-medium">
        {{ $text }}
    </button>
</div>
