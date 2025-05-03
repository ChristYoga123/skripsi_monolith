<footer class="bg-gray-900 text-white pt-20 pb-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <!-- Brand Section -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="w-12 h-12" />
                    <span class="text-2xl font-bold gradient-text">UKM LAOS</span>
                </div>
                <p class="text-gray-400 leading-relaxed">
                    Empowering students with cutting-edge tech education and mentorship from industry experts.
                </p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-green-500 transition-colors duration-300">
                        <img src="{{ asset('assets/laos-course/img/wa.svg') }}" alt="WhatsApp" class="w-5 h-5" />
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-green-500 transition-colors duration-300">
                        <img src="{{ asset('assets/laos-course/img/ig.svg') }}" alt="Instagram" class="w-5 h-5" />
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-green-500 transition-colors duration-300">
                        <img src="{{ asset('assets/laos-course/img/gh.svg') }}" alt="Github" class="w-5 h-5" />
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-6">Quick Links</h3>
                <ul class="space-y-4">
                    @foreach ($menus as $menu)
                        <li><a href="{{ $menu['route'] }}"
                                class="text-gray-400 hover:text-white transition-colors">{{ $menu['title'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Courses -->
            <div>
                <h3 class="text-lg font-semibold mb-6">Kursus Kami</h3>
                <ul class="space-y-4">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Programming</a>
                    </li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Cyber
                            Security</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">UI/UX
                            Design</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Digital
                            Marketing</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold mb-6">Kontak</h3>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-3 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Malang, East Java, Indonesia</span>
                    </li>
                    <li class="flex items-center space-x-3 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>info@ukmlaos.com</span>
                    </li>
                    <li class="flex items-center space-x-3 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>+62 812 3456 7890</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="pt-8 border-t border-gray-800 text-center">
            <p class="text-gray-400">&copy; {{ date('Y') }} UKM LAOS. All rights reserved.</p>
        </div>
    </div>
</footer>
