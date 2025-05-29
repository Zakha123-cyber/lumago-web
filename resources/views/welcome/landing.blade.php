@extends('layouts.app')

@push('styles')
    <style>
        .hero-bg {
            background: url('{{ asset('storage/images/bg-landing-page.jpeg') }}');
            background-size: cover;
            background-position: center;
        }

        .section-dark {
            background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .btn-primary {
            background: linear-gradient(45deg, #10b981, #059669);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #059669, #047857);
            transform: translateY(-2px);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section id="home" class="hero-bg min-h-screen flex items-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-green-800/40 to-green-600/20"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl">
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 floating-animation">
                    It's Great Time<br>
                    to Start your <span class="text-green-400">Journey Now</span>
                </h1>
                <p class="text-xl text-gray-200 mb-8 max-w-2xl">
                    Jelajahi keindahan alam Indonesia dengan pengalaman yang tak terlupakan. Booking mudah, perjalanan
                    hebat!
                </p>
                <button class="btn-primary text-white px-8 py-4 rounded-full text-lg font-semibold">
                    Mulai Petualangan <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
            <i class="fas fa-chevron-down text-2xl"></i>
        </div>
    </section>

    <!-- About Lumago Section -->
    <section class="py-20" style="background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="text-white">
                    <span class="text-green-400 font-semibold text-sm tracking-widest uppercase mb-4 block">ABOUT</span>
                    <h2 class="text-5xl font-bold mb-8">LUMAGO!</h2>
                    <div class="space-y-4 text-gray-300 leading-relaxed">
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore
                            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                            ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                            esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                            sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                            totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae
                            dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                            fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>

                        <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                            quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat
                            voluptatem.</p>
                    </div>
                </div>

                <!-- Image Card Component -->
                <div class="relative transfrom lg:translate-x-35">
                    <div class="w-120 h-80 lg:rounded-l-full sm:rounded-l-3xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-300 ml-auto"
                        style="background: linear-gradient(45deg, #f59e0b, #f97316); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0"
                            style="background: linear-gradient(135deg, rgba(251, 191, 36, 0.8) 0%, rgba(245, 101, 101, 0.6) 100%);">
                        </div>

                        <!-- Bottom content area -->
                        <div class="absolute bottom-0 left-0 right-0 h-24"
                            style="background: linear-gradient(to top, rgba(0, 0, 0, 0.4), transparent);"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Wisata Lumajang Section -->
    <section class="py-20" style="background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Image Card Component -->
                <div class="relative transform lg:-translate-x-35">
                    <div class="w-120 h-80 lg:rounded-r-full sm:rounded-r-3xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-300"
                        style="box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
                    </div>
                </div>

                <!-- Text Content -->
                <div class="text-white order-1 lg:order-2">
                    <span class="text-green-400 font-semibold text-sm tracking-widest uppercase mb-4 block">WISATA</span>
                    <h2 class="text-5xl font-bold mb-8">LUMAJANG</h2>
                    <div class="space-y-4 text-gray-300 leading-relaxed">
                        <p>Kabupat Lumajang memiliki potensi keindahan alam yang luar biasa dan masih asli. Mulai dari
                            pegunungan hingga laut, hampir semua yang ada di Indonesia, Anda bisa menemukan berbagai
                            destinasi Kota Lumajang yang memiliki daya tarik tersendiri.</p>

                        <p>Tempat wisata di Lumajang yang beragam ini mulai dari wisata alam, wisata budaya, wisata edukasi,
                            dan wisata kuliner. Beraneka ragam destinasi ini tentunya akan memberikan pengalaman yang
                            berbeda dan menarik bagi para wisatawan yang berkunjung ke Lumajang.</p>

                        <p>Setiap objek wisata memiliki keunikan dan pesona tersendiri yang menunggu untuk dijelajahi. Dari
                            keindahan alam pegunungan hingga pesona pantai yang menakjubkan, Lumajang menawarkan destinasi
                            yang sempurna untuk petualangan yang tak terlupakan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kenapa Lumajang Section -->
    <section class="py-20" style="background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="text-white">
                    <span class="text-green-400 font-semibold text-sm tracking-widest uppercase mb-4 block">KENAPA</span>
                    <h2 class="text-5xl font-bold mb-8">LUMAJANG</h2>
                    <div class="space-y-4 text-gray-300 leading-relaxed">
                        <p>Lumajang memiliki kombinasi yang sempurna antara keindahan alam yang menakjubkan dan kekayaan
                            budaya lokal yang masih terjaga. Dengan beragam destinasi mulai dari pegunungan hingga pantai,
                            Lumajang menawarkan pengalaman wisata yang lengkap dan tak terlupakan.</p>

                        <p>Keramahan masyarakat lokal, aksesibilitas yang semakin baik, dan fasilitas wisata yang terus
                            berkembang membuat Lumajang menjadi destinasi yang tepat bagi wisatawan yang mencari petualangan
                            autentik dengan kenyamanan modern.</p>

                        <p>Dari sunrise di Gunung Bromo hingga pesona air terjun yang tersembunyi, setiap sudut Lumajang
                            menyimpan kejutan dan keindahan yang siap memukau setiap pengunjung yang datang untuk
                            menjelajahi keajaiban alam Indonesia.</p>
                    </div>
                </div>

                <!-- Image Card Component -->
                <div class="relative transfrom lg:translate-x-35">
                    <div class="w-120 h-80 lg:rounded-l-full rounded-l-3xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-300 ml-auto"
                        style="background: linear-gradient(45deg, #3b82f6, #ef4444); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0"
                            style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.8) 0%, rgba(239, 68, 68, 0.6) 50%, rgba(245, 158, 11, 0.4) 100%);">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Destinations Carousel Section --}}
    <section class="w-full px-4 py-12 bg-gray-100">
        <div class="relative max-w-7xl mx-auto">
            <!-- Section Header (Optional) -->
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Explore Amazing Destinations
                </h2>
                <p class="text-lg text-gray-600">
                    Discover breathtaking landscapes and unforgettable experiences
                </p>
            </div>

            <!-- Navigation Arrows -->
            <button id="prevBtn"
                class="absolute left-0 top-1/2 -translate-y-1/2 z-20 bg-white rounded-full p-3 shadow-lg hover:bg-gray-200 transition -ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button id="nextBtn"
                class="absolute right-0 top-1/2 -translate-y-1/2 z-20 bg-white rounded-full p-3 shadow-lg hover:bg-gray-200 transition -mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Cards Container -->
            <div id="cardsContainer" class="overflow-x-auto py-8 px-12 hide-scrollbar scroll-smooth">
                <div class="flex items-center space-x-0 w-max mx-auto" id="cardsWrapper">
                    @php
                        $destinations = [
                            [
                                'title' => 'Pacific Rim',
                                'subtitle' => 'Wild Pacific Coast',
                                'image' => 'https://source.unsplash.com/800x600/?pacific,coast',
                                'url' => '/destinations/pacific-rim',
                            ],
                            [
                                'title' => 'Vancouver',
                                'subtitle' => 'Urban Adventure',
                                'image' => 'https://source.unsplash.com/800x600/?vancouver,city',
                                'url' => '/destinations/vancouver',
                            ],
                            [
                                'title' => 'Victoria',
                                'subtitle' => 'British Columbia',
                                'image' => 'https://source.unsplash.com/800x600/?victoria,garden',
                                'url' => '/destinations/victoria',
                            ],
                            [
                                'title' => 'Calgary',
                                'subtitle' => 'Mountain Gateway',
                                'image' => 'https://source.unsplash.com/800x600/?calgary,mountain',
                                'url' => '/destinations/calgary',
                            ],
                            [
                                'title' => 'Whistler',
                                'subtitle' => 'Alpine Paradise',
                                'image' => 'https://source.unsplash.com/800x600/?whistler,ski',
                                'url' => '/destinations/whistler',
                            ],
                            [
                                'title' => 'Banff',
                                'subtitle' => 'Rocky Mountains',
                                'image' => 'https://source.unsplash.com/800x600/?banff,lake',
                                'url' => '/destinations/banff',
                            ],
                        ];
                    @endphp

                    @foreach ($destinations as $index => $destination)
                        <x-destination-card :title="$destination['title']" :subtitle="$destination['subtitle']" :image="$destination['image']" :url="$destination['url']"
                            :isActive="$index === 2" />
                    @endforeach
                </div>
            </div>

            <!-- Dots Indicator -->
            <div class="flex justify-center mt-6 space-x-2">
                @for ($i = 0; $i < count($destinations); $i++)
                    <button
                        class="dot w-3 h-3 rounded-full transition-colors duration-300 {{ $i === 2 ? 'bg-blue-500' : 'bg-gray-300 hover:bg-gray-400' }}"
                        data-index="{{ $i }}"></button>
                @endfor
            </div>
        </div>
    </section>

    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Smooth transitions */
        .destination-card {
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
            transition-property: transform, width, height, box-shadow;
            transition-duration: 0.3s;
            transition-timing-function: ease-out;
        }

        /* Shadow khusus untuk card aktif */
        .destination-card.active-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3),
                0 0 15px rgba(0, 0, 0, 0.1);
        }

        /* Atau gunakan Tailwind arbitrary value */
        .shadow-3d {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3),
                0 10px 10px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@push('script')
    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Card Destination
            const container = document.getElementById('cardsContainer');
            const wrapper = document.getElementById('cardsWrapper');
            const cards = document.querySelectorAll('.destination-card');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const dots = document.querySelectorAll('.dot');

            let currentIndex = 2; // Start with Victoria as active
            let cardWidth = 224; // w-52 + margin (208 + 16)
            let activeCardWidth = 304; // w-72 + margin (288 + 16)
            let isAnimating = false;

            // Initialize
            updateActiveCard();
            centerActiveCard();

            function updateActiveCard() {
                cards.forEach((card, index) => {
                    const isActive = index === currentIndex;

                    // Update classes
                    // Update classes
                    card.classList.toggle('w-72', isActive);
                    card.classList.toggle('h-96', isActive);
                    card.classList.toggle('shadow-xl', isActive);
                    card.classList.toggle('shadow-[0_20px_25px_-5px_rgba(0,0,0,0.3)]',
                        isActive); // Tambahkan shadow custom
                    card.classList.toggle('scale-110', isActive);
                    card.classList.toggle('z-10', isActive);
                    card.classList.toggle('w-52', !isActive);
                    card.classList.toggle('h-72', !isActive);
                    card.classList.toggle('shadow-md', !isActive);

                    // Update content
                    const title = card.querySelector('h3');
                    const content = card.querySelector('.absolute.bottom-0');
                    const subtitle = card.querySelector('p');

                    if (title) {
                        title.classList.toggle('text-2xl', isActive);
                        title.classList.toggle('text-xl', !isActive);
                    }

                    if (content) {
                        content.classList.toggle('p-6', isActive);
                        content.classList.toggle('p-4', !isActive);
                    }

                    // Update or create subtitle
                    if (isActive && card.dataset.subtitle && !subtitle) {
                        const subtitleEl = document.createElement('p');
                        subtitleEl.className = 'text-sm opacity-90';
                        subtitleEl.textContent = card.dataset.subtitle;
                        title.after(subtitleEl);
                    } else if (!isActive && subtitle) {
                        subtitle.remove();
                    }

                    // Update active badge
                    const badge = card.querySelector('.bg-blue-500');
                    if (isActive && !badge) {
                        const badgeEl = document.createElement('div');
                        badgeEl.className =
                            'absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold';
                        badgeEl.textContent = 'Active';
                        card.appendChild(badgeEl);
                    } else if (!isActive && badge) {
                        badge.remove();
                    }
                });

                // Update dots
                dots.forEach((dot, index) => {
                    dot.classList.toggle('bg-blue-500', index === currentIndex);
                    dot.classList.toggle('bg-gray-300', index !== currentIndex);
                    dot.classList.toggle('hover:bg-gray-400', index !== currentIndex);
                });
            }

            function centerActiveCard() {
                if (isAnimating) return;
                isAnimating = true;

                const containerWidth = container.offsetWidth;
                const scrollPosition = currentIndex * cardWidth - (containerWidth / 2) + (
                    activeCardWidth / 2);

                container.scrollTo({
                    left: scrollPosition,
                    behavior: 'smooth'
                });

                // Reset animation flag after scroll completes
                setTimeout(() => {
                    isAnimating = false;
                }, 500);
            }

            function goToIndex(index) {
                if (index < 0 || index >= cards.length || isAnimating) return;

                currentIndex = index;
                updateActiveCard();
                centerActiveCard();
            }

            // Navigation buttons
            prevBtn.addEventListener('click', () => goToIndex(currentIndex - 1));
            nextBtn.addEventListener('click', () => goToIndex(currentIndex + 1));

            // Dots navigation
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => goToIndex(index));
            });

            // Handle scroll events
            let scrollTimeout;
            container.addEventListener('scroll', () => {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    if (isAnimating) return;

                    const containerCenter = container.scrollLeft + (container
                        .offsetWidth / 2);
                    let newIndex = 0;
                    let minDistance = Infinity;

                    cards.forEach((card, index) => {
                        const cardCenter = card.offsetLeft + (card.offsetWidth /
                            2);
                        const distance = Math.abs(containerCenter - cardCenter);

                        if (distance < minDistance) {
                            minDistance = distance;
                            newIndex = index;
                        }
                    });

                    if (newIndex !== currentIndex) {
                        currentIndex = newIndex;
                        updateActiveCard();
                    }
                }, 100);
            });
        });
    </script>
@endpush
