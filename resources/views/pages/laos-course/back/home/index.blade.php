@extends('layouts.laos-course.back')

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 md:p-8 shadow-lg relative overflow-hidden card-shine">
        <div
            class="absolute inset-0 bg-gradient-to-br from-green-50/90 dark:from-green-900/30 via-white/30 dark:via-gray-800/50 to-transparent">
        </div>

        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-72 h-72 bg-green-200/30 dark:bg-green-900/30 rounded-full blur-3xl float">
        </div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-200/20 dark:bg-blue-900/20 rounded-full blur-3xl">
        </div>

        <!-- Abstract shapes -->
        <div class="absolute right-20 top-16 w-16 h-16 bg-green-400/10 dark:bg-green-500/10 rounded-full hidden md:block">
        </div>
        <div class="absolute left-24 bottom-8 w-12 h-12 bg-blue-400/10 dark:bg-blue-500/10 rounded-full hidden md:block">
        </div>
        <div class="absolute right-48 bottom-12 w-8 h-8 bg-green-300/20 dark:bg-green-600/20 rounded-full hidden md:block">
        </div>

        <div class="relative z-10">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-6">
                <div class="relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-400 to-blue-500 dark:from-green-500 dark:to-blue-600 rounded-xl md:rounded-2xl transform rotate-6 transition-transform duration-500 hover:rotate-12 hover:scale-105">
                    </div>
                    <img src="{{ Auth::user()->avatar_url ? asset('storage/' . Auth::user()->avatar_url) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name . '&background=16a34a&color=fff&bold=true&font-family=Poppins&size=128' }}"
                        alt="User" class="relative w-16 h-16 md:w-20 md:h-20 rounded-xl md:rounded-2xl shadow-lg">
                </div>

                <div>
                    <div class="flex items-center flex-wrap gap-2">
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                            Selamat Datang, <span class="gradient-text">{{ ucwords(Auth::user()->name) }}</span>
                        </h1>
                        <div class="p-1 bg-green-100 dark:bg-green-900/40 rounded-full">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-green-500 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mt-2 text-base md:text-lg">
                        Mari belajar bersama dan tingkatkan kemampuanmu!
                    </p>
                    <div class="mt-2 flex items-center text-xs md:text-sm text-gray-400 dark:text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Last login: Today, {{ now()->format('H:i A') }}
                    </div>
                </div>
            </div>

            <div class="mt-6 md:mt-8 flex flex-col sm:flex-row flex-wrap gap-3 md:gap-4">
                <a href="{{ route('course.kelas.index') }}"
                    class="px-4 md:px-6 py-3 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-300 shadow-sm hover:shadow flex items-center justify-center md:justify-start gap-2 transform hover:translate-y-[-2px] w-full sm:w-auto">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    <span>Cari Kursus</span>
                </a>
            </div>
        </div>
    </div>

    <!-- My Courses Section -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Kursus Terbaru Saya</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($myCourses as $course)
                @MyCourseBackCourse([
                    'course' => $course->kursus,
                    'progress' => ($course->progres_count / $course->kursus->materi_count) * 100,
                    'currentLesson' => $course->progres->first(),
                ])
            @empty
                @EmptyStateBackCourse()
            @endforelse
        </div>
    </div>
@endsection
