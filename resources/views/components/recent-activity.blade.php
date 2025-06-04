@props(['recentTransactions'])

<div class="p-8 transition-all duration-300 content-card rounded-2xl fade-in delay-4">
    <div x-data="{ isOpen: false }" class="relative">
        <!-- Header with Toggle -->
        <button @click="isOpen = !isOpen" class="flex items-center justify-between w-full mb-6 group">
            <h2 class="text-2xl font-bold text-white">Aktivitas Terbaru</h2>
            <span class="text-green-400 transition-transform duration-300" :class="{ 'rotate-180': isOpen }">
                <i class="fas fa-chevron-down"></i>
            </span>
        </button>

        <!-- Dropdown Content -->
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-4" class="space-y-4">
            @forelse($recentTransactions as $transaksi)
                <div class="p-4 transition-all duration-300 bg-white/5 rounded-xl hover:bg-white/10">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-semibold text-white">{{ $transaksi->wisata->nama ?? '-' }}</h4>
                            <div class="flex items-center gap-4 mt-1">
                                <span class="text-sm text-gray-400">
                                    <i class="mr-2 fas fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($transaksi->tanggal_booking)->format('d M Y') }}
                                </span>
                                <span class="text-sm text-gray-400">
                                    <i class="mr-2 fas fa-ticket"></i>
                                    {{ $transaksi->jumlah_tiket }} Tiket
                                </span>
                            </div>
                            <div class="mt-2">
                                <span
                                    class="px-2 py-1 text-xs rounded-full
                                    {{ $transaksi->status_pembayaran === 'selesai' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                                    {{ ucfirst($transaksi->status_pembayaran) }}
                                </span>
                                <span
                                    class="px-2 py-1 text-xs rounded-full ml-2
                                    {{ $transaksi->status_tiket === 'sudah_digunakan' ? 'bg-blue-500/20 text-blue-400' : 'bg-gray-500/20 text-gray-400' }}">
                                    {{ str_replace('_', ' ', ucfirst($transaksi->status_tiket)) }}
                                </span>
                            </div>
                        </div>
                        <span class="text-lg font-semibold text-green-400">
                            Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="py-8 text-center">
                    <i class="mb-3 text-4xl text-gray-600 fas fa-ticket-alt"></i>
                    <p class="text-gray-400">Belum ada aktivitas transaksi</p>
                </div>
            @endforelse

            <!-- View All Link -->
            <a href="{{ route('profile.bookings') }}"
                class="block px-4 py-3 text-center text-white transition-all duration-300 rounded-lg bg-white/5 hover:bg-white/10">
                Lihat Semua Riwayat
                <i class="ml-2 fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
