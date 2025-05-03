@extends('layouts.cp.front')

@section('content')
    <!-- Hero Section -->
    <section
        class="relative pt-20 pb-20 overflow-hidden bg-gradient-to-b from-white via-green-50/30 to-green-100/20 dark:from-gray-900 dark:via-gray-800/30 dark:to-[#151E2E]">
        <!-- Background decorations -->
        <div class="absolute inset-0 pointer-events-none">
            <div
                class="absolute top-0 right-0 w-[500px] h-[500px] bg-green-200/30 dark:bg-green-900/30 rounded-full blur-[120px]">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-200/20 dark:bg-blue-900/20 rounded-full blur-[120px]">
            </div>
            <img src="{{ asset('assets/cp/img/Icon-1.png') }}" alt="icon 1"
                class="hidden md:block absolute top-32 right-32" />
            <img src="{{ asset('assets/cp/img/Icon-4.png') }}" alt="icon 2"
                class="hidden md:block absolute top-20 right-[520px]" />
            <img src="{{ asset('assets/cp/img/Icon-3.png') }}" alt="icon 4"
                class="hidden md:block absolute top-52 right-[440px]" />
            <img src="{{ asset('assets/cp/img/Ornament.png') }}" alt="ornament"
                class="w-full absolute bottom-0 left-0 z-0" />
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
                        <span class="text-green-800 dark:text-green-300 font-medium">Mengembangkan kreativitas bersama
                            LAOS</span>
                    </div>

                    <!-- Hero Text -->
                    <h1 class="text-5xl md:text-6xl font-bold leading-tight text-gray-900 dark:text-white">
                        Selamat Datang,
                        <span class="gradient-text">Laosars!</span>
                    </h1>

                    <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed">
                        UKM LAOS adalah Unit Kegiatan Mahasiswa yang berfokus sebagai wadah
                        untuk memajukan kreativitas dalam pengembangan Linux dan Open Source
                        di Fakultas Ilmu Komputer Universitas Jember.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex items-center gap-6">
                        <a href="#manfaat"
                            class="px-8 py-4 bg-green-500 dark:bg-green-600 text-white rounded-full hover:bg-green-600 dark:hover:bg-green-700 transition-all duration-300 hover:scale-105 font-medium cursor-pointer">
                            Lihat Selengkapnya
                            <svg class="w-5 h-5 ml-2 inline-block" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="relative hidden md:block">
                    <div class="absolute inset-0 bg-green-50 dark:bg-green-900/50 rounded-full blur-3xl opacity-20">
                    </div>
                    <img src="{{ asset('assets/cp/img/maskot-1.png') }}" alt="LAOS Mascot"
                        class="relative z-10 w-full h-auto transform hover:scale-105 transition-transform duration-500">
                </div>
            </div>
        </div>
    </section>
    <!-- Benefits Section -->
    <section
        class="py-24 relative overflow-hidden bg-gradient-to-b from-white via-green-50/30 to-green-100/20 dark:from-[#151E2E] dark:via-gray-800/30 dark:to-gray-900">
        <!-- Background decorations -->
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-72 h-72 bg-green-200/30 dark:bg-green-900/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-200/30 dark:bg-blue-900/30 rounded-full blur-3xl"></div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-200/20 dark:bg-purple-900/20 rounded-full blur-3xl">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                    Manfaat <span class="gradient-text">Laosars</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-300 text-lg">
                    Bergabung dengan UKM LAOS membuka berbagai peluang untuk pengembangan diri dan karir Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Relasi Card -->
                <div
                    class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-50 dark:from-green-900/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative">
                        <div class="mb-6 relative">
                            <div
                                class="absolute inset-0 bg-green-100 dark:bg-green-700 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12 duration-500">
                            </div>
                            <img src="{{ asset('assets/cp/img/networking.png') }}" alt="Networking"
                                class="relative w-16 h-16 mx-auto transform group-hover:scale-110 transition-transform duration-500" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Relasi</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Menambah wawasan membuat terbebas dari permasalahan, relasi yang tepat bisa menemukan ide
                            menyelesaikan masalah dan menambah pengalaman
                        </p>
                    </div>
                </div>

                <!-- Bakat Card -->
                <div
                    class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-50 dark:from-blue-900/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative">
                        <div class="mb-6 relative">
                            <div
                                class="absolute inset-0 bg-blue-100 dark:bg-blue-700 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12 duration-500">
                            </div>
                            <img src="{{ asset('assets/cp/img/cloud-data.png') }}" alt="Cloud Data"
                                class="relative w-16 h-16 mx-auto transform group-hover:scale-110 transition-transform duration-500" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Bakat</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Meningkatkan dan mengembangkan potensi yang ada pada setiap mahasiswa secara optimal melalui
                            berbagai kegiatan
                        </p>
                    </div>
                </div>

                <!-- Sertifikat Card -->
                <div
                    class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-purple-50 dark:from-purple-900/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative">
                        <div class="mb-6 relative">
                            <div
                                class="absolute inset-0 bg-purple-100 dark:bg-purple-700 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12 duration-500">
                            </div>
                            <img src="{{ asset('assets/cp/img/license.png') }}" alt="License"
                                class="relative w-16 h-16 mx-auto transform group-hover:scale-110 transition-transform duration-500" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Sertifikat</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Dapatkan sertifikat keaktifan sebagai anggota UKM LAOS, dukung CV kamu agar jauh lebih baik lagi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Program Section -->
    <section
        class="py-24 relative overflow-hidden bg-gradient-to-b from-white via-green-50/30 to-green-100/20 dark:from-gray-900 dark:via-gray-800/30 dark:to-[#151E2E]">
        <!-- Background decorations -->
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-72 h-72 bg-green-200/30 dark:bg-green-900/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-200/30 dark:bg-blue-900/30 rounded-full blur-3xl"></div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-yellow-200/20 dark:bg-yellow-900/20 rounded-full blur-3xl">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                    Program <span class="gradient-text">Kerja</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-300 text-lg">
                    Program kerja unggulan kami untuk mengembangkan potensi anggota
                </p>
            </div>

            <div class="w-full h-[209px] md:h-[309px] relative">
                @if (count($programs) > 0)
                    <!-- Swiper when programs exist -->
                    <div class="swiper mySwiper w-full max-w-[300px] sm:max-w-[650px] lg:max-w-[986px] h-full">
                        <div class="swiper-wrapper">
                            @foreach ($programs as $program)
                                <div class="swiper-slide h-full group">
                                    <a href="#" class="block h-full relative overflow-hidden rounded-3xl">
                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                            <span
                                                class="text-white text-xl font-bold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                                {{ $program->judul_program }}
                                            </span>
                                        </div>
                                        <img src="{{ $program->getFirstMediaUrl('program-thumbnail') }}"
                                            alt="{{ $program->judul_program }}"
                                            class="w-full h-full object-cover rounded-3xl transform group-hover:scale-105 transition-transform duration-500">
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- Enhanced Navigation Arrows -->
                        <div class="swiper-button-prev absolute z-20 left-4 lg:left-8 top-1/2 transform -translate-y-1/2">
                            <div
                                class="w-12 h-12 flex items-center justify-center bg-white/90 dark:bg-gray-800/90 rounded-full shadow-lg backdrop-blur-sm transition-all duration-300 hover:bg-green-500 group">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white group-hover:text-white" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="swiper-button-next absolute z-20 right-4 lg:right-8 top-1/2 transform -translate-y-1/2">
                            <div
                                class="w-12 h-12 flex items-center justify-center bg-white/90 dark:bg-gray-800/90 rounded-full shadow-lg backdrop-blur-sm transition-all duration-300 hover:bg-green-500 group">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white group-hover:text-white" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>

                        <!-- Add pagination -->
                        <div class="swiper-pagination !-bottom-12"></div>
                    </div>
                @else
                    <!-- Enhanced empty state -->
                    <div
                        class="flex flex-col items-center justify-center h-full bg-gray-50 dark:bg-gray-800/50 rounded-3xl p-8">
                        <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Program Kerja Belum Tersedia
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-center">Program kerja akan segera ditambahkan</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- Division Section -->
    <section
        class="py-24 relative overflow-hidden bg-gradient-to-b from-white via-green-50/30 to-green-100/20 dark:from-[#151E2E] dark:via-gray-800/30 dark:to-gray-900">
        <!-- Background decorations -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-72 h-72 bg-purple-200/30 dark:bg-purple-900/30 rounded-full blur-3xl">
            </div>
            <div class="absolute bottom-0 right-0 w-72 h-72 bg-green-200/30 dark:bg-green-900/30 rounded-full blur-3xl">
            </div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-blue-200/20 dark:bg-blue-900/20 rounded-full blur-3xl">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold mb-6 text-gray-900 dark:text-white">
                    Divisi <span class="gradient-text">Kami</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-300 text-lg">
                    Empat divisi unggulan yang bersinergi mengembangkan potensi dalam bidang teknologi
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Humas Card -->
                <div
                    class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-blue-50 dark:from-blue-900/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative">
                        <div class="mb-6 relative">
                            <div
                                class="absolute inset-0 bg-blue-100 dark:bg-blue-700 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12 duration-500">
                            </div>
                            <img src="{{ asset('assets/cp/img/hums.png') }}" alt="Humas"
                                class="relative w-16 h-16 mx-auto transform group-hover:scale-110 transition-transform duration-500" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Hubungan Masyarakat</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Divisi yang bertanggung jawab dalam penyebaran informasi di lingkup Fakultas Ilmu Komputer
                            Universitas Jember
                        </p>
                    </div>
                </div>

                <!-- Programming Card -->
                <div
                    class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-50 dark:from-green-900/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative">
                        <div class="mb-6 relative">
                            <div
                                class="absolute inset-0 bg-green-100 dark:bg-green-700 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12 duration-500">
                            </div>
                            <img src="{{ asset('assets/cp/img/pemro.png') }}" alt="Programming"
                                class="relative w-16 h-16 mx-auto transform group-hover:scale-110 transition-transform duration-500" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Pemrograman</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Divisi yang berfokus pada pemrograman untuk mewujudkan tujuan UKM LAOS dalam menyebarkan open
                            source
                        </p>
                    </div>
                </div>

                <!-- Cyber Security Card -->
                <div
                    class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-yellow-50 dark:from-yellow-900/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative">
                        <div class="mb-6 relative">
                            <div
                                class="absolute inset-0 bg-yellow-100 dark:bg-yellow-700 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12 duration-500">
                            </div>
                            <img src="{{ asset('assets/cp/img/cysec.png') }}" alt="Cyber Security"
                                class="relative w-16 h-16 mx-auto transform group-hover:scale-110 transition-transform duration-500" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Cyber Security</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Divisi yang memberikan wawasan mengenai Linux, jaringan komputer, dan keamanan siber
                        </p>
                    </div>
                </div>

                <!-- Multimedia Card -->
                <div
                    class="group bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-purple-50 dark:from-purple-900/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative">
                        <div class="mb-6 relative">
                            <div
                                class="absolute inset-0 bg-purple-100 dark:bg-purple-700 rounded-2xl transform rotate-6 transition-transform group-hover:rotate-12 duration-500">
                            </div>
                            <img src="{{ asset('assets/cp/img/mulmed.png') }}" alt="Multimedia"
                                class="relative w-16 h-16 mx-auto transform group-hover:scale-110 transition-transform duration-500" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Multimedia</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Divisi yang berfokus pada desain UI/UX dan pengelolaan konten media sosial UKM LAOS
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
