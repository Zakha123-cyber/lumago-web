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

        <!-- Back Button -->
        <div class="fixed z-50 top-20 left-6">
            <a href="{{ url()->previous() }}"
                class="flex items-center px-4 py-2 text-white transition-all duration-300 rounded-full bg-white/10 backdrop-blur-md hover:bg-white/20">
                <i class="mr-2 fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 py-24">
            <div class="container max-w-4xl px-6 mx-auto">
                <!-- Booking Form Card -->
                <div class="p-8 transition-all duration-300 content-card rounded-2xl fade-in hover:bg-white/10">
                    <h1 class="mb-8 text-3xl font-bold text-center text-white">Booking Wisata</h1>

                    <form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="wisata_id" value="{{ $wisata->id }}">

                        <!-- Wisata Info -->
                        <div class="p-6 mb-6 rounded-xl bg-white/5">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('storage/images/' . $wisata->gambarWisata->first()->path_gambar) }}"
                                    alt="{{ $wisata->nama }}" class="object-cover w-24 h-24 rounded-lg">
                                <div>
                                    <h2 class="text-xl font-bold text-white">{{ $wisata->nama }}</h2>
                                    <p class="text-gray-400">
                                        <i class="mr-2 fas fa-map-marker-alt"></i>
                                        {{ $wisata->lokasi }}
                                    </p>
                                    <p class="mt-2 text-lg font-semibold text-green-400">
                                        Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }} / tiket
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Details -->
                        <div class="grid gap-6 md:grid-cols-2">
                            <!-- Tanggal Booking -->
                            <div>
                                <label for="tanggal_booking" class="block mb-2 text-sm font-medium text-gray-300">
                                    Tanggal Booking
                                </label>
                                <input type="date" id="tanggal_booking" name="tanggal_booking"
                                    class="w-full px-4 py-3 text-white rounded-lg bg-white/10 border-white/10 focus:ring-2 focus:ring-green-500/50 focus:border-green-500"
                                    min="{{ date('Y-m-d') }}" required>
                            </div>

                            <!-- Jumlah Tiket -->
                            <div>
                                <label for="jumlah_tiket" class="block mb-2 text-sm font-medium text-gray-300">
                                    Jumlah Tiket
                                </label>
                                <div class="flex items-center">
                                    <button type="button" onclick="decrementTicket()"
                                        class="px-4 py-3 text-white transition-all duration-300 rounded-l-lg bg-white/10 hover:bg-white/20">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" id="jumlah_tiket" name="jumlah_tiket"
                                        class="w-full px-4 py-3 text-center text-white bg-white/10 border-x border-white/10"
                                        value="1" min="1" required>
                                    <button type="button" onclick="incrementTicket()"
                                        class="px-4 py-3 text-white transition-all duration-300 rounded-r-lg bg-white/10 hover:bg-white/20">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Total Payment -->
                        <div class="p-6 rounded-xl bg-white/5">
                            <div class="flex items-center justify-between">
                                <span class="text-lg text-white">Total Pembayaran:</span>
                                <span class="text-2xl font-bold text-green-400" id="totalPayment">
                                    Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-8 py-3 text-white transition-all duration-300 bg-green-500 rounded-lg hover:bg-green-600 focus:ring-4 focus:ring-green-500/50">
                                <i class="mr-2 fas fa-ticket"></i>
                                Booking Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            function incrementTicket() {
                const input = document.getElementById('jumlah_tiket');
                input.value = parseInt(input.value) + 1;
                updateTotal();
            }

            function decrementTicket() {
                const input = document.getElementById('jumlah_tiket');
                if (parseInt(input.value) > 1) {
                    input.value = parseInt(input.value) - 1;
                    updateTotal();
                }
            }

            function updateTotal() {
                const ticketPrice = {{ $wisata->harga_tiket }};
                const quantity = document.getElementById('jumlah_tiket').value;
                const total = ticketPrice * quantity;
                document.getElementById('totalPayment').textContent =
                    'Rp ' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Update total when typing in the input
            document.getElementById('jumlah_tiket').addEventListener('input', updateTotal);
        </script>
    @endpush

    @push('styles')
        <style>
            /* Remove number input arrows */
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            input[type=number] {
                -moz-appearance: textfield;
            }

            /* Background Elements */
            .floating-element {
                position: absolute;
                border-radius: 50%;
                filter: blur(80px);
                opacity: 0.15;
                pointer-events: none;
            }

            .float-1 {
                width: 300px;
                height: 300px;
                background: #10b981;
                left: 10%;
                top: 20%;
                animation: float1 15s ease-in-out infinite;
            }

            @keyframes float1 {

                0%,
                100% {
                    transform: translate(0, 0);
                }

                50% {
                    transform: translate(-30px, 30px);
                }
            }
        </style>
    @endpush
@endsection
