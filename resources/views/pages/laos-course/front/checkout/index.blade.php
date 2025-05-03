@extends('layouts.laos-course.front')

@section('content')
    <main class="pt-32 pb-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Checkout Card -->
            <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-lg border border-gray-200/50 dark:border-gray-700/50 rounded-2xl overflow-hidden transition duration-300 ease-in-out transform hover:scale-[1.01] shadow-xl"
                data-aos="fade-up">
                <div class="p-6 md:p-8">
                    <h1
                        class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-500 to-green-600 mb-6">
                        Checkout Kursus</h1>

                    <!-- Course Being Purchased Section -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Detail Kursus</h2>
                        <div class="bg-gray-50 dark:bg-gray-700/30 rounded-xl overflow-hidden">
                            <div class="flex flex-col md:flex-row">
                                <div class="md:w-1/3">
                                    <img src="{{ $course->getFirstMediaUrl('kursus-thumbnail') }}"
                                        alt="{{ $course->judul }}" class="w-full h-full object-cover">
                                </div>
                                <div class="p-4 md:p-5 md:w-2/3">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                                {{ $course->judul }}</h3>
                                            <div class="flex items-center mb-3">
                                                <span
                                                    class="bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-400 text-xs font-medium px-2.5 py-0.5 rounded-full mr-2">
                                                    Full Access
                                                </span>
                                                <div class="flex items-center text-yellow-400">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>
                                                    <span class="ml-1 text-sm text-gray-600 dark:text-gray-400">
                                                        {{ number_format($course->reviews_avg, 1) }}</span>
                                                    </span>
                                                    <span class="mx-1.5 text-gray-400">•</span>
                                                    <span
                                                        class="text-sm text-gray-600 dark:text-gray-400">{{ $course->students_count }}
                                                        students</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mb-3">
                                            <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ $course->materi_count }} Materi</span>
                                            <span class="mx-2">•</span>
                                            <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                                </path>
                                            </svg>
                                            <span>{{ $course->bab_count }} Bab</span>
                                            <span class="mx-2">•</span>

                                            <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>Materi up-to-date</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                        </svg>

                                        <div class="ml-2">
                                            <span
                                                class="text-sm font-medium text-gray-900 dark:text-white">{{ $course->mentors_count }}
                                                Mentor</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Info Section -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Detail Student</h2>
                        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/30 rounded-xl">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&color=7F9CF5&background=EBF4FF"
                                    alt="User Avatar"
                                    class="w-16 h-16 rounded-full mr-4 border-3 border-green-500 shadow-md">
                                <div>
                                    <h3 class="font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400">
                                        {{ Auth::user()->custom_fields['job'] ?? 'Software Developer' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Promo Code Section -->
                    @if ($course->tipe->value === 'premium')
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Kode Promo</h2>
                            <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-xl">
                                @if ($course->flashSale)
                                    {{-- tulisan diskon tidak bisa diterapkan ke kelas yang flash sale --}}
                                    <div
                                        class="flex justify-center items-center text-sm text-gray-600 dark:text-gray-400 mb-3">
                                        <svg class="w-4 h-4 mr-1 text-red-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span>Kode promo tidak dapat diterapkan pada kelas flash sale</span>
                                    </div>
                                @else
                                    <div class="flex flex-col sm:flex-row gap-3">
                                        <input type="text" id="promoCode" placeholder="Masukkan kode promo"
                                            name="kode"
                                            class="flex-1 py-3 px-4 border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:border-transparent rounded-xl bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200">
                                        <div class="flex gap-2">
                                            <button id="applyPromo" onclick="applyDiskon()"
                                                class="py-3 px-6 bg-green-500 hover:bg-green-600 text-white rounded-xl font-medium shadow-sm hover:-translate-y-0.5 transition duration-300 flex items-center justify-center gap-2">
                                                <span id="buttonText">Terapkan</span>
                                                <div id="loadingSpinner"
                                                    class="w-5 h-5 rounded-full animate-spin border-2 border-solid border-white border-t-transparent hidden">
                                                </div>
                                            </button>
                                            <button id="resetPromo" onclick="resetDiskon()"
                                                class="py-3 px-6 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors font-medium shadow-sm transform hover:-translate-y-0.5 transition duration-300">
                                                Reset
                                            </button>
                                        </div>
                                    </div>
                                    <div id="promoMessage" class="mt-3 text-sm hidden"></div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Transaction Details -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Detail Transaksi</h2>
                        <div class="space-y-4 bg-gray-50 dark:bg-gray-700/30 p-4 rounded-xl">
                            <div
                                class="flex justify-between items-center p-2 rounded-lg transition-colors duration-200 hover:bg-green-50 dark:hover:bg-green-900/10">
                                <div class="flex items-center">
                                    <span class="bg-green-100 dark:bg-green-900/20 rounded-full p-2 mr-3 inline-flex">
                                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </span>
                                    <span class="text-gray-700 dark:text-gray-300">Harga Kursus</span>
                                    @if ($course->flashSale)
                                        <span
                                            class="border-2 border-red-500 text-red-500 rounded-md p-1 ml-2 text-xs md:text-md transition-opacity duration-300"
                                            style="animation: blink 1.5s ease-in-out infinite">Flash
                                            Sale</span>
                                    @endif
                                </div>
                                <div>
                                    @if ($course->flashSale)
                                        <span id="originalPrice"
                                            class="font-medium line-through text-red-500 transition-opacity duration-300"
                                            style="animation: blink 1.5s ease-in-out infinite">
                                            {{ 'Rp' . number_format($course->harga, 0, ',', '.') }}
                                        </span>
                                        <span class="font-medium text-green-500">
                                            {{ 'Rp' . number_format($course->harga * (1 - $course->flashSale->persentase / 100), 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span id="originalPrice" class="font-medium text-gray-900 dark:text-white">
                                            {{ 'Rp' . number_format($course->harga, 0, ',', '.') }}
                                        </span>
                                    @endif
                                    <span id="discountedPrice"
                                        class="font-medium text-green-600 dark:text-green-400 hidden"></span>
                                    <span id="strikedPrice"
                                        class="font-medium text-gray-500 dark:text-gray-400 line-through ml-2 hidden"></span>
                                </div>
                            </div>

                            <div id="discountRow"
                                class="flex justify-between items-center p-2 rounded-lg transition-colors duration-200 hover:bg-green-50 dark:hover:bg-green-900/10 hidden">
                                <div class="flex items-center">
                                    <span class="bg-red-100 dark:bg-red-900/20 rounded-full p-2 mr-3 inline-flex">
                                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                    <span class="text-gray-700 dark:text-gray-300">Diskon</span>
                                </div>
                                <span id="discountAmount" class="font-medium text-red-600 dark:text-red-400">-Rp
                                    0</span>
                            </div>

                            <div
                                class="flex justify-between items-center p-2 rounded-lg transition-colors duration-200 hover:bg-green-50 dark:hover:bg-green-900/10">
                                <div class="flex items-center">
                                    <span class="bg-green-100 dark:bg-green-900/20 rounded-full p-2 mr-3 inline-flex">
                                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                                        </svg>
                                    </span>
                                    <span class="text-gray-700 dark:text-gray-300">Service Fee</span>
                                </div>
                                <span id="taxAmount" class="font-medium text-gray-900 dark:text-white">
                                    Rp 5.000
                                </span>
                            </div>

                            <div
                                class="pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center p-2 rounded-lg transition-colors duration-200 hover:bg-green-50 dark:hover:bg-green-900/10">
                                <div class="flex items-center">
                                    <span class="bg-green-100 dark:bg-green-900/20 rounded-full p-2 mr-3 inline-flex">
                                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </span>
                                    <span class="text-lg font-semibold text-gray-900 dark:text-white">Grand Total</span>
                                </div>
                                <span id="grandTotal" class="text-xl font-bold text-green-600 dark:text-green-500">
                                    {{ $course->flashSale ? 'Rp' . number_format($course->harga * (1 - $course->flashSale->persentase / 100) + 5000, 0, ',', '.') : 'Rp' . number_format($course->harga + 5000, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#"
                            class="text-center py-3 px-6 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors font-medium sm:w-1/3 shadow-sm transform hover:-translate-y-0.5 transition duration-300">
                            Batal
                        </a>
                        <button onclick="beli()" id="payButton"
                            class="py-3 px-6 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl transition-colors font-medium sm:w-2/3 flex items-center justify-center shadow-md transform hover:-translate-y-0.5 transition duration-300 hover:shadow-lg hover:shadow-green-500/20">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Daftar Sekarang
                            <div id="loadingSpinnerPay"
                                class="ml-1 w-5 h-5 rounded-full animate-spin border-2 border-solid border-white border-t-transparent hidden">
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{-- @Toastr() --}}
@endsection
@push('scripts')
    <!-- Ensure jQuery is included before this script -->
    <script src="{{ env('APP_ENV') === 'local' ? env('MIDTRANS_SANDBOX_URL') : env('MIDTRANS_PRODUCTION_URL') }}"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        // Original price (assumed value)
        const originalPrice = {{ $course->harga }}; // Course price from blade
        const taxAmount = 5000; // Fee Payment Gateway
        let grandTotal = originalPrice + taxAmount;

        // Helper function to format currency
        function formatCurrency(amount) {
            return 'Rp' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function resetDiskon() {
            $('#applyPromo').show();
            $('#promoCode').attr('readonly', false);
            $('#promoCode').val('');
            $('#originalPrice').removeClass('hidden');
            $('#discountedPrice').addClass('hidden');
            $('#strikedPrice').addClass('hidden');
            $('#discountRow').addClass('hidden');
            $('#grandTotal').text(formatCurrency(originalPrice + taxAmount));
            // $('#promoMessage').addClass('hidden');
        }

        function applyDiskon() {
            let diskon = $('input[name="kode"]').val() || null;
            console.log(diskon);

            // jika diskon kosong
            if (diskon === null) {
                toastr.error('Diskon tidak boleh kosong', 'Error');
                return;
            }

            // jika diskon diinput di course dengan tipe free
            if ('{{ $course->tipe->value }}' === 'free') {
                toastr.error('Diskon tidak bisa diterapkan pada kursus gratis', 'Error');
                return;
            }

            $.ajax({
                url: `{{ route('course.checkout.diskon-check') }}?kode=${diskon}`,
                type: 'GET',
                beforeSend: function() {
                    $('#loadingSpinner').removeClass('hidden');
                    $('button#applyPromo').attr('disabled', true);
                },
                success: function(response, textStatus, xhr) {
                    $('#loadingSpinner').addClass('hidden');
                    $('button#applyPromo').attr('disabled', false);
                    if (xhr.status === 200) {
                        toastr.success(response.message, 'Success');
                        const discountAmount = Math.floor(originalPrice * response.data.persentase / 100);
                        const discountedPrice = originalPrice - discountAmount;
                        const newGrandTotal = discountedPrice + taxAmount;

                        // Update UI with jQuery
                        $('#applyPromo').hide();
                        $('#promoCode').attr('readonly', true);
                        $('#originalPrice').addClass('hidden');
                        $('#discountedPrice').text(formatCurrency(discountedPrice)).removeClass(
                            'hidden');
                        $('#strikedPrice').text(formatCurrency(originalPrice)).removeClass(
                            'hidden');
                        $('#discountRow').removeClass('hidden');
                        $('#discountAmount').text('-' + formatCurrency(discountAmount));
                        $('#grandTotal').text(formatCurrency(newGrandTotal));
                    } else {
                        toastr.error(response.message, 'Error');
                    }
                },
                error: function(xhr) {
                    $('#loadingSpinner').addClass('hidden');
                    $('button#applyPromo').attr('disabled', false);
                    toastr.error(xhr.responseJSON.message, 'Error');
                }
            })
        }

        function beli() {
            let diskon = $('input[name="kode"]').val() || null;
            $.ajax({
                url: `{{ route('course.checkout.beli', $course->slug) }}`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    kode: diskon,
                },
                beforeSend: function() {
                    $('#loadingSpinnerPay').removeClass('hidden');
                    $('button#payButton').attr('disabled', true);
                },
                success: function(response) {
                    $('#loadingSpinnerPay').addClass('hidden');
                    $('button#payButton').attr('disabled', false);
                    snap.pay(response.data.snap_token, {
                        // Optional
                        onSuccess: function(result) {
                            /* You may add your own js here, this is just example */
                            window.location.href = '#';
                        },
                        // Optional
                        onPending: function(result) {
                            /* You may add your own js here, this is just example */
                            window.location.href = '#';
                        },
                        // Optional
                        onError: function(result) {
                            /* You may add your own js here, this is just example */
                            window.location.href = '#';
                        }
                    });
                },
                error: function(xhr) {
                    $('#loadingSpinnerPay').addClass('hidden');
                    $('button#payButton').attr('disabled', false);
                    toastr.error(xhr.responseJSON.message, 'Error');
                }
            })
        }
    </script>
@endpush
