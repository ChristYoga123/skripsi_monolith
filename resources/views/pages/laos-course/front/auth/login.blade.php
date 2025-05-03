@extends('layouts.laos-course.front')

@section('content')
    <!-- Login Section -->
    <section
        class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-white via-green-50/30 to-green-100/20 dark:from-gray-900 dark:via-gray-800/30 dark:to-[#151E2E]">
        <!-- Background decorations -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute top-0 right-0 w-[500px] h-[500px] bg-green-200/30 dark:bg-green-900/30 rounded-full blur-[120px]">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-200/20 dark:bg-blue-900/20 rounded-full blur-[120px]">
            </div>
        </div>

        <div class="relative z-10 w-full max-w-5xl mx-auto flex items-center justify-center mt-16">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden w-full max-w-4xl">
                <div class="flex flex-col md:flex-row">
                    <!-- Left side - Login Form -->
                    <div class="w-full md:w-1/2 p-6 sm:p-8">
                        <!-- Logo/Header -->
                        <div class="text-center md:text-left mb-6">
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Welcome Back</h2>
                            <p class="mt-2 text-sm sm:text-base text-gray-600 dark:text-gray-400">Sign in to your account to
                                continue</p>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('course.auth.authenticate') }}"
                            class="space-y-4 sm:space-y-6">
                            @csrf

                            <!-- Email Input -->
                            @TextInputFrontCourse([
                                'id' => 'email',
                                'type' => 'email',
                                'placeholder' => 'Masukkan email',
                                'required' => true,
                            ])

                            <!-- Password Input -->
                            @TextInputFrontCourse([
                                'id' => 'password',
                                'type' => 'password',
                                'placeholder' => 'Masukkan password',
                                'required' => true,
                            ])

                            <!-- Remember Me -->
                            @CheckboxInputFrontCourse([
                                'id' => 'remember',
                                'label' => 'Ingat saya',
                            ])

                            <!-- Submit Button -->
                            @ButtonFrontCourse([
                            'text' => 'Masuk',
                            'type' => 'submit',
                            'class' => 'w-full',
                            ])
                        </form>

                        <!-- Divider -->
                        <div class="mt-4 sm:mt-6 flex items-center justify-center">
                            <div class="border-t border-gray-300 dark:border-gray-600 flex-grow"></div>
                            <div class="mx-4 text-xs sm:text-sm text-gray-500 dark:text-gray-400">Or</div>
                            <div class="border-t border-gray-300 dark:border-gray-600 flex-grow"></div>
                        </div>

                        <!-- Google OAuth Button -->
                        <div class="mt-4 sm:mt-6">
                            <a href="#"
                                class="w-full flex items-center justify-center px-4 py-2 sm:py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-200">
                                <svg class="h-4 w-4 sm:h-5 sm:w-5 mr-2" viewBox="0 0 24 24" width="24" height="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g transform="matrix(1, 0, 0, 1, 27.009001, -39.238998)">
                                        <path fill="#4285F4"
                                            d="M -3.264 51.509 C -3.264 50.719 -3.334 49.969 -3.454 49.239 L -14.754 49.239 L -14.754 53.749 L -8.284 53.749 C -8.574 55.229 -9.424 56.479 -10.684 57.329 L -10.684 60.329 L -6.824 60.329 C -4.564 58.239 -3.264 55.159 -3.264 51.509 Z" />
                                        <path fill="#34A853"
                                            d="M -14.754 63.239 C -11.514 63.239 -8.804 62.159 -6.824 60.329 L -10.684 57.329 C -11.764 58.049 -13.134 58.489 -14.754 58.489 C -17.884 58.489 -20.534 56.379 -21.484 53.529 L -25.464 53.529 L -25.464 56.619 C -23.494 60.539 -19.444 63.239 -14.754 63.239 Z" />
                                        <path fill="#FBBC05"
                                            d="M -21.484 53.529 C -21.734 52.809 -21.864 52.039 -21.864 51.239 C -21.864 50.439 -21.724 49.669 -21.484 48.949 L -21.484 45.859 L -25.464 45.859 C -26.284 47.479 -26.754 49.299 -26.754 51.239 C -26.754 53.179 -26.284 54.999 -25.464 56.619 L -21.484 53.529 Z" />
                                        <path fill="#EA4335"
                                            d="M -14.754 43.989 C -12.984 43.989 -11.404 44.599 -10.154 45.789 L -6.734 42.369 C -8.804 40.429 -11.514 39.239 -14.754 39.239 C -19.444 39.239 -23.494 41.939 -25.464 45.859 L -21.484 48.949 C -20.534 46.099 -17.884 43.989 -14.754 43.989 Z" />
                                    </g>
                                </svg>
                                Masuk dengan Google
                            </a>
                        </div>

                        <!-- Registration Link -->
                        <div class="mt-4 sm:mt-6 text-center md:text-left">
                            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                Belum punya akun?
                                <a href="{{ route('course.auth.register') }}"
                                    class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 font-medium transition-colors">
                                    Daftar Sekarang
                                </a>
                            </p>
                        </div>
                    </div>

                    <!-- Right side - Image -->
                    <div class="hidden md:block md:w-1/2 bg-green-100 dark:bg-gray-700">
                        <div class="h-full flex items-center justify-center p-6">
                            <div class="relative w-full h-full overflow-hidden rounded-xl">
                                <!-- You can replace this with an actual image -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-green-400 to-blue-500 opacity-80 dark:opacity-60">
                                </div>
                                <div class="relative z-10 h-full flex flex-col items-center justify-center text-white p-6">
                                    <img src="{{ asset('logo.png') }}" alt="Logo Laos" class="mb-5 w-32 max-w-full h-auto">
                                    <h3 class="text-xl sm:text-2xl font-bold mb-2 text-center">Learn Anywhere, Anytime</h3>
                                    <p class="text-center text-white/90 text-sm sm:text-base">Access our comprehensive
                                        courses and improve your
                                        skills from any device, anywhere in the world.</p>

                                    <!-- Testimonial -->
                                    <div
                                        class="mt-6 sm:mt-8 bg-white/20 dark:bg-gray-800/40 p-3 sm:p-4 rounded-lg backdrop-blur-sm">
                                        <p class="italic text-xs sm:text-sm">"This platform transformed my learning
                                            experience. The
                                            courses are exceptional and the support is outstanding!"</p>
                                        <p class="mt-2 font-semibold text-xs sm:text-sm">- Sarah Johnson, Web Developer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
