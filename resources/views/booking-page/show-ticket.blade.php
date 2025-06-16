@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-900">
        <!-- Background Effects -->
        <div class="fixed inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-radial from-green-900/30 via-transparent to-transparent"></div>
            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
            <div
                class="absolute top-0 left-0 w-64 h-64 bg-green-500 rounded-full mix-blend-overlay filter blur-3xl opacity-10 animate-float">
            </div>
            <div
                class="absolute bottom-0 right-0 w-64 h-64 rounded-full bg-emerald-500 mix-blend-overlay filter blur-3xl opacity-10 animate-float-delay">
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 py-24">
            <div class="container max-w-3xl px-6 mx-auto">
                <!-- E-Ticket Card -->
                <div
                    class="relative p-8 overflow-hidden transition-all duration-300 border shadow-xl content-card rounded-2xl border-white/10 bg-white/5 backdrop-blur-md hover:bg-white/10">
                    <!-- Ticket Header -->
                    <div class="flex flex-col items-center mb-8 text-center">
                        <h1
                            class="mb-2 text-3xl font-bold text-transparent bg-gradient-to-r from-green-400 to-emerald-500 bg-clip-text">
                            E-Ticket LumaGO
                        </h1>
                        <p class="text-gray-400">Scan QR code saat memasuki area wisata</p>
                    </div>

                    <!-- Ticket Content -->
                    <div class="relative">
                        <!-- Ticket Details -->
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div class="p-6 rounded-xl bg-white/5">
                                <h2 class="mb-4 text-xl font-semibold text-white">Informasi Wisata</h2>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm text-gray-400">Nama Tempat</p>
                                        <p class="text-lg font-medium text-white">{{ $transaksi->wisata->nama }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-400">Tanggal Kunjungan</p>
                                        <p class="text-lg font-medium text-white">
                                            {{ \Carbon\Carbon::parse($transaksi->tanggal_booking)->format('d F Y') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-400">Jumlah Tiket</p>
                                        <p class="text-lg font-medium text-white">{{ $transaksi->jumlah_tiket }} Orang</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 rounded-xl bg-white/5">
                                <h2 class="mb-4 text-xl font-semibold text-white">Informasi Pengunjung</h2>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm text-gray-400">Nama Pemesan</p>
                                        <p class="text-lg font-medium text-white">{{ $transaksi->user->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-400">Email</p>
                                        <p class="text-lg font-medium text-white">{{ $transaksi->user->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-400">Kode Booking</p>
                                        <p class="text-lg font-medium text-white">{{ $transaksi->order_id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- QR Code Section -->
                        <div class="p-6 text-center rounded-xl bg-white/5">
                            <h2 class="mb-4 text-xl font-semibold text-white">QR Code Tiket</h2>
                            <div class="inline-block p-4 mb-4 bg-white rounded-xl">
                                <img src="{{ asset('storage/' . $transaksi->qr_code_path) }}" alt="Ticket QR Code"
                                    class="w-48 h-48 mx-auto">
                            </div>
                            <p class="text-sm text-gray-400">Tunjukkan QR code ini kepada petugas saat memasuki area wisata
                            </p>
                        </div>

                        <!-- Ticket Footer -->
                        <div class="mt-6 text-center">
                            <p class="mb-4 text-sm text-gray-400">Status Tiket:
                                <span
                                    class="px-3 py-1 ml-2 text-sm {{ $transaksi->status_tiket === 'belum_digunakan' ? 'text-blue-400 bg-blue-400/10' : 'text-gray-400 bg-gray-400/10' }} rounded-full">
                                    {{ $transaksi->status_tiket === 'belum_digunakan' ? 'Belum Digunakan' : 'Sudah Digunakan' }}
                                </span>
                            </p>

                            <!-- Action Buttons -->
                            <div class="flex flex-col gap-4 mt-8 sm:flex-row sm:justify-center">
                                <button onclick="window.print()"
                                    class="px-6 py-3 text-white transition-all duration-300 rounded-lg bg-white/10 hover:bg-white/20">
                                    <i class="mr-2 fas fa-print"></i>
                                    Cetak Tiket
                                </button>
                                <a href="{{ route('profile.bookings') }}"
                                    class="px-6 py-3 text-white transition-all duration-300 bg-green-500 rounded-lg hover:bg-green-600">
                                    <i class="mr-2 fas fa-arrow-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative Elements -->
                    <div
                        class="absolute left-0 w-4 h-4 transform -translate-x-1/2 -translate-y-1/2 bg-gray-900 rounded-full top-1/2">
                    </div>
                    <div
                        class="absolute right-0 w-4 h-4 transform translate-x-1/2 -translate-y-1/2 bg-gray-900 rounded-full top-1/2">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            @media print {
                .bg-gray-900 {
                    background: white !important;
                }

                .content-card {
                    border: 1px solid #e5e7eb !important;
                    background: white !important;
                }

                .text-white,
                .text-gray-400 {
                    color: #111827 !important;
                }

                .bg-white\/5 {
                    background: #f3f4f6 !important;
                }

                @page {
                    margin: 0;
                }

                body {
                    margin: 1.6cm;
                }
            }
        </style>
    @endpush
@endsection
