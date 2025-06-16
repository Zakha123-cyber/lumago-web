@extends('layouts.superadmin')

@section('content')
    <div class="flex justify-center items-center min-h-[80vh]">
        <div
            class="relative w-full max-w-md p-8 overflow-hidden border shadow-2xl bg-gradient-to-br from-gray-800 via-gray-900 to-gray-800 border-white/10 rounded-2xl">
            {{-- Garis putus-putus atas --}}
            <div class="absolute left-0 right-0 top-16 h-0.5 border-t-2 border-dashed border-gray-600"></div>
            {{-- Garis putus-putus bawah --}}
            <div class="absolute left-0 right-0 bottom-16 h-0.5 border-t-2 border-dashed border-gray-600"></div>

            {{-- Header Nota --}}
            <div class="flex flex-col items-center mb-6">
                <div class="text-2xl font-bold tracking-widest text-green-400">LumaGO</div>
                <div class="text-sm text-gray-400">Nota Tiket Pengunjung</div>
            </div>

            {{-- Info Tiket --}}
            <div class="mb-6 space-y-3">
                <div class="flex justify-between text-sm text-gray-400">
                    <span>Order ID</span>
                    <span class="font-mono text-white">{{ $transaksi->order_id }}</span>
                </div>
                <div class="flex justify-between text-sm text-gray-400">
                    <span>Tanggal Booking</span>
                    <span
                        class="text-white">{{ \Carbon\Carbon::parse($transaksi->tanggal_booking)->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between text-sm text-gray-400">
                    <span>Nama Pengunjung</span>
                    <span class="text-white">{{ $transaksi->user->name }}</span>
                </div>
                <div class="flex justify-between text-sm text-gray-400">
                    <span>Wisata</span>
                    <span class="text-white">{{ $transaksi->wisata->nama }}</span>
                </div>
                <div class="flex justify-between text-sm text-gray-400">
                    <span>Jumlah Tiket</span>
                    <span class="text-white">{{ $transaksi->jumlah_tiket }}</span>
                </div>
                <div class="flex justify-between text-sm text-gray-400">
                    <span>Total Bayar</span>
                    <span class="font-semibold text-white">Rp
                        {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-gray-400">
                    <span>Status Pembayaran</span>
                    <span>
                        <span
                            class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $transaksi->status_pembayaran == 'selesai' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                            {{ ucfirst($transaksi->status_pembayaran) }}
                        </span>
                    </span>
                </div>
                <div class="flex justify-between text-sm text-gray-400">
                    <span>Status Tiket</span>
                    <span>
                        <span
                            class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $transaksi->status_tiket == 'sudah_digunakan' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                            {{ ucfirst(str_replace('_', ' ', $transaksi->status_tiket)) }}
                        </span>
                    </span>
                </div>
            </div>

            {{-- QR Code --}}
            <div class="flex flex-col items-center mb-6">
                <div class="p-2 bg-white rounded-lg shadow">
                    <img src="{{ asset('storage/' . $transaksi->qr_code_path) }}" alt="QR Code"
                        class="object-contain w-32 h-32" />
                </div>
            </div>

            {{-- Verifikasi --}}
            @if ($transaksi->status_tiket == 'belum_digunakan')
                <form method="POST" action="{{ route('admin-wisata.scan.verify', $transaksi->order_id) }}" class="mt-4">
                    @csrf
                    <button type="submit"
                        class="w-full px-4 py-2 font-semibold text-white transition bg-green-500 rounded-lg hover:bg-green-600">
                        <i class="mr-2 fa-solid fa-check"></i> Verifikasi & Tandai Sudah Digunakan
                    </button>
                </form>
            @else
                <div class="mt-4 font-semibold text-center text-green-400">
                    Tiket sudah diverifikasi & digunakan.
                </div>
            @endif

            {{-- Tombol Kembali --}}
            <div class="flex justify-center mt-6">
                <a href="{{ route('admin-wisata.scan.index') }}"
                    class="inline-flex items-center px-4 py-2 text-white transition bg-gray-700 rounded-lg hover:text-green-500">
                    <i class="mr-2 fa-solid fa-arrow-left"></i> Kembali ke Scan Tiket
                </a>
            </div>

            {{-- Footer Nota --}}
            <div class="mt-8 text-xs text-center text-gray-500">
                Terima kasih telah menggunakan LumaGO! <br>
                <span class="text-gray-700/50">--- {{ now()->format('d M Y H:i') }} ---</span>
            </div>
        </div>
    </div>
@endsection
