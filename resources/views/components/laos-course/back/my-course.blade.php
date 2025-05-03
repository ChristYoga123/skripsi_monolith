@props(['course', 'currentLesson' => [], 'progress' => 0])

<div class="course-card bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-2xl overflow-hidden transform transition-all hover:shadow-lg"
    data-aos="fade-up" data-youtube-url="{{ $course->courseChapterLessons[0]->youtube_url ?? '#' }}">
    <div class="relative">
        <img src="{{ $course->getFirstMediaUrl('kursus-thumbnail') }}" alt="{{ $course->judul }}"
            class="w-full h-40 sm:h-48 object-cover" loading="lazy" />

        <!-- Status badge -->
        <div class="absolute top-3 right-3">
            <span
                class="px-2 py-1 text-xs font-medium rounded-lg 
                {{ $progress == 0
                    ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300'
                    : ($progress == 100
                        ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300'
                        : 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300') }}">
                {{ $progress == 0 ? 'Belum Dimulai' : ($progress == 100 ? 'Selesai' : 'Sedang Belajar') }}
            </span>
        </div>
    </div>

    <div class="p-4 sm:p-6">
        <div class="flex flex-wrap items-center justify-between mb-3">
            <span
                class="px-3 py-1 bg-green-100/50 dark:bg-green-900/50 text-green-600 dark:text-green-400 rounded-xl text-xs sm:text-sm font-medium backdrop-blur-sm">
                {{ ucwords(str_replace('-', ' ', $course->kategori->value)) }}
            </span>
            <div class="flex items-center space-x-2 text-gray-600 dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-xs">{{ $progress }}% selesai</span>
            </div>
        </div>

        <a href="{{ route('course.dashboard.my-courses.show', $course->slug) }}"
            class="text-lg font-bold text-gray-900 dark:text-white block mb-2 hover:text-green-500 dark:hover:text-green-400 transition-colors">
            {{ $course->judul }}
        </a>

        <div class="flex items-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                {{ $course->mentors_count }} Mentor
            </span>
        </div>

        <!-- Last accessed chapter/lesson info -->
        <div class="mb-4 border-l-2 border-green-500 pl-3">
            <p class="text-xs text-gray-500 dark:text-gray-400">Terakhir belajar:</p>
            <p class="text-sm text-gray-700 dark:text-gray-300 truncate">
                {{ empty($currentLesson) ? 'Belum Memulai' : $currentLesson->materi->judul }}
            </p>
        </div>

        <!-- Continue learning button -->
        <div class="flex flex-col items-center gap-2">
            <a href="{{ route('course.dashboard.my-courses.show', $course->slug) }}"
                class="w-full py-2 px-4 hover:bg-green-500 border-2 border-green-500 text-green-500 hover:text-white text-center rounded-md font-medium text-sm transition-colors flex items-center justify-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ $progress > 0 ? 'Lanjutkan Belajar' : 'Mulai Belajar' }}</span>
            </a>
            <a href="{{ $course->resource_url }}"
                class="w-full py-2 px-4 hover:bg-yellow-500 border-2 border-yellow-500 text-yellow-500 hover:text-white text-center rounded-md font-medium text-sm transition-colors flex items-center justify-center space-x-2">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 font-semibold">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                            d="M3 14.25C3.41421 14.25 3.75 14.5858 3.75 15C3.75 16.4354 3.75159 17.4365 3.85315 18.1919C3.9518 18.9257 4.13225 19.3142 4.40901 19.591C4.68577 19.8678 5.07435 20.0482 5.80812 20.1469C6.56347 20.2484 7.56459 20.25 9 20.25H15C16.4354 20.25 17.4365 20.2484 18.1919 20.1469C18.9257 20.0482 19.3142 19.8678 19.591 19.591C19.8678 19.3142 20.0482 18.9257 20.1469 18.1919C20.2484 17.4365 20.25 16.4354 20.25 15C20.25 14.5858 20.5858 14.25 21 14.25C21.4142 14.25 21.75 14.5858 21.75 15V15.0549C21.75 16.4225 21.75 17.5248 21.6335 18.3918C21.5125 19.2919 21.2536 20.0497 20.6517 20.6516C20.0497 21.2536 19.2919 21.5125 18.3918 21.6335C17.5248 21.75 16.4225 21.75 15.0549 21.75H8.94513C7.57754 21.75 6.47522 21.75 5.60825 21.6335C4.70814 21.5125 3.95027 21.2536 3.34835 20.6517C2.74643 20.0497 2.48754 19.2919 2.36652 18.3918C2.24996 17.5248 2.24998 16.4225 2.25 15.0549C2.25 15.0366 2.25 15.0183 2.25 15C2.25 14.5858 2.58579 14.25 3 14.25Z"
                            fill="currentColor"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 16.75C12.2106 16.75 12.4114 16.6615 12.5535 16.5061L16.5535 12.1311C16.833 11.8254 16.8118 11.351 16.5061 11.0715C16.2004 10.792 15.726 10.8132 15.4465 11.1189L12.75 14.0682V3C12.75 2.58579 12.4142 2.25 12 2.25C11.5858 2.25 11.25 2.58579 11.25 3V14.0682L8.55353 11.1189C8.27403 10.8132 7.79963 10.792 7.49393 11.0715C7.18823 11.351 7.16698 11.8254 7.44648 12.1311L11.4465 16.5061C11.5886 16.6615 11.7894 16.75 12 16.75Z"
                            fill="currentColor"></path>
                    </g>
                </svg>
                <span>Unduh Resource</span>
            </a>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Initialize hover effects for dashboard cards
        function initDashboardCourseCards() {
            $('.course-card').each(function() {
                $(this).addClass('hover:translate-y-[-5px]').addClass('duration-300');
            });
        }

        // Initialize effects on page load
        $(document).ready(function() {
            initDashboardCourseCards();
        });
    </script>
@endpush
