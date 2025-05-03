{{-- @dd($course) --}}
@extends('layouts.laos-course.front')
@php
    use App\Enums\LaosCourse\Kursus\TipeEnum;
@endphp
@push('styles')
    <style>
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .accordion-content.active {
            max-height: 500px;
        }
    </style>
@endpush
@section('content')
    {{-- @dd(session()) --}}
    <main class="pt-32 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Course Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">{{ $course->judul }}</h1>
                <div class="flex items-center text-gray-600 dark:text-gray-400">
                    <span
                        class="px-4 py-1 bg-green-100/50 dark:bg-green-900/50 text-green-600 dark:text-green-400 rounded-xl text-sm font-medium backdrop-blur-sm mr-4">
                        {{ ucwords(str_replace('-', ' ', $course->kategori->getLabel())) }}
                    </span>
                    <div class="flex items-center mr-6">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="ml-1">{{ number_format($course->avg_rating ?? 0, 1) }} ({{ $course->reviews_count }}
                            reviews)</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>{{ $course->students_count }} students terdaftar</span>
                    </div>
                </div>
            </div>

            <!-- Course Details Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                <!-- Video Trailer (16:9 aspect ratio) -->
                <div class="col-span-1 lg:col-span-2 rounded-2xl overflow-hidden flex flex-col h-[300px] md:h-[500px]"
                    data-aos="fade-right">
                    <div class="relative w-full h-full"> <!-- Changed to flex-grow -->
                        <div class="absolute inset-0 bg-gray-800 flex items-center justify-center">
                            @if (isset($course->materi[0]->youtube_url))
                                @php
                                    $videoId = null;
                                    if (
                                        preg_match(
                                            '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
                                            $course->materi[0]->youtube_url,
                                            $matches,
                                        )
                                    ) {
                                        $videoId = $matches[1];
                                    } elseif (preg_match('/^[a-zA-Z0-9_-]{11}$/', $course->materi[0]->youtube_url)) {
                                        $videoId = $course->materi[0]->youtube_url;
                                    }
                                @endphp
                                <iframe class="absolute inset-0 w-full h-full"
                                    src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&rel=0"
                                    title="{{ $course->judul }}" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            @else
                                <div class="absolute inset-0 bg-gray-800 flex items-center justify-center">
                                    <img src="{{ $course->getFirstMediaUrl('kursus-thumbnail') }}"
                                        alt="Course video thumbnail" class="w-full h-full object-cover opacity-50">
                                    <button
                                        class="absolute p-5 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors transform hover:scale-105">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Course Info & Enrollment Card -->
                <div
                    class="relative overflow-hidden bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                    <!-- Decorative elements -->
                    <div
                        class="absolute -top-16 -right-16 w-32 h-32 bg-green-100 dark:bg-green-900/30 rounded-full opacity-40">
                    </div>
                    <div
                        class="absolute -bottom-8 -left-8 w-24 h-24 bg-green-100 dark:bg-green-900/30 rounded-full opacity-40">
                    </div>

                    <!-- Price header with improved styling -->
                    <div class="relative">
                        <div class="flex gap-2">
                            <span
                                class="inline-block px-4 py-1 bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-300 rounded-md text-sm font-medium mb-2">{{ ucwords($course->tipe->getLabel()) }}
                                Course</span>
                            @if ($course->flashSale)
                                <span
                                    class="border-2 border-red-500 text-red-500 text-xs font-semibold px-2 py-1 h-[27px] rounded-md transition-opacity duration-300"
                                    style="animation: blink 1.5s ease-in-out infinite">
                                    Flash Sale
                                </span>
                            @endif
                        </div>
                        <div class="text-3xl font-bold text-green-500 dark:text-green-400 mb-6 flex items-baseline">
                            @if ($course->flashSale)
                                <div class="flex flex-row md:flex-col">
                                    <span class="line-through text-red-500 mr-2"
                                        style="animation: blink 1.5s ease-in-out infinite">Rp
                                        {{ number_format($course->harga, 0, ',', '.') }}</span>
                                    <span class="text-xl md:text-lg my-auto">Rp
                                        {{ number_format($course->harga * (1 - $course->flashSale->persentase / 100), 0, ',', '.') }}<span
                                            class="text-xs text-gray-400">/one-time-payment</span></span>

                                </div>
                            @else
                                <span>Rp
                                    {{ number_format($course->harga, 0, ',', '.') }}</span>
                                <span class="text-xs text-gray-400">/one-time-payment</span>
                            @endif
                        </div>
                    </div>

                    <!-- Course Features with improved styling -->
                    <div class="space-y-4 mb-8">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-3">Course Includes:</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center group">
                                <div
                                    class="p-2 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-500 mr-3 group-hover:bg-green-200 dark:group-hover:bg-green-800/50 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">Level</span>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ ucwords($course->level->getLabel()) }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center group">
                                <div
                                    class="p-2 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-500 mr-3 group-hover:bg-green-200 dark:group-hover:bg-green-800/50 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">Chapters</span>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $course->bab_count }}
                                        Bab</p>
                                </div>
                            </div>

                            <div class="flex items-center group">
                                <div
                                    class="p-2 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-500 mr-3 group-hover:bg-green-200 dark:group-hover:bg-green-800/50 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">Lessons</span>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $course->materi_count }} Materi</p>
                                </div>
                            </div>

                            <div class="flex items-center group">
                                <div
                                    class="p-2 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-500 mr-3 group-hover:bg-green-200 dark:group-hover:bg-green-800/50 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">Mentors</span>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $course->mentors_count }}
                                        Mentor</p>
                                </div>
                            </div>
                        </div>

                        <!-- Special highlight for lifetime access -->
                        <div
                            class="mt-6 bg-green-50 dark:bg-green-900/20 p-4 rounded-xl border border-green-100 dark:border-green-800/50">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <span class="text-gray-800 dark:text-gray-200 font-medium">Lifetime Access</span>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Learn at your own pace, forever</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enrollment Button with improved styling -->
                    <div class="relative z-10">
                        @if ($course->tipe === TipeEnum::PREMIUM)
                            <a href="{{ route('course.checkout.index', $course->slug) }}"
                                class="w-full py-3 mb-3 bg-green-500 dark:bg-green-600 text-white rounded-xl hover:bg-green-600 dark:hover:bg-green-700 transition-colors font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-transform flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                                Daftar Sekarang
                            </a>
                        @else
                            <form action="{{ route('course.checkout.daftar', $course->slug) }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="w-full py-3 mb-3 bg-green-500 dark:bg-green-600 text-white rounded-xl hover:bg-green-600 dark:hover:bg-green-700 transition-colors font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-transform flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                    Mulai Belajar
                                </button>
                            </form>
                        @endif
                        <p class="text-xs text-center text-gray-500 dark:text-gray-400">Pembayaran aman & terverifikasi</p>
                    </div>
                </div>
            </div>

            <!-- Tabs Section -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-2xl overflow-hidden"
                data-aos="fade-up">
                <!-- Tab Navigation -->
                <div class="flex border-b border-gray-200 dark:border-gray-700">
                    <button class="tab-btn active px-6 py-4 text-green-500 border-b-2 border-green-500 font-medium"
                        data-tab="about">
                        Tentang
                    </button>
                    <button
                        class="tab-btn px-6 py-4 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 font-medium"
                        data-tab="tools">
                        Peralatan
                    </button>
                    <button
                        class="tab-btn px-6 py-4 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 font-medium"
                        data-tab="lessons">
                        Materi
                    </button>
                    <button
                        class="tab-btn px-6 py-4 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 font-medium"
                        data-tab="mentor">
                        Mentor
                    </button>
                    <button
                        class="tab-btn px-6 py-4 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 font-medium"
                        data-tab="reviews">
                        Ulasan
                    </button>
                </div>

                <!-- Tab Contents -->
                <div class="p-6">
                    <!-- About Tab -->
                    <div id="about" class="tab-content active">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Deskripsi Kursus</h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-6">
                            {!! strip_tags($course->deskripsi) !!}
                        </p>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Keypoint</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            @foreach ($course->keypoints as $keypoint)
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-green-500 mr-3 mt-1 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-gray-700 dark:text-gray-300">{{ $keypoint['point'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tools Tab Content -->
                    <div id="tools" class="tab-content">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Tools Yang Diperlukan</h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-6">
                            @foreach ($course->techStacks as $tech)
                                <!-- Visual Studio Code -->
                                <div
                                    class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-600 flex flex-col items-center">
                                    <img src="{{ $tech->getFirstMediaUrl('tech-stack-thumbnail') }}"
                                        alt="{{ $tech->nama }}" class="w-20 h-20 mb-4">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ $tech->nama }}
                                    </h4>
                                </div>
                            @endforeach
                        </div>

                        <p class="text-gray-700 dark:text-gray-300 mb-6">
                            Ini adalah beberapa peralatan yang akan Anda butuhkan untuk mengikuti kursus ini. Jika Anda
                            belum memiliki peralatan yang diperlukan, Anda dapat mengunduhnya secara gratis dari situs web
                            resmi.
                        </p>
                    </div>

                    <!-- Lessons Tab Content -->
                    <div id="lessons" class="tab-content">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Silabus Kursus</h3>

                        <div class="space-y-4">
                            <!-- Module 1 -->
                            @foreach ($course->bab as $chapter)
                                <div class="accordion">
                                    <button
                                        class="accordion-btn w-full flex justify-between items-center p-4 text-left bg-gray-50 dark:bg-gray-800 rounded-xl">
                                        <div class="flex items-center">
                                            <span class="text-green-500 dark:text-green-400 font-medium mr-3">Bab
                                                {{ $loop->iteration }}:</span>
                                            <span
                                                class="text-gray-900 dark:text-white font-medium">{{ $chapter->judul }}</span>
                                        </div>
                                        <svg class="accordion-icon w-5 h-5 text-gray-500 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div
                                        class="accordion-content overflow-hidden max-h-0 transition-all duration-300 ease-out">
                                        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                                            <ul class="space-y-3">
                                                @foreach ($chapter->materi as $lesson)
                                                    <li class="flex items-center justify-between">
                                                        <div class="flex items-center">
                                                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            <span
                                                                class="text-gray-700 dark:text-gray-300">{{ $lesson->judul }}</span>
                                                        </div>

                                                        @if (!$lesson->is_terkunci)
                                                            <button type="button"
                                                                onclick="handleMainPlayButton('{{ $lesson->youtube_url }}')"
                                                                class="play-btn p-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition-colors duration-200">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </button>
                                                        @else
                                                            <div
                                                                class="lock-btn p-2 bg-gray-300 text-gray-600 rounded-full cursor-not-allowed">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Mentor Tab -->
                    <div id="mentor" class="tab-content">
                        @foreach ($course->mentors as $mentor)
                            <div class="flex flex-col md:flex-row items-start gap-6 mb-5">
                                <img src="{{ $mentor->avatar_url
                                    ? asset('storage/') . $course->avatar_url
                                    : 'https://ui-avatars.com/api/?name=' . $mentor->name . '&color=7F9CF5&background=EBF4FF' }}"
                                    alt="{{ $mentor->name }}" class="w-32 h-32 rounded-full object-cover">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $mentor->name }}
                                    </h3>
                                    <p class="text-green-500 dark:text-green-400 font-medium mb-4">
                                        {{ $mentor?->custom_fields['occupation'] ?? 'Software Developer' }}</p>
                                    <div class="flex space-x-3">
                                        <a href="{{ $mentor?->custom_fields['linkedin'] ?? '#' }}"
                                            class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                            </svg>
                                        </a>
                                        <a href="{{ $mentor?->custom_fields['github'] ?? '#' }}"
                                            class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="w-6 h-6"
                                                fill="currentColor">
                                                <path
                                                    d="M15,3C8.373,3,3,8.373,3,15c0,5.623,3.872,10.328,9.092,11.63C12.036,26.468,12,26.28,12,26.047v-2.051 c-0.487,0-1.303,0-1.508,0c-0.821,0-1.551-0.353-1.905-1.009c-0.393-0.729-0.461-1.844-1.435-2.526 c-0.289-0.227-0.069-0.486,0.264-0.451c0.615,0.174,1.125,0.596,1.605,1.222c0.478,0.627,0.703,0.769,1.596,0.769 c0.433,0,1.081-0.025,1.691-0.121c0.328-0.833,0.895-1.6,1.588-1.962c-3.996-0.411-5.903-2.399-5.903-5.098 c0-1.162,0.495-2.286,1.336-3.233C9.053,10.647,8.706,8.73,9.435,8c1.798,0,2.885,1.166,3.146,1.481C13.477,9.174,14.461,9,15.495,9 c1.036,0,2.024,0.174,2.922,0.483C18.675,9.17,19.763,8,21.565,8c0.732,0.731,0.381,2.656,0.102,3.594 c0.836,0.945,1.328,2.066,1.328,3.226c0,2.697-1.904,4.684-5.894,5.097C18.199,20.49,19,22.1,19,23.313v2.734 c0,0.104-0.023,0.179-0.035,0.268C23.641,24.676,27,20.236,27,15C27,8.373,21.627,3,15,3z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Reviews Tab -->
                    <div id="reviews" class="tab-content">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Student Reviews</h3>
                                <p class="text-gray-500 dark:text-gray-400">{{ $course->reviews_count }}
                                    ulasan untuk
                                    kelas ini</p>
                            </div>
                            <div class="flex items-center">
                                <div class="mr-4">
                                    <div class="text-4xl font-bold text-gray-900 dark:text-white">
                                        {{ number_format($course->avg_rating, 1) }}
                                    </div>
                                    <div class="flex text-yellow-400">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @forelse ($course->reviews as $review)
                            <!-- Single Review Example -->
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-6 mb-6">
                                <div class="flex items-center mb-4">
                                    <img src="{{ $review->student->avatar_url ? asset('storage/' . $review->student->avatar_url) : 'https://ui-avatars.com/api/?name=' . $review->student->name . '&color=7F9CF5&background=EBF4FF' }}"
                                        alt="Reviewer" class="w-10 h-10 rounded-full mr-4">
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">
                                            {{ $review->student->name ?? 'Tes' }}
                                        </h4>
                                        <p class="text-gray-500 dark:text-gray-400 text-sm">
                                            {{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}
                                        </p>
                                    </div>
                                    <div class="ml-auto flex text-yellow-400">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300">
                                    {{ $review->komentar }}
                                </p>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <p class="text-gray-500 dark:text-gray-400">Belum ada ulasan untuk kursus ini.</p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </main>

    @VideoModalFrontCourse()
    {{-- @Toastr() --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Tab Navigation
            $('.tab-btn').on('click', function() {
                const tab = $(this).data('tab');

                // Remove active class from all tabs
                $('.tab-btn').removeClass('active');
                $('.tab-btn').removeClass('text-green-500 border-b-2 border-green-500');
                $('.tab-btn').addClass(
                    'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200');

                // Hide all tab contents
                $('.tab-content').removeClass('active');

                // Show selected tab content
                $('#' + tab).addClass('active');

                // Style active tab button
                $(this).addClass('active text-green-500 border-b-2 border-green-500');
                $(this).removeClass(
                    'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200');
            });

            // Accordion
            $('.accordion-btn').on('click', function() {
                const accordion = $(this).closest('.accordion');
                const content = accordion.find('.accordion-content');
                const icon = accordion.find('.accordion-icon');

                // Close other open accordions
                $('.accordion').not(accordion).each(function() {
                    const otherContent = $(this).find('.accordion-content');
                    const otherIcon = $(this).find('.accordion-icon');
                    otherContent.css('maxHeight', '0');
                    otherIcon.removeClass('rotate-180');
                });

                // Toggle current accordion
                if (content.css('maxHeight') === '0px' || content.css('maxHeight') === '') {
                    content.css('maxHeight', content[0].scrollHeight + 'px');
                    icon.addClass('rotate-180');
                } else {
                    content.css('maxHeight', '0');
                    icon.removeClass('rotate-180');
                }
            });
        });
    </script>
@endpush
