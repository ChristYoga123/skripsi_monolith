@props(['isHidden' => true])
<div id="empty-state" class="{{ $isHidden ? 'hidden' : '' }} mt-8 text-center py-8">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <p class="mt-2 text-gray-500 dark:text-gray-400">
        Kursus tidak ditemukan. Silahkan gunakan kata kunci lain.
    </p>
</div>
