@extends('layouts.superadmin')

@section('content')
    <div class="px-4 mx-auto space-y-8 max-w-7xl">
        {{-- Header & Filter --}}
        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Data Transaksi</h2>
                <p class="mt-1 text-lg text-gray-400">Daftar transaksi tiket pada tempat wisata Anda</p>
            </div>
            <form method="GET" class="flex items-center gap-2">
                <label for="bulan" class="text-sm text-gray-300">Filter Bulan:</label>
                <select name="bulan" id="bulan"
                    class="px-3 py-2 text-gray-200 bg-gray-700 border rounded-lg border-white/10 focus:ring-2 focus:ring-green-500/30 focus:border-green-500">
                    <option value="">Semua Bulan</option>
                    @foreach ($bulanList as $num => $nama)
                        <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                    class="px-4 py-2 font-medium text-white transition bg-green-500 rounded-lg hover:bg-green-600">
                    <i class="mr-2 fa-solid fa-filter"></i> Tampilkan
                </button>
            </form>
        </div>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="flex flex-col items-center p-6 border rounded-xl bg-gray-800/70 border-white/10">
                <div class="mb-1 text-sm text-gray-400">Total Transaksi (Bulan Ini)</div>
                <div class="text-2xl font-bold text-green-400">{{ $totalTransaksiBulan }}</div>
            </div>
            <div class="flex flex-col items-center p-6 border rounded-xl bg-gray-800/70 border-white/10">
                <div class="mb-1 text-sm text-gray-400">Total Transaksi (Keseluruhan)</div>
                <div class="text-2xl font-bold text-green-400">{{ $totalTransaksiKeseluruhan }}</div>
            </div>
            <div class="flex flex-col items-center p-6 border rounded-xl bg-gray-800/70 border-white/10">
                <div class="mb-1 text-sm text-gray-400">Pendapatan Bulan Ini</div>
                <div class="text-2xl font-bold text-blue-400">Rp {{ number_format($totalPendapatanBulan, 0, ',', '.') }}
                </div>
            </div>
            <div class="flex flex-col items-center p-6 border rounded-xl bg-gray-800/70 border-white/10">
                <div class="mb-1 text-sm text-gray-400">Pendapatan Keseluruhan</div>
                <div class="text-2xl font-bold text-blue-400">Rp
                    {{ number_format($totalPendapatanKeseluruhan, 0, ',', '.') }}</div>
            </div>
        </div>

        {{-- Chart Grafik --}}
        <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-2">
            <div class="p-6 border rounded-xl bg-gray-800/70 border-white/10">
                <h3 class="mb-4 text-lg font-semibold text-white">Grafik Total Transaksi per Bulan</h3>
                <canvas id="chartTransaksi"></canvas>
            </div>
            <div class="p-6 border rounded-xl bg-gray-800/70 border-white/10">
                <h3 class="mb-4 text-lg font-semibold text-white">Grafik Total Pendapatan per Bulan</h3>
                <canvas id="chartPendapatan"></canvas>
            </div>
        </div>

        {{-- Tabel Transaksi --}}
        <div class="mt-8 border rounded-xl bg-gray-800/50 border-white/10">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-900/80">
                            <th class="p-4 text-sm font-medium text-green-400">Tanggal</th>
                            <th class="p-4 text-sm font-medium text-green-400">Order ID</th>
                            <th class="p-4 text-sm font-medium text-green-400">Nama Pengunjung</th>
                            <th class="p-4 text-sm font-medium text-green-400">Jumlah Tiket</th>
                            <th class="p-4 text-sm font-medium text-green-400">Total Bayar</th>
                            <th class="p-4 text-sm font-medium text-green-400">Status Pembayaran</th>
                            <th class="p-4 text-sm font-medium text-green-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksiList as $transaksi)
                            <tr class="transition even:bg-gray-800/70 odd:bg-gray-700/60 hover:bg-green-900/20">
                                <td class="p-4 text-white">
                                    {{ \Carbon\Carbon::parse($transaksi->tanggal_booking)->format('d M Y') }}
                                </td>
                                <td class="p-4 font-mono text-white">{{ $transaksi->order_id }}</td>
                                <td class="p-4 text-white">{{ $transaksi->user->name }}</td>
                                <td class="p-4 text-white">{{ $transaksi->jumlah_tiket }}</td>
                                <td class="p-4 text-white">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                                </td>
                                <td class="p-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if ($transaksi->status_pembayaran == 'selesai') bg-green-500/20 text-green-400
                                    @else bg-yellow-500/20 text-yellow-400 @endif">
                                        {{ ucfirst($transaksi->status_pembayaran) }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <a href="{{ route('admin-wisata.transaksi.show', $transaksi->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 rounded bg-blue-600 text-white hover:bg-blue-700 transition text-xs">
                                        <i class="mr-1 fa-solid fa-eye"></i> Detail
                                    </a>
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
            @if ($transaksiList->hasPages())
                <div class="p-4 border-t border-white/10">
                    {{ $transaksiList->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const bulanLabels = @json(array_values($bulanList));
        const chartTransaksiData = @json($chartTransaksi);
        const chartPendapatanData = @json($chartPendapatan);

        // Chart Transaksi
        new Chart(document.getElementById('chartTransaksi'), {
            type: 'bar',
            data: {
                labels: bulanLabels,
                datasets: [{
                    label: 'Total Transaksi',
                    data: chartTransaksiData,
                    backgroundColor: 'rgba(34,197,94,0.7)',
                    borderColor: 'rgba(34,197,94,1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    maxBarThickness: 32,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(255,255,255,0.05)'
                        },
                        ticks: {
                            color: '#fff'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255,255,255,0.08)'
                        },
                        ticks: {
                            color: '#fff'
                        }
                    }
                }
            }
        });

        // Chart Pendapatan
        new Chart(document.getElementById('chartPendapatan'), {
            type: 'line',
            data: {
                labels: bulanLabels,
                datasets: [{
                    label: 'Total Pendapatan',
                    data: chartPendapatanData,
                    fill: true,
                    backgroundColor: 'rgba(59,130,246,0.08)',
                    borderColor: 'rgba(59,130,246,1)',
                    tension: 0.3,
                    pointBackgroundColor: 'rgba(59,130,246,1)',
                    pointRadius: 5,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(255,255,255,0.05)'
                        },
                        ticks: {
                            color: '#fff'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255,255,255,0.08)'
                        },
                        ticks: {
                            color: '#fff'
                        }
                    }
                }
            }
        });
    </script>
@endpush
