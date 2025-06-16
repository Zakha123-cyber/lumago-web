@extends('layouts.superadmin')

@section('content')
    <div class="px-4 mx-auto space-y-8 max-w-7xl">
        {{-- Header --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Data Transaksi</h2>
                <p class="mt-1 text-lg text-gray-400">Kelola data transaksi tiket wisata</p>
            </div>
        </div>

        {{-- Filter --}}
        <div class="p-6 border rounded-xl bg-gray-800/50 border-white/10">
            <form method="GET" class="flex flex-col items-center gap-4 sm:flex-row">
                <div class="w-full sm:w-auto">
                    <label for="bulan" class="block mb-2 text-sm font-medium text-white">
                        Filter Bulan
                    </label>
                    <input type="month" id="bulan" name="bulan" value="{{ $bulan }}"
                        class="w-full sm:w-48 px-4 py-2.5 text-base bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900">
                </div>
                <button type="submit"
                    class="w-full sm:w-auto mt-6 px-4 py-2.5 text-sm font-medium text-white transition-colors rounded-lg bg-green-500 hover:bg-green-600">
                    <i class="mr-2 fa-solid fa-filter"></i>
                    Terapkan Filter
                </button>
            </form>
        </div>

        {{-- Table Card --}}
        <div class="border rounded-xl bg-gray-800/50 border-white/10">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-900/80">
                            <th class="p-4 text-sm font-medium text-green-400">Tanggal</th>
                            <th class="p-4 text-sm font-medium text-green-400">Wisata</th>
                            <th class="p-4 text-sm font-medium text-green-400">User</th>
                            <th class="p-4 text-sm font-medium text-green-400">Jumlah Tiket</th>
                            <th class="p-4 text-sm font-medium text-green-400">Total Bayar</th>
                            <th class="p-4 text-sm font-medium text-green-400">Status Pembayaran</th>
                            <th class="p-4 text-sm font-medium text-green-400">Status Tiket</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $trx)
                            <tr class="transition even:bg-gray-800/70 odd:bg-gray-700/60 hover:bg-green-900/20">
                                <td class="p-4">
                                    <div class="font-medium text-white">
                                        {{ \Carbon\Carbon::parse($trx->tanggal_booking)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="font-medium text-white">{{ $trx->wisata->nama ?? '-' }}</div>
                                    <div class="text-sm text-gray-400">{{ Str::limit($trx->wisata->lokasi ?? '-', 30) }}
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="font-medium text-white">{{ $trx->user->name ?? '-' }}</div>
                                    <div class="text-sm text-gray-400">{{ $trx->user->email ?? '-' }}</div>
                                </td>
                                <td class="p-4">
                                    <div class="font-medium text-white">{{ $trx->jumlah_tiket }} tiket</div>
                                </td>
                                <td class="p-4">
                                    <div class="font-medium text-white">
                                        Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="p-4">
                                    @if ($trx->status_pembayaran == 'selesai')
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-400 rounded-full bg-green-500/10">
                                            <i class="mr-1 fa-solid fa-check"></i> Selesai
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-yellow-400 rounded-full bg-yellow-500/10">
                                            <i class="mr-1 fa-solid fa-clock"></i> Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @if ($trx->status_tiket == 'sudah_digunakan')
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-400 rounded-full bg-blue-500/10">
                                            <i class="mr-1 fa-solid fa-ticket"></i> Digunakan
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-gray-400 rounded-full bg-gray-500/10">
                                            <i class="mr-1 fa-solid fa-ticket"></i> Belum Digunakan
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-4 text-center text-gray-400 bg-gray-800/70">
                                    Tidak ada data transaksi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($transaksi->hasPages())
                <div class="p-4 border-t border-white/10">
                    {{ $transaksi->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
