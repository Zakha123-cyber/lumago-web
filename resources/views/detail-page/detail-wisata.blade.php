<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $wisata->nama }} - Detail Wisata</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        /* Base Styles */
        body {
            background: linear-gradient(135deg, #0f172a 0%, #020617 100%);
            color: #e2e8f0;
            overflow-x: hidden;
        }

        /* Back Button Animation */
        .back-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .back-btn:hover {
            transform: translateX(-4px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            background: rgba(255, 255, 255, 0.15);
        }

        /* Image Grid Effects */
        .image-grid-item {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .image-grid-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .image-grid-item::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg,
                    rgba(16, 185, 129, 0.2),
                    rgba(59, 130, 246, 0.2));
            opacity: 0;
            transition: all 0.4s ease;
        }

        .image-grid-item:hover::after {
            opacity: 1;
        }

        /* View All Button Effect */
        .view-all-btn {
            transition: all 0.5s cubic-bezier(0.68, -0.6, 0.32, 1.6);
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.2));
            backdrop-filter: blur(10px);
        }

        .view-all-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        /* Content Section Animations */
        .content-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .content-card:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .hover-lift {
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        /* Price Tag Animation */
        .price-tag {
            animation: pulse 2s infinite;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            transform: scale(1);
        }

        @keyframes pulse {
            0% {
                transform: scale(0.98);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }

            100% {
                transform: scale(0.98);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        /* Booking Button Animation */
        .booking-btn {
            background: linear-gradient(45deg, #10b981, #059669);
            transition: all 0.5s cubic-bezier(0.68, -0.6, 0.32, 1.6);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
            position: relative;
            overflow: hidden;
        }

        .booking-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.5);
        }

        .booking-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.6s;
        }

        .booking-btn:hover::after {
            left: 100%;
        }

        /* Floating Water Drops */
        .water-drop {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            filter: blur(5px);
            animation: float 8s infinite ease-in-out;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        /* Scroll Reveal Animation */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-1 {
            transition-delay: 0.1s;
        }

        .delay-2 {
            transition-delay: 0.2s;
        }

        .delay-3 {
            transition-delay: 0.3s;
        }

        .delay-4 {
            transition-delay: 0.4s;
        }

        .delay-5 {
            transition-delay: 0.5s;
        }

        /* Custom Swiper Styles */
        .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.5);
            width: 10px;
            height: 10px;
            transition: all 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            background: #10b981;
            transform: scale(1.3);
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #10b981;
            background: rgba(15, 23, 42, 0.7);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(16, 185, 129, 0.3);
            transform: scale(1.1);
        }

        /* Water Sound Wave Effect */
        .sound-wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="rgba(16,185,129,0.1)" opacity=".25"/><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" fill="rgba(16,185,129,0.1)" opacity=".5"/><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="rgba(16,185,129,0.1)"/></svg>');
            background-size: cover;
            background-repeat: no-repeat;
            opacity: 0.7;
            z-index: -1;
            animation: wave 15s linear infinite;
        }

        @keyframes wave {
            0% {
                background-position-x: 0;
            }

            100% {
                background-position-x: 1200px;
            }
        }

        /* Enhanced Background Effects */
        .bg-gradient-radial {
            background: radial-gradient(circle at center,
                    rgba(15, 23, 42, 0.95) 0%,
                    rgba(2, 6, 23, 0.98) 100%);
        }

        .floating-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            pointer-events: none;
        }

        .blob-1 {
            width: 400px;
            height: 400px;
            background: linear-gradient(45deg, #10b981, #3b82f6);
            top: 10%;
            left: -5%;
            animation: float-blob1 20s infinite ease-in-out;
        }

        .blob-2 {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, #8b5cf6, #ec4899);
            top: 40%;
            right: -5%;
            animation: float-blob2 25s infinite ease-in-out;
        }

        .blob-3 {
            width: 250px;
            height: 250px;
            background: linear-gradient(45deg, #f59e0b, #ef4444);
            bottom: 10%;
            left: 30%;
            animation: float-blob3 22s infinite ease-in-out;
        }

        @keyframes float-blob1 {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            50% {
                transform: translate(30px, 50px) rotate(180deg);
            }
        }

        @keyframes float-blob2 {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            50% {
                transform: translate(-40px, -30px) rotate(-180deg);
            }
        }

        @keyframes float-blob3 {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            50% {
                transform: translate(20px, -40px) rotate(90deg);
            }
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            pointer-events: none;
        }

        .float-1 {
            width: 300px;
            height: 300px;
            background: #10b981;
            left: 10%;
            top: 20%;
            animation: float1 15s ease-in-out infinite;
        }

        .float-2 {
            width: 250px;
            height: 250px;
            background: #3b82f6;
            right: 15%;
            top: 30%;
            animation: float2 20s ease-in-out infinite;
        }

        .float-3 {
            width: 200px;
            height: 200px;
            background: #8b5cf6;
            left: 30%;
            bottom: 20%;
            animation: float3 18s ease-in-out infinite;
        }

        @keyframes float1 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(30px, -30px);
            }
        }

        @keyframes float2 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-20px, 20px);
            }
        }

        @keyframes float3 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(25px, 25px);
            }
        }

        @keyframes gridMove {
            0% {
                transform: translateY(-50px);
            }

            100% {
                transform: translateY(0px);
            }
        }
    </style>
