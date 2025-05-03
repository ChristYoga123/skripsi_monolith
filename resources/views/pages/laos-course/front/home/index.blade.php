@extends('layouts.laos-course.front')
@php
    use App\Enums\LaosCourse\Kursus\KategoriEnum;
@endphp
@section('content')
    <!-- Hero Section -->
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
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 dark:bg-green-900/50 rounded-full">
                        <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="text-green-800 dark:text-green-300 font-medium">Belajar dari mentor terbaik di
                            bidangnya</span>
                    </div>

                    <!-- Hero Text -->
                    <h1 class="text-5xl md:text-6xl font-bold leading-tight text-gray-900 dark:text-white">
                        Kuasai Keterampilan Baru untuk
                        <span class="gradient-text">Masa Depan Cerah</span>
                    </h1>

                    <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed">
                        Transformasikan karir Anda dengan kursus yang relevan dengan industri. Belajar dengan kecepatan
                        sendiri didampingi oleh ahli dan proyek langsung yang menantang.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex items-center gap-6">
                        <a href="#"
                            class="px-8 py-4 bg-green-500 dark:bg-green-600 text-white rounded-full hover:bg-green-600 dark:hover:bg-green-700 transition-all duration-300 hover:scale-105 font-medium cursor-pointer">
                            Jelajahi Kursus
                        </a>
                        <button
                            class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-green-500 dark:hover:text-green-400 transition-colors cursor-pointer">
                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium">Tonton Demo</span>
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="flex items-center gap-8 mt-12">
                        <div class="text-center">
                            <h3 class="text-3xl font-bold text-green-500 dark:text-green-400">50K+</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Student Aktif</p>
                        </div>
                        <div class="text-center">
                            <h3 class="text-3xl font-bold text-green-500 dark:text-green-400">100+</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Mentor Ahli</p>
                        </div>
                        <div class="text-center">
                            <h3 class="text-3xl font-bold text-green-500 dark:text-green-400">200+</h3>
                            <p class="text-gray-600 dark:text-gray-400 mt-1">Kursus Profesional</p>
                        </div>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="relative hidden md:block mt-24">
                    <div class="absolute inset-0 bg-green-50 dark:bg-green-900/50 rounded-full blur-3xl opacity-20">
                    </div>
                    <img src="{{ asset('assets/laos-course/img/hero-ilustration.png') }}" alt="Hero"
                        class="relative z-10 w-full h-auto float">
                </div>
            </div>
        </div>
    </section>

    <!-- Interest/Categories Section -->
    <section
        class="py-24 relative overflow-hidden bg-gradient-to-b from-green-50/30 dark:from-[#101828] to-white dark:to-gray-900">
        <div
            class="absolute inset-0 bg-gradient-to-b from-green-50/40 dark:from-gray-800/40 via-white dark:via-gray-900 to-white dark:to-gray-900">
        </div>
        <!-- Decorative background elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-72 h-72 bg-green-200/30 dark:bg-green-900/30 rounded-full blur-3xl">
            </div>
            <div class="absolute bottom-14 left-0 w-72 h-72 bg-blue-200/30 dark:bg-blue-900/30 rounded-full blur-3xl">
            </div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-200/20 dark:bg-purple-900/20 rounded-full blur-3xl">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                    Temukan Learning Path Yang Sempurna <span class="gradient-text">Untuk Anda</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-300 text-lg">
                    Pilih dari koleksi kursus IT unggulan kami yang dirancang khusus untuk memenuhi kebutuhan industri dan
                    mendukung tujuan karir Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Programming Card -->
                <div
                    class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-50 dark:from-green-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    <div class="relative">
                        <div class="mb-6 relative">
                            <div
                                class="absolute inset-0 bg-green-100 dark:bg-green-700 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12 duration-500">
                            </div>
                            <img src="{{ asset('assets/laos-course/img/programming.png') }}" alt="Programming"
                                class="relative w-16 h-16 mx-auto transform group-hover:scale-110 transition-transform duration-500" />
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Programming</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">Kuasai bahasa pemrograman dan framework modern</p>

                        <div class="flex items-center justify-between">
                            <span
                                class="text-green-500 dark:text-green-400 font-semibold">{{ $courseCountsByCategory[KategoriEnum::PROGRAMMING->value] ?? 0 }}
                                Courses</span>
                        </div>
                    </div>
                </div>

                <!-- Cyber Security Card -->
                <div
                    class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-50 dark:from-blue-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    <div class="relative">
                        <div class="mb-6 relative">
                            <div
                                class="absolute inset-0 bg-blue-100 dark:bg-blue-700 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12 duration-500">
                            </div>
                            <img src="{{ asset('assets/laos-course/img/cyber-security.png') }}" alt="Cyber Security"
                                class="relative w-16 h-16 mx-auto transform group-hover:scale-110 transition-transform duration-500" />
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Cyber Security</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">Pelajari praktik dan protokol keamanan cyber
                            tingkat lanjut</p>

                        <div class="flex items-center justify-between">
                            <span class="text-green-500 dark:text-green-400 font-semibold">
                                {{ $courseCountsByCategory[KategoriEnum::CYBER_SECURITY->value] ?? 0 }}
                                Courses
                            </span>
                        </div>
                    </div>
                </div>

                <!-- UI/UX Design Card -->
                <div
                    class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-purple-50 dark:from-purple-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    <div class="relative">
                        <div class="mb-6 relative">
                            <div
                                class="absolute inset-0 bg-purple-100 dark:bg-purple-700 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12 duration-500">
                            </div>
                            <img src="{{ asset('assets/laos-course/img/design.png') }}" alt="Design"
                                class="relative w-16 h-16 mx-auto transform group-hover:scale-110 transition-transform duration-500" />
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">UI/UX Design</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">Ciptakan pengalaman pengguna yang indah dan
                            intuitif</p>

                        <div class="flex items-center justify-between">
                            <span class="text-green-500 dark:text-green-400 font-semibold">
                                {{ $courseCountsByCategory[KategoriEnum::DESIGN->value] ?? 0 }} Courses
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Digital Marketing Card -->
                <div
                    class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-yellow-50 dark:from-yellow-900/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>

                    <div class="relative">
                        <div class="mb-6 relative">
                            <div
                                class="absolute inset-0 bg-yellow-100 dark:bg-yellow-700 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12 duration-500">
                            </div>
                            <img src="{{ asset('assets/laos-course/img/digital-marketing.png') }}" alt="Digital Marketing"
                                class="relative w-16 h-16 mx-auto transform group-hover:scale-110 transition-transform duration-500" />
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Digital Marketing</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">Kuasai strategi pemasaran digital modern</p>

                        <div class="flex items-center justify-between">
                            <span class="text-green-500 dark:text-green-400 font-semibold">
                                {{ $courseCountsByCategory[KategoriEnum::DIGITAL_MARKETING->value] ?? 0 }}
                                Courses
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Courses Section -->
    <section
        class="py-24 relative overflow-hidden bg-gradient-to-b from-green-50/30 to-white dark:from-[#121828] dark:to-gray-900">
        <div
            class="absolute inset-0 bg-gradient-to-b from-[#FEFEFF] dark:from-[#121828] via-white dark:via-gray-900 to-white dark:to-gray-900">
        </div>
        <!-- Decorative background elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-72 h-72 bg-blue-200/30 dark:bg-blue-900/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-72 h-72 bg-green-200/30 dark:bg-green-900/30 rounded-full blur-3xl">
            </div>
            <div class="absolute top-1/2 right-1/3 w-96 h-96 bg-yellow-200/20 dark:bg-yellow-900/20 rounded-full blur-3xl">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                    Kursus <span class="gradient-text">Terbaru</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-300 text-lg">
                    Temukan peluang belajar terbaru kami yang dirancang untuk menjaga Anda tetap terdepan di bidang Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($latestCourses as $course)
                    @CourseCardFrontCourse(['course' => $course])
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="#"
                    class="inline-flex items-center px-8 py-4 bg-green-500 dark:bg-green-600 text-white rounded-full hover:bg-green-600 dark:hover:bg-green-700 transition-all duration-300 transform hover:scale-105 font-medium">
                    Lihat Kursus Lainnya
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @VideoModalFrontCourse()
    <!-- Testimonials Section -->
    <section
        class="relative py-24 overflow-hidden bg-gradient-to-b from-white to-green-50/30 dark:from-[#111828] dark:to-gray-800/30">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-12 right-0 w-96 h-96 bg-green-200 dark:bg-green-800 rounded-full blur-3xl"></div>
            <div class="absolute bottom-14 left-0 w-96 h-96 bg-blue-200 dark:bg-blue-800 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                    Pesan Kesan <span class="gradient-text">Student Kami</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-300 text-lg">
                    Temukan bagaimana UKM LAOS telah membantu ribuan siswa mencapai tujuan karir mereka
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($reviews as $review)
                    <!-- Testimonial Card 1 -->
                    <div
                        class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-green-50 dark:from-green-900/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>

                        <div class="relative">
                            <div class="flex items-center mb-6">
                                <div class="relative">
                                    <div
                                        class="absolute inset-0 bg-green-200 dark:bg-green-700 rounded-full blur group-hover:bg-green-300 dark:group-hover:bg-green-600 transition-colors duration-300">
                                    </div>
                                    <img src="{{ $review->student->avatar_url ? asset('storage/' . $review->student->avatar_url) : "https://ui-avatars.com/api/?name={$review->student->name}" }}"
                                        alt="Avatar"
                                        class="relative w-14 h-14 rounded-full border-4 border-white dark:border-gray-700 shadow-lg group-hover:scale-105 transition-transform duration-300" />
                                </div>
                                <div class="ml-4">
                                    <h3
                                        class="font-bold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                                        {{ $review->student->name }}</h3>
                                    <p class="text-green-500 dark:text-green-400">
                                        {{ $review->student->custom_fields['job'] ?? 'Software Developer' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-1 mb-4">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <img src="{{ asset('assets/laos-course/img/star.svg') }}" alt="star"
                                        class="w-5 h-5">
                                @endfor
                            </div>

                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                "{{ $review->komentar }}"
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section
        class="py-24 relative overflow-hidden bg-gradient-to-b from-white to-green-50/30 dark:from-[#141D2C] dark:to-gray-800/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900 dark:text-white">
                    Frequently Asked
                    <span class="gradient-text">Questions</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-300 text-lg md:text-xl">
                    Dapatkan jawaban cepat untuk pertanyaan umum tentang kursus dan proses pembelajaran kami
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6 max-w-6xl mx-auto">
                <!-- FAQ Item 1 - Course Price -->
                <div
                    class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 hover:border-green-100 dark:hover:border-green-800 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-50/30 dark:from-green-900/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="flex items-start gap-4 relative">
                        <div
                            class="w-8 h-8 flex items-center justify-center bg-green-100 dark:bg-green-900 rounded-lg flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                Apa saja yang termasuk dalam harga kursus?
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                                Akses penuh ke semua materi kursus, file proyek, sesi mentoring, sertifikat penyelesaian,
                                dan pembaruan seumur hidup.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute inset-0 -z-10">
                <div
                    class="absolute top-0 left-0 w-72 h-72 bg-green-100/30 dark:bg-green-900/30 rounded-full blur-3xl animate-pulse">
                </div>
                <div
                    class="absolute bottom-0 right-0 w-72 h-72 bg-green-100/20 dark:bg-green-900/20 rounded-full blur-3xl">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section
        class="py-24 bg-gradient-to-b from-white to-green-50/30 dark:from-[#151E2D] dark:to-gray-800/30 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Image Side -->
                <div class="relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-green-200 to-blue-200 dark:from-green-900 dark:to-blue-900 rounded-3xl transform -rotate-6 transition-colors duration-300">
                    </div>
                    <img src="{{ asset('assets/laos-course/img/subscription-now-image.png') }}" alt="Start Learning"
                        class="relative rounded-3xl shadow-xl w-full h-auto" />
                </div>

                <!-- Content Side -->
                <div class="space-y-8">
                    <h2
                        class="text-4xl font-bold leading-tight text-gray-900 dark:text-white transition-colors duration-300">
                        Siap Memulai Perjalanan Belajar Anda bersama
                        <span class="gradient-text">UKM LAOS?</span>
                    </h2>

                    <!-- Features List -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900 transition-colors duration-300">
                                <svg class="w-6 h-6 text-green-500 dark:text-green-400" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-lg text-gray-700 dark:text-gray-300 transition-colors duration-300">Akses
                                seumur hidup untuk semua materi kursus</span>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900 transition-colors duration-300">
                                <svg class="w-6 h-6 text-green-500 dark:text-green-400" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-lg text-gray-700 dark:text-gray-300 transition-colors duration-300">"Belajar
                                secara fleksibel</span>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900 transition-colors duration-300">
                                <svg class="w-6 h-6 text-green-500 dark:text-green-400" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                            </div>
                            <span class="text-lg text-gray-700 dark:text-gray-300 transition-colors duration-300">Dukungan
                                mentor ahli</span>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <button
                        class="px-8 py-4 bg-green-500 dark:bg-green-600 text-white rounded-full hover:bg-green-600 dark:hover:bg-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-medium flex items-center group">
                        Mulai Sekarang
                        <svg class="ml-2 w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection
