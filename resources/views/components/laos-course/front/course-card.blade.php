@props(['course'])
{{-- @dd($course) --}}
<div class="course-card bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-2xl overflow-hidden transform transition-all"
    data-aos="fade-up" data-youtube-url="{{ $course?->materi[0]?->youtube_url ?? '#' }}">
    <div class="relative">
        <img src="{{ $course->getFirstMediaUrl('kursus-thumbnail') }}" alt="{{ $course->judul }}"
            class="w-full h-40 sm:h-48 object-cover" loading="lazy" />
        <div
            class="course-hover-content cursor-pointer absolute inset-0 bg-black/75 flex items-center justify-center opacity-0 transform translate-y-4 transition-all duration-300">
            <button
                class="p-3 sm:p-4 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path d="M8 5v14l11-7z" />
                </svg>
            </button>
        </div>
    </div>
    <div class="p-4 sm:p-6">
        <div class="flex flex-wrap items-center justify-between mb-4">
            <span
                class="px-3 py-1 bg-green-100/50 dark:bg-green-900/50 text-green-600 dark:text-green-400 rounded-md text-xs sm:text-sm font-medium backdrop-blur-sm mb-2 sm:mb-0">
                {{ ucwords(str_replace('-', ' ', $course->kategori->getLabel())) }}
            </span>
            <div class="flex items-center space-x-3 sm:space-x-4">
                <div class="flex items-center">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <span class="ml-1 text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                        {{ number_format($course->avg_rating ?? 0, 1) }}
                    </span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span
                        class="ml-1 text-xs sm:text-sm text-gray-600 dark:text-gray-400">{{ $course->students_count ?? 0 }}
                        Student</span>
                </div>
            </div>
        </div>
        <a href="{{ route('course.kelas.show', $course->slug) }}"
            class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white block mb-2 hover:text-green-500 duration-300 transition-all">
            <div class="flex gap-2">
                <span>
                    {{ $course->judul }}
                </span>
                {{-- badge flash sale --}}
                @if ($course->flashSale)
                    <span
                        class="inline-block border-2 border-red-500 text-red-500 text-xs font-semibold px-2 py-1 rounded-md transition-opacity duration-300"
                        style="animation: blink 1.5s ease-in-out infinite">
                        Flash Sale
                    </span>
                @endif
            </div>
        </a>
        <p class="text-gray-600 dark:text-white text-xs sm:text-sm line-clamp-2">
            {!! strip_tags($course->deskripsi) !!}</p>
        <div class="flex items-center justify-between mt-5">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 text-gray-600 dark:text-white">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>

                <span class="ml-2 text-gray-600 dark:text-white text-xs sm:text-sm">
                    {{ $course->mentors_count }} Mentor
                </span>
            </div>
            <span class="text-green-500 dark:text-green-400 font-bold text-sm sm:text-base">
                @if ($course->flashSale)
                    <div class="flex gap-2">
                        <span class="line-through text-red-500 transition-opacity duration-300"
                            style="animation: blink 1.5s ease-in-out infinite">
                            Rp{{ number_format($course->harga, 0, ',', '.') }}
                        </span>
                        <span class="font-medium">
                            Rp{{ number_format($course->harga * (1 - $course->flashSale->persentase / 100), 0, ',', '.') }}
                        </span>
                    </div>
                @else
                    Rp{{ number_format($course->harga, 0, ',', '.') }}
                @endif
            </span>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        // Handle course card hover effects
        function initCourseHoverEffects() {
            $('.course-card').off('mouseenter mouseleave');
            $('.course-card').each(function() {
                const card = $(this);
                const hoverContent = card.find('.course-hover-content');

                card.on('mouseenter', function() {
                    hoverContent.removeClass('opacity-0 translate-y-4');
                });

                card.on('mouseleave', function() {
                    hoverContent.removeClass('opacity-100 translate-y-0')
                        .addClass('opacity-0 translate-y-4');
                });
            });
        }

        // Initialize hover effects on page load
        initCourseHoverEffects();
    </script>
@endpush
