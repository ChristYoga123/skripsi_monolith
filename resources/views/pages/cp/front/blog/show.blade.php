@extends('layouts.cp.front')

@section('content')
    <main
        class="relative overflow-hidden bg-gradient-to-b from-white via-green-50/30 to-green-100/20 dark:from-gray-900 dark:via-gray-800/30 dark:to-[#151E2E]">
        <!-- Background decorations -->
        <div class="absolute inset-0">
            <div
                class="absolute top-0 right-0 w-[500px] h-[500px] bg-green-200/30 dark:bg-green-900/30 rounded-full blur-[120px]">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-200/20 dark:bg-blue-900/20 rounded-full blur-[120px]">
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-20 lg:mt-20">
            <!-- Featured Image with enhanced styling -->
            <div class="relative rounded-2xl overflow-hidden shadow-xl mb-12 max-w-5xl mx-auto">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/20 to-blue-500/20 mix-blend-overlay"></div>
                <img src="{{ $article->getFirstMediaUrl('blog-thumbnail') }}" alt="{{ $article->slug }}"
                    class="w-full h-[400px] object-cover" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
            </div>

            <!-- Article Container -->
            <div class="max-w-4xl mx-auto">
                <!-- Article Header -->
                <div class="mb-8">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-50 dark:bg-green-900/50 rounded-full">
                            <svg class="w-4 h-4 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span
                                class="text-green-800 dark:text-green-300 text-sm font-medium">{{ ucwords($article->kategori->getLabel()) }}</span>
                        </div>
                        <span class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $article->created_at->format('d F Y') }}
                        </span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white leading-tight mb-6">
                        {{ $article->judul }}
                    </h1>

                    <div class="flex items-center gap-3 mb-8">
                        <img src="https://i.pinimg.com/736x/cf/0d/9d/cf0d9d6269d928b9a41a17ff5dd081b0.jpg" alt="Author"
                            class="w-10 h-10 rounded-full object-cover shadow-md ring-2 ring-white dark:ring-gray-800" />
                        <div>
                            <p class="text-sm text-gray-900 dark:text-white">
                                Ditulis oleh
                                <span class="text-green-600 dark:text-green-400 font-medium">Divisi
                                    {{ $article->divisi->nama }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Article Content -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 md:p-8 shadow-lg">
                    <article class="prose prose-lg prose-green dark:prose-invert mx-auto dark:text-white">
                        {!! $article->konten !!}
                    </article>

                    <!-- Article Footer -->
                    <div class="mt-12 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Bagikan:</span>
                                <div class="flex gap-2">
                                    <button
                                        class="p-2 rounded-full bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-800/50 transition-all duration-300">
                                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4Z" />
                                        </svg>
                                    </button>
                                    <button
                                        class="p-2 rounded-full bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-800/50 transition-all duration-300">
                                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                        </svg>
                                    </button>
                                    <button
                                        class="p-2 rounded-full bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-800/50 transition-all duration-300">
                                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <a href="{{ route('cp.blog.index') }}"
                                class="group px-4 py-2 bg-green-500 dark:bg-green-600 text-white rounded-lg hover:bg-green-600 dark:hover:bg-green-700 transition-all duration-300 text-sm font-medium flex items-center gap-2">
                                <span>Kembali ke Artikel</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
