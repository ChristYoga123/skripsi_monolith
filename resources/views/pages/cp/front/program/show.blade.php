@extends('layouts.cp.front')

@section('content')
    <div class="min-h-screen bg-white dark:bg-gray-900 text-gray-600 dark:text-white">
        <div class="max-w-6xl mx-auto px-4 py-10">
            <!-- Program Header -->
            <div
                class="bg-gray-100 dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden mb-8 mt-12 md:mt-24">
                <!-- Program Image Banner -->
                <div class="relative h-64 md:h-80 w-full overflow-hidden">
                    <img src="{{ $program->getFirstMediaUrl('program-thumbnail') }}" alt="{{ $program->judul_kegiatan }}"
                        class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 w-full p-6 text-white">
                        <div class="flex items-center gap-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-green-base" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span class="text-sm font-medium">Detail Program</span>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold">
                            {{ $program->judul_kegiatan }}
                        </h1>
                    </div>
                </div>

                <!-- Program Info -->
                <div class="p-6">
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name={{ $program->divisi->nama }}&background=374151&color=D1D5DB&size=48"
                            alt="Divisi {{ $program->divisi->nama }}" class="w-12 h-12 rounded-full object-cover" />
                        <div>
                            <p class="text-base text-gray-600 dark:text-white">
                                Program dari
                                <span class="font-semibold text-primary-green-base">Divisi
                                    {{ $program->divisi->nama }}</span>
                            </p>
                            <p class="text-sm text-gray-600 dark:text-white">
                                Periode 2024/2025
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- About Program Section -->
                    <section
                        class="bg-gray-100 dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="flex items-center gap-2 p-6 border-b border-gray-200 dark:border-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-green-base" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h2 class="text-xl font-medium">
                                Tentang <span class="text-primary-green-base">Program</span>
                            </h2>
                        </div>

                        <div class="p-6">
                            <div
                                class="prose prose-sm md:prose max-w-none text-gray-600 prose-headings:text-gray-600 prose-a:text-primary-green-base dark:text-white">
                                {!! $program->konten !!}
                            </div>
                        </div>
                    </section>

                    <!-- Replace the existing gallery code with this updated version -->
                    <div class="p-6">
                        @if (isset($documentations) && count($documentations) > 0)
                            <div class="relative">
                                <!-- Thumbnails Gallery -->
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-4">
                                    @foreach ($documentations as $index => $documentation)
                                        <div class="aspect-square rounded-lg overflow-hidden  hover:opacity-80 transition-opacity border border-gray-700 shadow-md cursor-zoom-in"
                                            onclick="openGalleryModal({{ $index - 1 }})">
                                            <img src="{{ $documentation['url'] }}" alt="{{ $program->judul_kegiatan }}"
                                                class="w-full h-full object-cover" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div
                                class="py-16 text-center text-gray-600 dark:text-white bg-gray-50 dark:bg-gray-850 rounded-xl border border-gray-200 dark:border-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-gray-600"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <h3 class="text-xl font-medium">Dokumentasi Belum Tersedia</h3>
                                <p class="mt-2 text-gray-600">Foto dan dokumentasi kegiatan akan ditampilkan di sini.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Gallery Modal -->
                    <div id="galleryModal"
                        class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
                        <div class="relative w-full max-w-4xl mx-auto">
                            <!-- Close Button -->
                            <button onclick="closeGalleryModal()"
                                class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <!-- Navigation Buttons -->
                            <button id="prevButton" onclick="changeGalleryImage(-1)"
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>

                            <button id="nextButton" onclick="changeGalleryImage(1)"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            <!-- Image Container -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-2xl">
                                <div class="relative pb-[75%]">
                                    <img id="modalImage" src="" alt="Gallery Image"
                                        class="absolute inset-0 w-full h-full object-contain" />
                                </div>
                                <div class="p-4 bg-white dark:bg-gray-800 text-gray-600 dark:text-white">
                                    <p id="imageCounter" class="text-center text-sm"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Content -->
                <div class="space-y-8">
                    <!-- Time & Schedule Section  -->
                    <section
                        class="bg-gray-100 dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="flex items-center gap-2 p-6 border-b border-gray-200 dark:border-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-green-base"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h2 class="text-xl font-medium">
                                Jadwal <span class="text-primary-green-base">Kegiatan</span>
                            </h2>
                        </div>

                        <div class="p-6">
                            <!-- Schedule Timeline -->
                            <div
                                class="relative pl-8 space-y-8 before:absolute before:inset-y-0 before:left-3 before:w-0.5 before:bg-gray-600">
                                @if (isset($program->jadwal_kegiatan) && count($program->jadwal_kegiatan) > 0)
                                    @foreach ($program->jadwal_kegiatan as $key => $schedule)
                                        <div class="relative">
                                            <div
                                                class="absolute left-[-32px] top-0 w-6 h-6 rounded-full bg-amber-500 flex items-center justify-center">
                                                <div class="w-3 h-3 rounded-full bg-gray-800"></div>
                                            </div>
                                            <div>
                                                <h3 class="font-medium text-gray-600 dark:text-white">
                                                    {{ $schedule['jadwal'] ?? 'Jadwal' }}
                                                </h3>
                                                <p class="mt-1 text-sm text- dark:text-white">
                                                    {{ Carbon\Carbon::parse($schedule['waktu'])->translatedFormat('l, d F Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="relative">
                                        <div
                                            class="absolute left-[-32px] top-0 w-6 h-6 rounded-full bg-amber-500 flex items-center justify-center">
                                            <div class="w-3 h-3 rounded-full bg-gray-800"></div>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-600 dark:text-white">
                                                Jadwal belum tersedia
                                            </h3>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-white">
                                                Jadwal kegiatan akan diumumkan segera
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>

                    <section
                        class="bg-gray-100 dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="flex items-center gap-2 p-6 border-b border-gray-200 dark:border-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-green-base"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <h2 class="text-xl font-medium">
                                Lokasi <span class="text-primary-green-base">Kegiatan</span>
                            </h2>
                        </div>

                        <div class="p-6">
                            <div class="w-full h-[200px] rounded-lg overflow-hidden shadow-md mb-4">
                                <iframe
                                    src="https://maps.google.com/maps?q=-8.1822364782803,113.66155261659&z=12&output=embed"
                                    width="100%" height="450" frameborder="0" style="border:0"
                                    allowfullscreen></iframe>
                            </div>
                            <h3 id="location-name" class="font-medium text-gray-600 dark:text-white">
                                {{ $program->location_name ?? 'Memuat...' }}
                            </h3>
                            <p id="location-address" class="mt-1 text-sm text-gray-600 dark:text-white">
                                {{ $program->location_address ?? 'Memuat alamat...' }}
                            </p>
                        </div>
                    </section>

                    <!-- Add this after the Location section in the Sidebar Content -->
                    <section
                        class="bg-gray-100 dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="flex items-center gap-2 p-6 border-b border-gray-200 dark:border-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-green-base"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <h2 class="text-xl font-medium">
                                Pendaftaran <span class="text-primary-green-base">Program</span>
                            </h2>
                        </div>

                        <div class="p-6 space-y-4">
                            <!-- Committee Registration Button -->
                            @php
                                $now = \Carbon\Carbon::now();
                                $openRegisPanitia = \Carbon\Carbon::parse($program->open_regis_panitia);
                                $closeRegisPanitia = \Carbon\Carbon::parse($program->close_regis_panitia);
                                $isPanitiaRegisOpen = $now->between($openRegisPanitia, $closeRegisPanitia->endOfDay());

                                $openRegisPeserta = \Carbon\Carbon::parse($program->open_regis_peserta);
                                $closeRegisPeserta = \Carbon\Carbon::parse($program->close_regis_peserta);
                                $isPesertaRegisOpen = $now->between($openRegisPeserta, $closeRegisPeserta->endOfDay());
                            @endphp

                            <div class="space-y-2">
                                <h3 class="font-medium text-gray-600 dark:text-white">Pendaftaran Panitia</h3>

                                @if ($isPanitiaRegisOpen)
                                    <a href="{{ $program->gform_panitia }}" target="_blank"
                                        class="block w-full py-3 px-4 bg-primary-green-base hover:bg-primary-green-dark text-white font-medium rounded-lg text-center transition-colors shadow-md">
                                        Daftar Sebagai Panitia
                                    </a>
                                    <p class="text-sm text-gray-600 dark:text-white mt-1">
                                        Pendaftaran dibuka sampai {{ $closeRegisPanitia->translatedFormat('d F Y') }}
                                    </p>
                                @elseif($now->lt($openRegisPanitia))
                                    <button disabled
                                        class="block w-full py-3 px-4 bg-gray-400 text-white font-medium rounded-lg text-center cursor-not-allowed">
                                        Pendaftaran Belum Dibuka
                                    </button>
                                    <p class="text-sm text-gray-600 dark:text-white mt-1">
                                        Dibuka pada {{ $openRegisPanitia->translatedFormat('d F Y') }}
                                    </p>
                                @else
                                    <button disabled
                                        class="block w-full py-3 px-4 bg-gray-400 text-white font-medium rounded-lg text-center cursor-not-allowed">
                                        Pendaftaran Ditutup
                                    </button>
                                    <p class="text-sm text-gray-600 dark:text-white mt-1">
                                        Ditutup sejak {{ $closeRegisPanitia->translatedFormat('d F Y') }}
                                    </p>
                                @endif
                            </div>

                            <!-- Participant Registration Button -->
                            <div class="space-y-2 pt-2 border-t border-gray-200 dark:border-gray-700">
                                <h3 class="font-medium text-gray-600 dark:text-white">Pendaftaran Peserta</h3>

                                @if ($isPesertaRegisOpen)
                                    <a href="{{ $program->gform_peserta }}" target="_blank"
                                        class="block w-full py-3 px-4 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg text-center transition-colors shadow-md">
                                        Daftar Sebagai Peserta
                                    </a>
                                    <p class="text-sm text-gray-600 dark:text-white mt-1">
                                        Pendaftaran dibuka sampai {{ $closeRegisPeserta->translatedFormat('d F Y') }}
                                    </p>
                                @elseif($now->lt($openRegisPeserta))
                                    <button disabled
                                        class="block w-full py-3 px-4 bg-gray-400 text-white font-medium rounded-lg text-center cursor-not-allowed">
                                        Pendaftaran Belum Dibuka
                                    </button>
                                    <p class="text-sm text-gray-600 dark:text-white mt-1">
                                        Dibuka pada {{ $openRegisPeserta->translatedFormat('d F Y') }}
                                    </p>
                                @else
                                    <button disabled
                                        class="block w-full py-3 px-4 bg-gray-400 text-white font-medium rounded-lg text-center cursor-not-allowed">
                                        Pendaftaran Ditutup
                                    </button>
                                    <p class="text-sm text-gray-600 dark:text-white mt-1">
                                        Ditutup sejak {{ $closeRegisPeserta->translatedFormat('d F Y') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Fungsi untuk mendapatkan nama lokasi berdasarkan latitude dan longitude
        function getLocationName(lat, long) {
            const url =
                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${long}&zoom=18&addressdetails=1`;

            return fetch(url, {
                    headers: {
                        'User-Agent': 'YourAppName/1.0' // Penting untuk menambahkan User-Agent
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const locationName = data.name || data.display_name || 'Lokasi tidak ditemukan';
                    return {
                        name: locationName,
                        address: data.address || {}
                    };
                })
                .catch(error => {
                    console.error('Error fetching location data:', error);
                    return {
                        name: 'Lokasi tidak ditemukan',
                        address: {}
                    };
                });
        }

        // Fungsi untuk memformat alamat dari data response
        function formatAddress(addressData) {
            const parts = [];

            if (addressData.road) parts.push(addressData.road);
            if (addressData.village) parts.push(addressData.village);
            if (addressData.city || addressData.town) parts.push(addressData.city || addressData.town);
            if (addressData.state) parts.push(addressData.state);
            if (addressData.postcode) parts.push(addressData.postcode);

            return parts.join(', ');
        }

        // Gallery Modal Functionality with jQuery
        $(document).ready(function() {
            let currentImageIndex = 0;
            const documentations = Object.values(@json($documentations ?? []));

            // Open gallery modal when a thumbnail is clicked
            function openGalleryModal(index) {
                currentImageIndex = index;
                updateModalImage();
                $('#galleryModal').removeClass('hidden');
                $('body').addClass('overflow-hidden');
            }

            // Close gallery modal
            function closeGalleryModal() {
                $('#galleryModal').addClass('hidden');
                $('body').removeClass('overflow-hidden');
            }

            // Navigate through gallery images
            function changeGalleryImage(step) {
                currentImageIndex = (currentImageIndex + step + documentations.length) % documentations.length;
                updateModalImage();
            }

            // Update the modal image and counter
            function updateModalImage() {
                $('#modalImage').attr('src', documentations[currentImageIndex].url);
                $('#imageCounter').text(`${currentImageIndex + 1} / ${documentations.length}`);
            }

            // Make functions globally accessible
            window.openGalleryModal = openGalleryModal;
            window.closeGalleryModal = closeGalleryModal;
            window.changeGalleryImage = changeGalleryImage;

            // Close modal when clicking outside the image
            $('#galleryModal').on('click', function(event) {
                if ($(event.target).is('#galleryModal')) {
                    closeGalleryModal();
                }
            });

            // Keyboard navigation
            $(document).on('keydown', function(event) {
                if ($('#galleryModal').hasClass('hidden')) return;

                if (event.key === 'Escape') {
                    closeGalleryModal();
                } else if (event.key === 'ArrowLeft') {
                    changeGalleryImage(-1);
                } else if (event.key === 'ArrowRight') {
                    changeGalleryImage(1);
                }
            });
        });

        // Jalankan hanya jika tidak ada data program
        document.addEventListener('DOMContentLoaded', function() {
            @if (!isset($program->location_name) || !isset($program->location_address))
                const latitude = -8.1822364782803;
                const longitude = 113.66155261659;

                getLocationName(latitude, longitude)
                    .then(locationData => {
                        // Hanya update elemen jika data program tidak tersedia
                        @if (!isset($program->location_name))
                            document.getElementById('location-name').textContent = locationData.name;
                        @endif

                        @if (!isset($program->location_address))
                            document.getElementById('location-address').textContent = formatAddress(locationData
                                .address);
                        @endif
                    });
            @endif
        });
    </script>
@endpush
