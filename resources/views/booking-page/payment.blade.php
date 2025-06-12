@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-900">
        <!-- Background Effects -->
        <div class="fixed inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-radial"></div>
            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
        </div>

        <div class="relative z-10 py-24">
            <div class="container max-w-2xl px-6 mx-auto">
                <div class="p-8 text-center transition-all duration-300 content-card rounded-2xl fade-in hover:bg-white/10">
                    <h1 class="mb-4 text-3xl font-bold text-white">Pembayaran</h1>
                    <div class="p-6 mb-6 text-left rounded-xl bg-white/5">
                        <div class="mb-4">
                            <h2 class="text-xl font-bold text-white">{{ $transaksi->wisata->nama }}</h2>
                            <p class="text-gray-400">{{ $transaksi->jumlah_tiket }} Tiket</p>
                            <p class="mt-2 text-2xl font-bold text-green-400">
                                Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <button id="pay-button"
                        class="px-8 py-3 text-white transition-all duration-300 bg-green-500 rounded-lg hover:bg-green-600">
                        <i class="mr-2 fas fa-credit-card"></i>
                        Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
        <script>
            // Langsung tampilkan Snap saat halaman dimuat
            window.onload = function() {
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        window.location.href = "{{ route('booking.success', $transaksi->id) }}";
                    },
                    onPending: function(result) {
                        window.location.href = "{{ route('booking.success', $transaksi->id) }}";
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal!');
                        window.location.href = "{{ route('booking.create', $transaksi->wisata_id) }}";
                    },
                    onClose: function() {
                        window.location.href = "{{ route('booking.create', $transaksi->wisata_id) }}";
                    }
                });
            };
        </script>
    @endpush
@endsection
