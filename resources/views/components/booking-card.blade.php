<div
    class="group bg-white/10 backdrop-blur-sm rounded-xl overflow-hidden hover:bg-white/15 transition-all duration-300 border border-white/10">
    <div class="relative">
        <!-- Image -->
        <img class="object-cover w-full h-48 transition-transform duration-300 group-hover:scale-105"
            src="{{ asset('storage/images/bg-landing-page.jpeg') }}" alt="Gambar Wisata">

        <!-- Overlay gradient -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

        <!-- Price tag -->
        <div
            class="absolute top-4 right-4 bg-green-500/90 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-semibold">
            Rp 150.000
        </div>

        <!-- Location tag -->
        <div class="absolute bottom-4 left-4 flex items-center text-white">
            <i class="fas fa-map-marker-alt mr-2"></i>
            <span class="text-sm">Lumajang, Jawa Timur</span>
        </div>
    </div>

    <div class="p-5">
        <!-- Title -->
        <h3 class="text-xl font-bold text-white mb-2 group-hover:text-green-400 transition-colors">
            Tumpak Sewu
        </h3>

        <!-- Description -->
        <p class="text-gray-400 text-sm mb-4 line-clamp-2">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci sapiente sed, accusantium nihil aut qui.
        </p>

        <!-- Features -->
        <div class="flex items-center gap-4 mb-6 text-sm text-gray-400">
            <div class="flex items-center">
                <i class="fas fa-clock mr-2 text-green-400"></i>
                <span>07.00 - 17.00</span>
            </div>
        </div>

        <!-- Booking Button -->
        <a href=""
            class="block w-full bg-green-500 hover:bg-green-600 text-white text-center py-3 rounded-lg transition-all duration-300 transform group-hover:-translate-y-1">
            <span class="mr-2">Booking Sekarang</span>
            <i class="fas fa-arrow-right transition-transform group-hover:translate-x-1 inline-block"></i>
        </a>
    </div>
</div>
