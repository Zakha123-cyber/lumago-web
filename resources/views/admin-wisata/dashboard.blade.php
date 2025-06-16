@extends('layouts.superadmin')

@section('content')
    <div class="px-4 mx-auto space-y-8 max-w-7xl">
        {{-- Filter Bulan --}}
        <form method="GET" class="flex flex-col items-center gap-4 mb-6 sm:flex-row">
            <div>
                <label for="bulan" class="block mb-2 text-sm font-medium text-white">Pilih Bulan</label>
                <input type="month" id="bulan" name="bulan" value="{{ $bulan ?? now()->format('Y-m') }}"
                    class="w-full sm:w-48 px-4 py-2.5 text-base bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500/30 focus:border-green-500 text-gray-900">
            </div>
            <button type="submit"
                class="w-full sm:w-auto mt-6 px-4 py-2.5 text-sm font-medium text-white transition-colors rounded-lg bg-green-500 hover:bg-green-600">
                <i class="mr-2 fa-solid fa-filter"></i> Terapkan Filter
            </button>
        </form>

        {{-- Stats Grid --}}
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- Total Pengunjung -->
            <div class="p-6 transition-all duration-300 border rounded-xl bg-white/5 border-white/10 hover:bg-white/10">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-400">Total Pengunjung</h3>
                    <i class="text-2xl text-green-400 fa-solid fa-users"></i>
                </div>
                <p class="mt-2 text-3xl font-bold text-white">{{ number_format($totalPengunjung) }}</p>
                <span class="text-sm text-gray-400">Bulan
                    {{ \Carbon\Carbon::parse($bulan ?? now())->translatedFormat('F Y') }}</span>
            </div>
            <!-- Total User Unik -->
            <div class="p-6 transition-all duration-300 border rounded-xl bg-white/5 border-white/10 hover:bg-white/10">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-400">User Pernah Berkunjung</h3>
                    <i class="text-2xl text-blue-400 fa-solid fa-user-check"></i>
                </div>
                <p class="mt-2 text-3xl font-bold text-white">{{ number_format($totalUserUnik) }}</p>
                <span class="text-sm text-gray-400">User yang pernah berkunjung</span>
            </div>
            <!-- Total Pendapatan -->
            <div class="p-6 transition-all duration-300 border rounded-xl bg-white/5 border-white/10 hover:bg-white/10">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-400">Total Pendapatan</h3>
                    <i class="text-2xl text-yellow-400 fa-solid fa-wallet"></i>
                </div>
                <p class="mt-2 text-3xl font-bold text-white">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                <span class="text-sm text-gray-400">Bulan
                    {{ \Carbon\Carbon::parse($bulan ?? now())->translatedFormat('F Y') }}</span>
            </div>
            <!-- Total Transaksi -->
            <div class="p-6 transition-all duration-300 border rounded-xl bg-white/5 border-white/10 hover:bg-white/10">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-400">Total Transaksi</h3>
                    <i class="text-2xl text-purple-400 fa-solid fa-ticket"></i>
                </div>
                <p class="mt-2 text-3xl font-bold text-white">{{ number_format($totalTransaksi) }}</p>
                <span class="text-sm text-gray-400">Bulan
                    {{ \Carbon\Carbon::parse($bulan ?? now())->translatedFormat('F Y') }}</span>
            </div>
        </div>

        {{-- Chart Section --}}
        <div class="grid gap-6 lg:grid-cols-2">
            <!-- Grafik Pengunjung -->
            <div class="p-6 border rounded-xl bg-white/5 border-white/10">
                <h3 class="mb-4 text-lg font-semibold text-white">Grafik Pengunjung</h3>
                <canvas id="pengunjungChart" class="w-full"></canvas>
            </div>
            <!-- Grafik Pendapatan -->
            <div class="p-6 border rounded-xl bg-white/5 border-white/10">
                <h3 class="mb-4 text-lg font-semibold text-white">Grafik Pendapatan</h3>
                <canvas id="pendapatanChart" class="w-full"></canvas>
            </div>
        </div>

        {{-- Tabel Transaksi Terbaru --}}
        <div class="p-6 border rounded-xl bg-white/5 border-white/10">
            <h3 class="mb-4 text-lg font-semibold text-white">Recent Transactions</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-400">
                            <th class="p-4">Transaction ID</th>
                            <th class="p-4">User</th>
                            <th class="p-4">Destination</th>
                            <th class="p-4">Amount</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse($latestTransaksi as $transaksi)
                            <tr class="text-white">
                                <td class="p-4">{{ $transaksi->order_id }}</td>
                                <td class="p-4">{{ $transaksi->user->name }}</td>
                                <td class="p-4">{{ $transaksi->wisata->nama }}</td>
                                <td class="p-4">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    <span
                                        class="px-2 py-1 text-sm rounded-full
                                {{ $transaksi->status_pembayaran === 'selesai' ? 'bg-green-400/10 text-green-400' : 'bg-yellow-400/10 text-yellow-400' }}">
                                        {{ ucfirst($transaksi->status_pembayaran) }}
                                    </span>
                                </td>
                                <td class="p-4">{{ $transaksi->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-400">
                                    No transactions found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Grafik Pengunjung (Line)
                const pengunjungCtx = document.getElementById('pengunjungChart').getContext('2d');
                new Chart(pengunjungCtx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartPengunjung->pluck('date')) !!},
                        datasets: [{
                            label: 'Pengunjung',
                            data: {!! json_encode($chartPengunjung->pluck('total')) !!},
                            borderColor: '#4ade80',
                            tension: 0.3,
                            fill: true,
                            backgroundColor: 'rgba(74, 222, 128, 0.1)'
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
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(255,255,255,0.1)'
                                },
                                ticks: {
                                    color: 'rgba(255,255,255,0.7)'
                                }
                            },
                            x: {
                                grid: {
                                    color: 'rgba(255,255,255,0.1)'
                                },
                                ticks: {
                                    color: 'rgba(255,255,255,0.7)'
                                }
                            }
                        }
                    }
                });

                // Grafik Pendapatan (Line)
                const pendapatanCtx = document.getElementById('pendapatanChart').getContext('2d');
                new Chart(pendapatanCtx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartPendapatan->pluck('date')) !!},
                        datasets: [{
                            label: 'Pendapatan',
                            data: {!! json_encode($chartPendapatan->pluck('total')) !!},
                            borderColor: '#fde047',
                            tension: 0.3,
                            fill: true,
                            backgroundColor: 'rgba(250,204,21,0.08)'
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
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(255,255,255,0.1)'
                                },
                                ticks: {
                                    color: 'rgba(255,255,255,0.7)'
                                }
                            },
                            x: {
                                grid: {
                                    color: 'rgba(255,255,255,0.1)'
                                },
                                ticks: {
                                    color: 'rgba(255,255,255,0.7)'
                                }
                            }
                        }
                    }
                });
            </script>
        @endpush
    @endsection
