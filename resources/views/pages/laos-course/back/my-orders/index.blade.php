@extends('layouts.laos-course.back')
@php
    use App\Enums\LaosCourse\Transaksi\StatusEnum;
@endphp
@section('content')
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Transaksi Saya</h2>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <!-- Header Row -->
            <div
                class="hidden md:grid md:grid-cols-5 bg-gray-50 dark:bg-gray-700 py-3 px-4 border-b border-gray-200 dark:border-gray-700">
                <div class="text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Nama Course
                </div>
                <div class="text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Tipe Course
                </div>
                <div class="text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Harga
                </div>
                <div class="text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Status
                </div>
                <div class="text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider text-right">
                    Aksi
                </div>
            </div>

            <!-- Transaksi 1 -->
            @forelse ($transactions as $transaction)
                <div
                    class="grid grid-cols-1 md:grid-cols-5 items-center py-4 px-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <div class="flex items-center mb-2 md:mb-0">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-md object-cover"
                                src="{{ $transaction->kursus->getFirstMediaUrl('kursus-thumbnail') }}"
                                alt="{{ $transaction->kursus->judul }}" loading="lazy" />
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $transaction->kursus->judul }}
                            </div>
                        </div>
                        <div class="md:hidden ml-auto flex items-center">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                {{ $transaction->kursus->kategori->getLabel() }}
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-between md:block">
                        <div class="text-xs md:hidden font-medium text-gray-500 dark:text-gray-400">Tipe:</div>
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                            {{ $transaction->kursus->tipe->getLabel() }}
                        </span>
                    </div>
                    <div class="flex justify-between md:block py-2 md:py-0">
                        <div class="text-xs md:hidden font-medium text-gray-500 dark:text-gray-400">Harga:</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ 'Rp' . number_format($transaction->total_harga, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $transaction->status === StatusEnum::PENDING ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100' : '' }}
                            {{ $transaction->status === StatusEnum::SUCCESS ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : '' }}
                            {{ $transaction->status === StatusEnum::FAILED ? 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' : '' }}   
                            ">
                            {{ $transaction->status->getLabel() }}
                        </span>
                    </div>
                    <div class="flex justify-end mt-2 md:mt-0">
                        @if ($transaction->status === StatusEnum::SUCCESS)
                            <a href="#"
                                class="font-semibold border-2 border-blue-600 text-blue-600 dark:text-blue-400 hover:text-white hover:bg-blue-500 dark:bg-blue-900/30 px-3 py-1 rounded-md text-sm mr-2 transition-all duration-300">
                                Lihat Kursus
                            </a>
                        @elseif($transaction->status === StatusEnum::PENDING || $transaction->status === StatusEnum::FAILED)
                            <button
                                class="font-semibold border-2 border-yellow-600 text-yellow-600 dark:text-yellow-400 hover:text-white hover:bg-yellow-500 dark:bg-yellow-900/30 px-3 py-1 rounded-md text-sm mr-2 transition-all duration-300">
                                Bayar Sekarang
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="py-4 px-4 text-center text-gray-500 dark:text-gray-400">
                    Belum ada transaksi
                </div>
            @endforelse
        </div>
    </div>
    {{-- Paginatiom --}}
    <div class="mt-6">
        {{ $transactions->links() }}
    </div>
@endsection