</head>

<body class="relative overflow-x-hidden">
    <!-- Back Button -->
    <button onclick="history.back()"
        class="fixed top-6 left-6 z-50 back-btn bg-white/10 backdrop-blur-md text-white px-4 py-2 rounded-full flex items-center gap-2 hover:bg-white/20">
        <i class="fas fa-arrow-left"></i>
        <span class="text-sm font-medium">Kembali</span>
    </button>

    <!-- Animated Background Elements -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-radial"></div>
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
        <div class="floating-blob blob-1"></div>
        <div class="floating-blob blob-2"></div>
        <div class="floating-blob blob-3"></div>
    </div>

    <!-- Main Content Wrapper -->
    <div class="relative z-10">
        <!-- Image Grid Section -->
        <div class="relative overflow-hidden">
            <!-- Desktop Grid -->
            <div class="hidden md:grid grid-cols-12 gap-6 h-[600px] container mx-auto px-8 pt-24">
                <!-- Main Large Image -->
                <div class="col-span-7 relative group overflow-hidden rounded-3xl image-grid-item">
                    <img src="{{ $wisata->gambarWisata->first() ? asset('storage/' . $wisata->gambarWisata->first()->path_gambar) : asset('storage/images/default-wisata.jpg') }}"
                        alt="{{ $wisata->nama }} "
                        class="w-full h-full object-cover transform transition-all duration-700 hover:scale-110">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-100 group-hover:opacity-0 transition-opacity duration-500">
                    </div>
                </div>

                <!-- Right Side Grid -->
                <div class="col-span-5 grid grid-rows-2 gap-6">
                    <!-- Top Two Images -->
                    <div class="grid grid-cols-2 gap-6">
                        @foreach ($wisata->gambarWisata->skip(1)->take(2) as $gambar)
                            <div class="relative group overflow-hidden rounded-2xl image-grid-item">
                                <img src="{{ asset('storage/' . $gambar->path_gambar) }}" alt="{{ $wisata->nama }}"
                                    class="w-full h-full object-cover transform transition-all duration-700 hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-100 group-hover:opacity-0 transition-opacity duration-500">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- View All Photos Button -->
                    <div class="relative group overflow-hidden rounded-2xl image-grid-item">
                        <img src="{{ $wisata->gambarWisata->skip(3)->first() ? asset('storage/' . $wisata->gambarWisata->skip(3)->first()->path_gambar) : asset('storage/images/default-wisata.jpg') }}"
                            alt="{{ $wisata->nama }}" class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-black/60 backdrop-blur-[2px] group-hover:bg-black/70 transition-all duration-500 flex items-center justify-center">
                            <button
                                class="view-all-btn px-6 py-3 rounded-xl border border-white/20 text-white flex items-center gap-3 transform hover:scale-105 transition-all duration-300">
                                <i class="fas fa-images text-lg"></i>
                                <span class="font-medium">View All Photos</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Carousel -->
            <div class="md:hidden relative h-[400px] rounded-2xl overflow-hidden container mx-auto px-6 pt-24">
                <div class="swiper mySwiper h-full w-full">
                    <div class="swiper-wrapper">
                        @foreach ($wisata->gambarWisata as $gambar)
                            <div class="swiper-slide relative">
                                <img src="{{ asset('storage/' . $gambar->path_gambar) }}" alt="{{ $wisata->nama }}"
                                    class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/50"></div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next !z-20"></div>
                    <div class="swiper-button-prev !z-20"></div>
                    <div class="swiper-pagination !z-20"></div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="container mx-auto px-6 py-12">
            <div class="content-card rounded-2xl border border-white/10 p-8 mb-8 bg-white/5 backdrop-blur-md">
                <!-- Title & Basic Info -->
                <div class="flex flex-wrap justify-between items-start mb-8 fade-in delay-1">
                    <div>
                        <h1
                            class="text-4xl md:text-5xl font-bold text-white mb-4 bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-emerald-600">
                            {{ $wisata->nama }}
                        </h1>
                        <div class="flex flex-wrap items-center gap-4 text-gray-300">
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-green-400 mr-2"></i>
                                <span>{{ $wisata->lokasi }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-tag text-green-400 mr-2"></i>
                                <span>{{ $wisata->kategori->nama_kategori }}</span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="price-tag bg-green-500/90 backdrop-blur-sm text-white px-6 py-3 rounded-xl text-lg font-semibold mt-4 md:mt-0">
                        Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}
                    </div>
                </div>

                <!-- Description -->
                <div class="prose prose-invert max-w-none mb-8 fade-in delay-2">
                    <h2 class="text-2xl font-semibold text-white mb-4 relative inline-block">
                        Tentang Wisata
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        {{ $wisata->deskripsi }}
                    </p>
                </div>

                <!-- Operating Hours -->
                <div class="grid md:grid-cols-2 gap-8 mb-8">
                    <div class="bg-white/5 rounded-xl p-6 fade-in delay-3 hover-lift border border-white/10">
                        <h3 class="text-xl font-semibold text-white mb-4 flex items-center">
                            <i class="fas fa-clock text-green-400 mr-3"></i>
                            Jam Operasional
                        </h3>
                        <div class="space-y-3 text-gray-300">
                            <div class="flex justify-between items-center py-2 border-b border-white/10">
                                <span class="flex items-center">
                                    <i class="fas fa-calendar-day text-green-400 mr-2"></i>
                                    Jam Buka
                                </span>
                                <span
                                    class="bg-green-900/30 px-3 py-1 rounded-full">{{ $wisata->jam_operasional }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location Map -->
                <div class="mb-8 fade-in delay-4">
                    <h3 class="text-2xl font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-map-marked-alt text-green-400 mr-3"></i>
                        Lokasi
                    </h3>
                    <div class="bg-white/5 rounded-xl overflow-hidden h-[400px] relative border border-white/10">
                        <iframe src="{{ $wisata->link_maps }}" width="100%" height="100%" style="border:0;"
                            allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>

                <!-- Booking Button -->
                <button
                    class="w-full booking-btn text-white py-4 rounded-xl text-lg font-semibold transition-all duration-300 flex items-center justify-center gap-2 fade-in delay-4 hover-lift">
                    <span>Booking Sekarang</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Water Sound Effect Toggle -->
    <button id="soundToggle"
        class="fixed bottom-6 right-6 z-50 bg-green-500/20 backdrop-blur-md text-white w-12 h-12 rounded-full flex items-center justify-center hover:bg-green-500/30 transition-all duration-300 shadow-lg">
        <i class="fas fa-water text-xl"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Initialize Swiper
        const swiper = new Swiper('.mySwiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        // Scroll Reveal Animation
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            fadeElements.forEach(el => observer.observe(el));

            // Water Sound Effect
            const soundToggle = document.getElementById('soundToggle');
            let waterSound = new Audio('https://assets.mixkit.co/sfx/preview/mixkit-nature-waterfall-1189.mp3');
            waterSound.loop = true;
            let isPlaying = false;

            soundToggle.addEventListener('click', function() {
                if (isPlaying) {
                    waterSound.pause();
                    soundToggle.innerHTML = '<i class="fas fa-water text-xl"></i>';
                } else {
                    waterSound.play();
                    soundToggle.innerHTML = '<i class="fas fa-volume-up text-xl"></i>';
                }
                isPlaying = !isPlaying;
            });

            // Parallax Effect for Water Drops
            window.addEventListener('scroll', function() {
                const scrollPosition = window.pageYOffset;
                const waterDrops = document.querySelectorAll('.water-drop');

                waterDrops.forEach((drop, index) => {
                    const speed = 0.2 + (index * 0.1);
                    drop.style.transform =
                        `translateY(${scrollPosition * speed}px) rotate(${scrollPosition * 0.1}deg)`;
                });
            });
        });
    </script>
</body>

</html>
