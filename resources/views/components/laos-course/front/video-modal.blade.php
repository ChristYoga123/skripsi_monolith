@push('styles')
    <style>
        .modal-backdrop.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-backdrop.active .modal-content {
            transform: scale(1);
        }
    </style>
@endpush

<!-- Video Modal -->
<div id="video-modal"
    class="modal-backdrop fixed inset-0 bg-black/75 z-50 flex items-center justify-center opacity-0 invisible transition-all duration-300 backdrop-blur-sm">
    <div
        class="modal-content bg-white dark:bg-gray-800 rounded-2xl max-w-3xl w-full mx-4 transform scale-95 transition-transform duration-300 relative overflow-hidden">
        <div
            class="modal-close-btn absolute top-3 right-3 z-10 bg-white/80 dark:bg-gray-800/80 rounded-full w-8 h-8 flex items-center justify-center cursor-pointer transition-colors hover:bg-white dark:hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 dark:text-gray-300" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <div class="video-container relative pt-[56.25%]">
            <iframe id="youtube-iframe" class="absolute top-0 left-0 w-full h-full border-0"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Course Video Modal Functionality
        const $videoModal = $('#video-modal');
        const $youtubeIframe = $('#youtube-iframe');
        const $closeVideoModal = $('.modal-close-btn');

        /**
         * Extract YouTube ID from various YouTube URL formats
         * @param {string} url - The YouTube URL
         * @return {string|null} - The YouTube video ID or null if not found
         */
        function extractYoutubeId(url) {
            if (!url) return null;

            // Handle full URLs like https://www.youtube.com/watch?v=Qq7RFnHuR1o
            let match = url.match(
                /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/
            );

            if (match && match[1]) {
                return match[1];
            }

            // If the input is already just the ID (11 characters)
            if (url.match(/^[a-zA-Z0-9_-]{11}$/)) {
                return url;
            }

            return null;
        }

        // Close modal function
        function closeVideoModal() {
            $videoModal.removeClass('active');

            // Stop the video by removing the src
            setTimeout(() => {
                $youtubeIframe.attr('src', '');
            }, 300);

            // Re-enable body scrolling
            $('body').css('overflow', '');
        }

        // Event handler for main play button
        function handleMainPlayButton(youtubeUrl) {
            // Extract the YouTube ID
            const youtubeId = extractYoutubeId(youtubeUrl);

            if (!youtubeId) {
                console.error('Invalid YouTube URL or ID:', youtubeUrl);
                return;
            }

            // Set the iframe source with the YouTube ID
            $youtubeIframe.attr('src', `https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0`);

            // Show the modal
            $videoModal.addClass('active');

            // Prevent body scrolling
            $('body').css('overflow', 'hidden');
        }

        // Event handler for course card play buttons
        function handleCoursePlayButton(e) {
            e.preventDefault();
            e.stopPropagation();

            // Get course element and data
            const $course = $(this).closest('.course-card');

            // Get YouTube URL or ID from data attribute
            const youtubeUrl = $course.data('youtube-url');

            // Extract the YouTube ID
            const youtubeId = extractYoutubeId(youtubeUrl);

            if (!youtubeId) {
                console.error('Invalid YouTube URL or ID:', youtubeUrl);
                return;
            }

            // Set the iframe source with the YouTube ID
            $youtubeIframe.attr('src', `https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0`);

            // Show the modal
            $videoModal.addClass('active');

            // Prevent body scrolling
            $('body').css('overflow', 'hidden');
        }

        $(document).on('click', '.course-hover-content button', handleCoursePlayButton);

        // Close modal when close button is clicked
        $closeVideoModal.on('click', closeVideoModal);

        // Close modal when clicking outside the content
        $videoModal.on('click', function(e) {
            if (e.target === this) {
                closeVideoModal();
            }
        });

        // Close modal with ESC key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $videoModal.hasClass('active')) {
                closeVideoModal();
            }
        });
    </script>
@endpush
