@extends('layouts.cp.front')

@section('content')
    <section
        class="relative pt-32 pb-20 overflow-hidden bg-gradient-to-b from-white via-green-50/30 to-green-100/20 dark:from-gray-900 dark:via-gray-800/30 dark:to-[#151E2E]">
        <!-- Background decorations -->
        <div class="absolute inset-0">
            <div
                class="absolute top-0 right-0 w-[500px] h-[500px] bg-green-200/30 dark:bg-green-900/30 rounded-full blur-[120px]">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-200/20 dark:bg-blue-900/20 rounded-full blur-[120px]">
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4 text-gray-900 dark:text-white">
                    Artikel <span class="gradient-text">Unggulan</span>
                </h2>
            </div>

            <div class="relative">
                @if ($popularArticles->count() > 0)
                    <div class="swiper featuredArticlesSwiper">
                        <div class="swiper-wrapper">
                            @foreach ($popularArticles as $article)
                                <div class="swiper-slide">
                                    <a href="{{ route('cp.blog.show', $article->slug) }}"
                                        class="group block bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                                        <div class="relative h-[200px] md:h-[250px] overflow-hidden">
                                            <img src="{{ $article->getFirstMediaUrl('blog-thumbnail') }}"
                                                alt="{{ $article->judul }}"
                                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500" />
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent">
                                            </div>
                                        </div>
                                        <div class="p-6">
                                            <h4
                                                class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary-green-base mb-3">
                                                {{ $article->judul }}
                                            </h4>
                                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                {{ $article->created_at->translatedFormat('d F Y') }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- Enhanced Navigation Buttons -->
                        <div
                            class="swiper-button-prev !left-4 !md:left-8 !w-12 !h-12 !bg-white/90 dark:!bg-gray-800/90 !rounded-full !shadow-lg backdrop-blur-sm transition-all duration-300 hover:!bg-green-500 after:!text-gray-800 dark:after:!text-white hover:after:!text-white">
                        </div>
                        <div
                            class="swiper-button-next !right-4 !md:right-8 !w-12 !h-12 !bg-white/90 dark:!bg-gray-800/90 !rounded-full !shadow-lg backdrop-blur-sm transition-all duration-300 hover:!bg-green-500 after:!text-gray-800 dark:after:!text-white hover:after:!text-white">
                        </div>
                    </div>
                @else
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-8 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Artikel Unggulan Belum Tersedia
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">Artikel unggulan akan segera ditambahkan</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section
        class="py-24 relative overflow-hidden bg-gradient-to-b from-white via-green-50/30 to-green-100/20 dark:from-[#151E2E] dark:via-gray-800/30 dark:to-gray-900">
        <!-- Background decorations -->
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-72 h-72 bg-green-200/30 dark:bg-green-900/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-200/30 dark:bg-blue-900/30 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                    Semua <span class="gradient-text">Artikel</span>
                </h2>
            </div>

            <!-- Categories -->
            <div class="flex justify-center mb-12">
                <div
                    class="inline-flex flex-wrap justify-center gap-4 p-2 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-full">
                    @foreach ($categories as $value => $label)
                        <a href="{{ route('cp.blog.index', ['kategori' => $value === 'semua' ? null : $value]) }}"
                            class="px-6 py-2 rounded-full text-sm font-medium transition-all duration-300
                            {{ $activeKategori === $value
                                ? 'bg-green-500 text-white shadow-lg'
                                : 'text-gray-600 dark:text-gray-300 hover:bg-green-500/10 dark:hover:bg-green-500/20' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($articles as $article)
                    <a href="{{ route('cp.blog.show', $article->slug) }}"
                        class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-green-50 dark:from-green-900/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div class="relative">
                            <div class="mb-6 relative overflow-hidden rounded-xl">
                                <img src="{{ $article->getFirstMediaUrl('blog-thumbnail') }}" alt="{{ $article->judul }}"
                                    class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500" />
                            </div>
                            <h3
                                class="text-xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-primary-green-base">
                                {{ $article->judul }}
                            </h3>
                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $article->created_at->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl p-8 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Artikel Belum Tersedia</h3>
                            <p class="text-gray-600 dark:text-gray-400">Artikel akan segera ditambahkan</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-12 {{ !$articles->hasPages() ? 'hidden' : '' }}">
                <div class="bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-full p-5 inline-block w-full">
                    {{ $articles->appends(['kategori' => $activeKategori !== 'semua' ? $activeKategori : null])->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Add Swiper JS at the end of your body tag -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            @if ($popularArticles->count() > 0)
                const featuredSwiper = new Swiper('.featuredArticlesSwiper', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    grabCursor: true,
                    centeredSlides: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                            centeredSlides: false,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                            centeredSlides: false,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 45,
                            centeredSlides: false,
                        },
                    },
                });
            @endif
        });
    </script>
@endpush
