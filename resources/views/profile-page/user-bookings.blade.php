@extends('layouts.app')

@section('content')
    <div class="min-h-screen overflow-hidden bg-gray-900">
        <!-- Enhanced Background Effects -->
        <div class="fixed inset-0 z-0 overflow-hidden">
            <div
                class="absolute inset-0 bg-gradient-radial from-indigo-900/30 via-transparent to-transparent animate-pulse-slow">
            </div>
            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
            <div class="absolute inset-0 bg-dot-pattern opacity-5"></div>
            <div
                class="absolute top-0 left-0 w-64 h-64 bg-purple-500 rounded-full mix-blend-overlay filter blur-3xl opacity-10 animate-float">
            </div>
            <div
                class="absolute bottom-0 right-0 w-64 h-64 bg-blue-500 rounded-full mix-blend-overlay filter blur-3xl opacity-10 animate-float-delay">
            </div>
        </div>

        <div class="relative z-10 py-16 md:py-24">
            <div class="container px-4 mx-auto sm:px-6 lg:px-8">
                <!-- Animated Header Section -->
                <div class="mb-12 text-center md:text-left">
                    <div class="overflow-hidden">
                        <h1 class="text-4xl font-bold text-white md:text-5xl animate-slide-in">
                            <span
                                class="inline-block text-transparent bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text">
                                Riwayat Booking
                            </span>
                        </h1>
                    </div>
                    <div class="overflow-hidden">
                        <p class="mt-3 text-lg text-gray-400 animate-slide-in-delay">
                            Daftar semua transaksi booking tiket wisata Anda
                        </p>
                    </div>
                </div>

                <!-- Booking List with Staggered Animations -->
                <div class="grid gap-6">
                    @forelse($bookings as $index => $booking)
                        <div class="p-6 transition-all duration-500 border shadow-lg bg-white/5 rounded-xl hover:bg-white/10 backdrop-blur-sm border-white/5 hover:border-white/10 animate-fade-in-up"
                            style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                                <!-- Left Side: Wisata Info -->
                                <div class="flex gap-4">
                                    <div class="w-24 h-24 overflow-hidden rounded-lg shadow-lg shrink-0 group">
                                        <img src="{{ $booking->wisata->gambarWisata->first() ? asset('storage/images/' . $booking->wisata->gambarWisata->first()->path_gambar) : asset('images/default-wisata.jpg') }}"
                                            alt="{{ $booking->wisata->nama }}"
                                            class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold text-white transition-colors hover:text-blue-300">
                                            {{ $booking->wisata->nama }}
                                        </h3>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            <p class="flex items-center text-sm text-gray-400">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}
                                            </p>
                                            <p class="flex items-center text-sm text-gray-400">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                                    </path>
                                                </svg>
                                                {{ $booking->jumlah_tiket }} Tiket
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Side: Status & Actions -->
                                <div class="flex flex-col items-end gap-3">
                                    <div class="text-right">
                                        <p
                                            class="text-2xl font-bold text-transparent bg-gradient-to-r from-green-400 to-blue-400 bg-clip-text">
                                            Rp {{ number_format($booking->total_bayar, 0, ',', '.') }}
                                        </p>
                                        <div class="flex flex-wrap justify-end gap-2 mt-3">
                                            @if ($booking->status_pembayaran === 'pending')
                                                <span
                                                    class="px-3 py-1 text-sm font-medium text-yellow-400 rounded-full bg-yellow-400/10 animate-pulse">
                                                    <svg class="inline w-4 h-4 mr-1 -mt-1" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Menunggu Pembayaran
                                                </span>
                                            @else
                                                <span
                                                    class="px-3 py-1 text-sm font-medium text-green-400 rounded-full bg-green-400/10">
                                                    <svg class="inline w-4 h-4 mr-1 -mt-1" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Pembayaran Selesai
                                                </span>
                                            @endif

                                            @if ($booking->status_tiket === 'belum_digunakan')
                                                <span
                                                    class="px-3 py-1 text-sm font-medium text-blue-400 rounded-full bg-blue-400/10">
                                                    <svg class="inline w-4 h-4 mr-1 -mt-1" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                                        </path>
                                                    </svg>
                                                    Tiket Belum Digunakan
                                                </span>
                                            @else
                                                <span
                                                    class="px-3 py-1 text-sm font-medium text-gray-400 rounded-full bg-gray-400/10">
                                                    <svg class="inline w-4 h-4 mr-1 -mt-1" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Tiket Sudah Digunakan
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex gap-2">
                                        @if ($booking->status_pembayaran === 'pending')
                                            <button
                                                onclick="window.location.href='{{ route('booking.payment', $booking->id) }}'"
                                                class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 bg-gradient-to-r from-green-500 to-green-600 rounded-lg hover:from-green-600 hover:to-green-700 shadow hover:shadow-lg transform hover:-translate-y-0.5 flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                                    </path>
                                                </svg>
                                                Bayar Sekarang
                                            </button>
                                        @endif
                                        @if ($booking->status_pembayaran === 'selesai' && $booking->status_tiket === 'belum_digunakan')
                                            <button
                                                onclick="window.location.href='{{ route('booking.show-ticket', $booking->id) }}'"
                                                class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 shadow hover:shadow-lg transform hover:-translate-y-0.5 flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                                    </path>
                                                </svg>
                                                Lihat Tiket
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="max-w-md p-8 mx-auto text-center border shadow-lg bg-white/5 rounded-xl backdrop-blur-sm border-white/5 animate-fade-in">
                            <div class="flex flex-col items-center justify-center">
                                <div class="relative mb-6">
                                    <i class="text-6xl text-blue-400 fas fa-ticket-alt"></i>
                                    <div class="absolute bg-blue-400 rounded-full -inset-2 opacity-20 blur-md"></div>
                                </div>
                                <h3 class="mb-2 text-xl font-medium text-white">Belum ada riwayat booking</h3>
                                <p class="mb-6 text-gray-400">Mulai jelajahi wisata menarik dan buat booking pertama Anda
                                </p>
                                <a href="{{ route('wisata.index') }}"
                                    class="px-6 py-3 font-medium text-white transition-all duration-300 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg hover:from-blue-600 hover:to-purple-600 shadow hover:shadow-lg transform hover:-translate-y-0.5">
                                    Jelajahi Wisata
                                </a>
                            </div>
                        </div>
                    @endforelse

                    <!-- Pagination with Animation -->
                    <div class="mt-8 animate-fade-in">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .bg-gradient-radial {
            background: radial-gradient(circle at center, var(--tw-gradient-from), var(--tw-gradient-via), var(--tw-gradient-to));
        }

        .bg-grid-pattern {
            background-size: 30px 30px;
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        }

        .bg-dot-pattern {
            background-size: 20px 20px;
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        }

        /* Animations */
        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 0.8;
            }

            50% {
                opacity: 0.5;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) translateX(0);
            }

            50% {
                transform: translateY(-20px) translateX(10px);
            }
        }

        @keyframes float-delay {

            0%,
            100% {
                transform: translateY(0) translateX(0);
            }

            50% {
                transform: translateY(20px) translateX(-10px);
            }
        }

        @keyframes slide-in {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fade-in-up {
            from {
                transform: translateY(10px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-pulse-slow {
            animation: pulse-slow 6s infinite;
        }

        .animate-float {
            animation: float 8s ease-in-out infinite;
        }

        .animate-float-delay {
            animation: float-delay 10s ease-in-out infinite;
        }

        .animate-slide-in {
            animation: slide-in 0.6s ease-out forwards;
        }

        .animate-slide-in-delay {
            animation: slide-in 0.6s ease-out 0.2s forwards;
            opacity: 0;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
            opacity: 0;
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
            opacity: 0;
        }
    </style>
@endpush

@push('script')
    <script>
        // Add intersection observer for scroll animations
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate-fade-in-up, .animate-fade-in');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1
            });

            animateElements.forEach(el => observer.observe(el));
        });
    </script>
@endpush
