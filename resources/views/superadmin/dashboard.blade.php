@extends('layouts.superadmin')

@section('content')
    <div class="space-y-6">
        <!-- Welcome Section -->
        <div class="p-4 border rounded-xl bg-white/5 border-white/10 backdrop-blur-sm">
            <h1 class="text-2xl font-bold text-white">
                Welcome back, {{ Auth::user()->name }}!
            </h1>
            <p class="mt-1 text-gray-400">Here's what's happening with your tourism platform today.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- Total Wisata Card -->
            <div class="p-6 transition-all duration-300 border rounded-xl bg-white/5 border-white/10 hover:bg-white/10">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-400">Total Wisata</h3>
                    <i class="text-2xl text-green-400 fa-solid fa-location-dot"></i>
                </div>
                <p class="mt-2 text-3xl font-bold text-white">{{ number_format($totalWisata) }}</p>
                <span class="text-sm text-gray-400">Tourism destinations</span>
            </div>

            <!-- Total Admin Card -->
            <div class="p-6 transition-all duration-300 border rounded-xl bg-white/5 border-white/10 hover:bg-white/10">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-400">Admin Wisata</h3>
                    <i class="text-2xl text-blue-400 fa-solid fa-users-gear"></i>
                </div>
                <p class="mt-2 text-3xl font-bold text-white">{{ number_format($totalAdminWisata) }}</p>
                <span class="text-sm text-gray-400">Tourism managers</span>
            </div>

            <!-- Total Users Card -->
            <div class="p-6 transition-all duration-300 border rounded-xl bg-white/5 border-white/10 hover:bg-white/10">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-400">Total Users</h3>
                    <i class="text-2xl text-purple-400 fa-solid fa-users"></i>
                </div>
                <p class="mt-2 text-3xl font-bold text-white">{{ number_format($totalUsers) }}</p>
                <span class="text-sm text-gray-400">Registered users</span>
            </div>

            <!-- Total Income Card -->
            <div class="p-6 transition-all duration-300 border rounded-xl bg-white/5 border-white/10 hover:bg-white/10">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-400">Total Income</h3>
                    <i class="text-2xl text-yellow-400 fa-solid fa-wallet"></i>
                </div>
                <p class="mt-2 text-3xl font-bold text-white">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                <span class="text-sm text-gray-400">From {{ number_format($totalTransaksi) }} transactions</span>
            </div>
        </div>

        <!-- Charts & Tables Section -->
        <div class="grid gap-6 lg:grid-cols-2">
            <!-- Transaction Chart -->
            <div class="p-6 border rounded-xl bg-white/5 border-white/10">
                <h3 class="mb-4 text-lg font-semibold text-white">Transaction History</h3>
                <canvas id="transactionChart" class="w-full"></canvas>
            </div>

            <!-- Top Wisata -->
            <div class="p-6 border rounded-xl bg-white/5 border-white/10">
                <h3 class="mb-4 text-lg font-semibold text-white">Top Tourism Destinations</h3>
                <div class="space-y-4">
                    @foreach ($topWisata as $wisata)
                        <div
                            class="flex items-center justify-between p-4 transition-all duration-300 border rounded-lg bg-white/5 border-white/10 hover:bg-white/10">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('storage/images/' . $wisata->gambarWisata->first()?->path_gambar) }}"
                                    alt="{{ $wisata->nama }}" class="object-cover w-12 h-12 rounded-lg">
                                <div>
                                    <h4 class="font-medium text-white">{{ $wisata->nama }}</h4>
                                    <p class="text-sm text-gray-400">{{ $wisata->transaksi_count }} bookings</p>
                                </div>
                            </div>
                            <a href="{{ route('superadmin.wisata.show', $wisata->id) }}"
                                class="p-2 text-white transition-colors rounded-lg hover:bg-white/10">
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
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
                        @foreach ($latestTransaksi as $transaksi)
                            <tr class="text-white">
                                <td class="p-4">{{ $transaksi->order_id }}</td>
                                <td class="p-4">{{ $transaksi->user->name }}</td>
                                <td class="p-4">{{ $transaksi->wisata->nama }}</td>
                                <td class="p-4">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    <span
                                        class="px-2 py-1 text-sm rounded-full {{ $transaksi->status_pembayaran === 'selesai' ? 'bg-green-400/10 text-green-400' : 'bg-yellow-400/10 text-yellow-400' }}">
                                        {{ ucfirst($transaksi->status_pembayaran) }}
                                    </span>
                                </td>
                                <td class="p-4">{{ $transaksi->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Initialize transaction chart
            const ctx = document.getElementById('transactionChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($transaksiChart->pluck('date')) !!},
                    datasets: [{
                        label: 'Daily Transactions',
                        data: {!! json_encode($transaksiChart->pluck('total')) !!},
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
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
