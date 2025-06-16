@extends('layouts.superadmin')

@section('content')
    <div class="max-w-xl px-4 py-10 mx-auto">
        <h2 class="mb-6 text-2xl font-bold text-white">Detail Tiket</h2>

        @if (session('success'))
            <div class="p-4 mb-4 text-green-300 rounded-lg bg-green-500/20">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="p-4 mb-4 text-red-300 rounded-lg bg-red-500/20">{{ session('error') }}</div>
        @endif

        <div class="p-6 space-y-4 text-white border rounded-xl bg-gray-800/70 border-white/10">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-lg font-bold">Order ID: {{ $transaksi->order_id }}</div>
                    <div class="text-sm text-gray-400">Tanggal Booking:
                        {{ \Carbon\Carbon::parse($transaksi->tanggal_booking)->format('d M Y') }}</div>
                </div>
                <span
                    class="px-3 py-1 rounded-full text-xs font-semibold
                {{ $transaksi->status_tiket == 'sudah_digunakan' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                    {{ ucfirst(str_replace('_', ' ', $transaksi->status_tiket)) }}
                </span>
            </div>
            <div>
                <div class="font-semibold">Nama Pengunjung:</div>
                <div>{{ $transaksi->user->name }}</div>
            </div>
            <div>
                <div class="font-semibold">Wisata:</div>
                <div>{{ $transaksi->wisata->nama }}</div>
            </div>
            <div>
                <div class="font-semibold">Jumlah Tiket:</div>
                <div>{{ $transaksi->jumlah_tiket }}</div>
            </div>
            <div>
                <div class="font-semibold">Total Bayar:</div>
                <div>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</div>
            </div>
            <div>
                <div class="font-semibold">Status Pembayaran:</div>
                <div>
                    <span
                        class="px-3 py-1 rounded-full text-xs font-semibold
                    {{ $transaksi->status_pembayaran == 'selesai' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                        {{ ucfirst($transaksi->status_pembayaran) }}
                    </span>
                </div>
            </div>
            <div>
                <div class="font-semibold">QR Code:</div>
                <img src="{{ asset('storage/' . $transaksi->qr_code_path) }}" alt="QR Code"
                    class="w-32 h-32 mt-2 bg-white rounded-lg">
            </div>
            @if ($transaksi->status_tiket == 'belum_digunakan')
                <form method="POST" action="{{ route('admin-wisata.scan.verify', $transaksi->order_id) }}" class="mt-6">
                    @csrf
                    <button type="submit"
                        class="w-full px-4 py-2 font-semibold text-white transition bg-green-500 rounded-lg hover:bg-green-600">
                        Verifikasi & Tandai Sudah Digunakan
                    </button>
                </form>
            @else
                <div class="mt-6 font-semibold text-center text-green-400">
                    Tiket sudah diverifikasi & digunakan.
                </div>
            @endif
        </div>
        <div class="mt-6">
            <a href="{{ route('admin-wisata.scan.index') }}"
                class="inline-block px-4 py-2 text-white transition bg-gray-700 rounded-lg hover:bg-gray-600">
                <i class="mr-2 fa-solid fa-arrow-left"></i> Kembali ke Scan Tiket
            </a>
        </div>
    </div>
@endsection
