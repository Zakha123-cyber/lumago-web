@extends('layouts.superadmin')

@section('content')
    <div class="px-4 mx-auto space-y-8 max-w-7xl">
        {{-- Header & Filter --}}
        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Data Pengunjung</h2>
                <p class="mt-1 text-lg text-gray-400">Daftar pengunjung yang pernah memesan tiket di tempat wisata Anda</p>
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
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">
            <div class="flex flex-col items-center p-6 border rounded-xl bg-gray-800/70 border-white/10">
                <div class="mb-1 text-sm text-gray-400">Total Pengunjung (Bulan Ini)</div>
                <div class="text-2xl font-bold text-green-400">{{ $totalPengunjungBulan }}</div>
            </div>
            <div class="flex flex-col items-center p-6 border rounded-xl bg-gray-800/70 border-white/10">
                <div class="mb-1 text-sm text-gray-400">Total Pengunjung (Keseluruhan)</div>
                <div class="text-2xl font-bold text-green-400">{{ $totalPengunjungKeseluruhan }}</div>
            </div>
        </div>

        {{-- Chart Grafik --}}
        <div class="p-6 mt-8 border rounded-xl bg-gray-800/70 border-white/10">
            <h3 class="mb-4 text-lg font-semibold text-white">Grafik Total Pengunjung per Bulan</h3>
            <canvas id="chartPengunjung"></canvas>
        </div>

        {{-- Tabel Pengunjung --}}
        <div class="mt-8 border rounded-xl bg-gray-800/50 border-white/10">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-900/80">
                            <th class="p-4 text-sm font-medium text-green-400">Nama Pengunjung</th>
                            <th class="p-4 text-sm font-medium text-green-400">Email</th>
                            <th class="p-4 text-sm font-medium text-green-400">Jumlah Tiket</th>
                            <th class="p-4 text-sm font-medium text-green-400">Tanggal Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengunjungList as $pengunjung)
                            <tr class="transition even:bg-gray-800/70 odd:bg-gray-700/60 hover:bg-green-900/20">
                                <td class="p-4 text-white">{{ $pengunjung->user->name }}</td>
                                <td class="p-4 text-white">{{ $pengunjung->user->email }}</td>
                                <td class="p-4 text-white">{{ $pengunjung->jumlah_tiket }}</td>
                                <td class="p-4 text-white">
                                    {{ \Carbon\Carbon::parse($pengunjung->tanggal_booking)->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-400 bg-gray-800/70">
                                    Tidak ada data pengunjung
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($pengunjungList->hasPages())
                <div class="p-4 border-t border-white/10">
                    {{ $pengunjungList->links() }}
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const bulanLabels = @json(array_values($bulanList));
            const chartPengunjungData = @json($chartPengunjung);

            new Chart(document.getElementById('chartPengunjung'), {
                type: 'bar',
                data: {
                    labels: bulanLabels,
                    datasets: [{
                        label: 'Total Pengunjung',
                        data: chartPengunjungData,
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
        </script>
    @endpush
@endsection
