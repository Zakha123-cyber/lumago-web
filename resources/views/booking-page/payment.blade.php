@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-900">
        <!-- Background Effects -->
        <div class="fixed inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-radial from-green-900/30 via-transparent to-transparent"></div>
            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
        </div>

        <div class="relative z-10 py-24">
            <div class="container max-w-2xl px-6 mx-auto">
                <div
                    class="p-8 text-center transition-all duration-300 border content-card rounded-2xl fade-in hover:bg-white/10 border-white/10 bg-white/5">
                    <h1 class="mb-4 text-3xl font-bold text-white">Pembayaran</h1>

                    <!-- Transaction Details -->
                    <div class="p-6 mb-6 text-left rounded-xl bg-white/5">
                        <h2 class="mb-4 text-xl font-semibold text-white">{{ $transaksi->wisata->nama }}</h2>
                        <div class="space-y-2">
                            <p class="text-gray-400">
                                <span class="inline-block w-32">Tanggal:</span>
                                {{ \Carbon\Carbon::parse($transaksi->tanggal_booking)->format('d F Y') }}
                            </p>
                            <p class="text-gray-400">
                                <span class="inline-block w-32">Jumlah Tiket:</span>
                                {{ $transaksi->jumlah_tiket }}
                            </p>
                            <p class="mt-4 text-2xl font-bold text-green-400">
                                Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    <button type="button" id="pay-button"
                        class="px-8 py-3 text-white transition-all duration-300 bg-green-500 rounded-lg hover:bg-green-600">
                        <i class="mr-2 fas fa-credit-card"></i>
                        Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
        </script>
        <script>
            // Show Snap payment form when page loads
            window.onload = function() {
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        window.location.href = "{{ route('booking.success', $transaksi->id) }}";
                    },
                    onPending: function(result) {
                        window.location.href = "{{ route('booking.success', $transaksi->id) }}";
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal atau dibatalkan.');
                        window.location.href = "{{ route('profile.bookings') }}";
                    },
                    onClose: function() {
                        window.location.href = "{{ route('profile.bookings') }}";
                    }
                });
            };

            // Also handle button click (as backup)
            document.getElementById('pay-button').onclick = function() {
                snap.pay('{{ $snapToken }}');
            };
        </script>
    @endpush
@endsection
