@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-900">
        <!-- Background Effects -->
        <div class="fixed inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-radial"></div>
            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
            <div class="floating-element float-1"></div>
            <div class="floating-element float-2"></div>
            <div class="floating-element float-3"></div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 py-24">
            <div class="container max-w-2xl px-6 mx-auto">
                <div class="p-8 text-center transition-all duration-300 content-card rounded-2xl fade-in hover:bg-white/10">
                    <div class="mb-6 text-green-400">
                        <i class="text-6xl fas fa-check-circle"></i>
                    </div>
                    <h1 class="mb-4 text-3xl font-bold text-white">Booking Berhasil!</h1>
                    <p class="mb-8 text-gray-400">Silakan lakukan pembayaran untuk menyelesaikan transaksi.</p>

                    <!-- Booking Details -->
                    <div class="p-6 mb-6 text-left rounded-xl bg-white/5">
                        <div class="mb-4 space-y-2">
                            <h2 class="text-xl font-semibold text-white">{{ $transaksi->wisata->nama }}</h2>
                            <p class="text-gray-400">
                                <i class="mr-2 fas fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($transaksi->tanggal_booking)->format('d M Y') }}
                            </p>
                            <p class="text-gray-400">
                                <i class="mr-2 fas fa-ticket"></i>
                                {{ $transaksi->jumlah_tiket }} Tiket
                            </p>
                        </div>

                        <div class="flex items-center justify-between py-4 border-t border-white/10">
                            <span class="text-white">Total Pembayaran:</span>
                            <span class="text-xl font-bold text-green-400">
                                Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- QR Code -->
                    <div class="p-6 mb-8 rounded-xl bg-white/5">
                        <img src="{{ asset('storage/' . $transaksi->qr_code_path) }}" alt="Booking QR Code" class="mx-auto">
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-4 md:flex-row md:justify-center">
                        <a href="{{ route('profile.bookings') }}"
                            class="px-6 py-3 text-white transition-all duration-300 rounded-lg bg-white/10 hover:bg-white/20">
                            <i class="mr-2 fas fa-list"></i>
                            Lihat Riwayat Booking
                        </a>
                        <a href="{{ route('landing.index') }}"
                            class="px-6 py-3 text-white transition-all duration-300 bg-green-500 rounded-lg hover:bg-green-600">
                            <i class="mr-2 fas fa-home"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
