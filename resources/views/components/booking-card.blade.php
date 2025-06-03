@props(['wisata'])

<div
    class="overflow-hidden transition-all duration-300 border group bg-white/10 backdrop-blur-sm rounded-xl hover:bg-white/15 border-white/10">
    <div class="relative">
        <!-- Image -->
        <img class="object-cover w-full h-48 transition-transform duration-300 group-hover:scale-105"
            src="{{ $wisata->gambarWisata->first() ? asset('storage/images/' . $wisata->gambarWisata->first()->path_gambar) : asset('storage/images/default-wisata.jpg') }}"
            alt="{{ $wisata->nama }}">

        <!-- Overlay gradient -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

        <!-- Price tag -->
        <div
            class="absolute px-3 py-1 text-sm font-semibold text-white rounded-full top-4 right-4 bg-green-500/90 backdrop-blur-sm">
            Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}
        </div>

        <!-- Location tag -->
        <div class="absolute flex items-center text-white bottom-4 left-4">
            <i class="mr-2 fas fa-map-marker-alt"></i>
            <span class="text-sm">{{ $wisata->lokasi }}</span>
        </div>
    </div>

    <div class="p-5">
        <!-- Title -->
        <h3 class="mb-2 text-xl font-bold text-white transition-colors group-hover:text-green-400">
            {{ $wisata->nama }}
        </h3>

        <!-- Description -->
        <p class="mb-4 text-sm text-gray-400 line-clamp-2">
            {{ $wisata->deskripsi }}
        </p>

        <!-- Features -->
        <div class="flex items-center gap-4 mb-6 text-sm text-gray-400">
            <div class="flex items-center">
                <i class="mr-2 text-green-400 fas fa-clock"></i>
                <span>{{ $wisata->jam_operasional }}</span>
            </div>
            <div class="flex items-center">
                <i class="mr-2 text-green-400 fas fa-tag"></i>
                <span>{{ $wisata->kategori->nama_kategori }}</span>
            </div>
        </div>

        <!-- Booking Button -->
        <a href="{{ route('wisata.detail', $wisata->id) }}"
            class="block w-full py-3 text-center text-white transition-all duration-300 transform bg-green-500 rounded-lg hover:bg-green-600 group-hover:-translate-y-1">
            <span class="mr-2">Booking Sekarang</span>
            <i class="inline-block transition-transform fas fa-arrow-right group-hover:translate-x-1"></i>
        </a>
    </div>
</div>
