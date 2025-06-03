@extends('layouts.app')

@push('styles')
    <style>
        /* Hero section enhancement */
        .hero-bg {
            background: url('{{ asset('storage/images/bg-landing-page.jpeg') }}');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .hero-bg::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 200px;
            /* Increased height for smoother transition */
            background: linear-gradient(to bottom,
                    transparent,
                    rgba(0, 0, 0, 0.5) 40%,
                    rgba(0, 0, 0, 0.8) 70%,
                    #000 100%);
            pointer-events: none;
        }

        /* Enhanced floating particles */
        .floating-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #10b981;
            border-radius: 50%;
            filter: blur(1px);
            animation: particleFloat 8s infinite;
            opacity: 0.3;
        }

        .particle:nth-child(1) {
            left: 10%;
            top: 20%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            left: 30%;
            top: 40%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            left: 50%;
            top: 60%;
            animation-delay: 4s;
        }

        .particle:nth-child(4) {
            left: 70%;
            top: 30%;
            animation-delay: 6s;
        }

        .particle:nth-child(5) {
            left: 90%;
            top: 50%;
            animation-delay: 8s;
        }

        @keyframes particleFloat {

            0%,
            100% {
                transform: translateY(0) translateX(0);
                opacity: 0.3;
            }

            50% {
                transform: translateY(-30px) translateX(20px);
                opacity: 0.6;
            }
        }

        /* Enhanced text animations */
        .text-reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .text-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-1 {
            transition-delay: 0.2s;
        }

        .delay-2 {
            transition-delay: 0.4s;
        }

        .delay-3 {
            transition-delay: 0.6s;
        }

        .delay-4 {
            transition-delay: 0.8s;
        }

        /* Enhanced scroll arrow */
        .scroll-indicator {
            animation: bounce 2s infinite;
            transition: opacity 0.3s ease;
        }

        .scroll-indicator:hover {
            opacity: 0.7;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

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

        /* Enhanced About Section Styles */
        .about-section {
            background: #000;
            position: relative;
            overflow: hidden;
        }

        .about-section::before,
        .about-section::after {
            display: none !important;
        }

        .about-section .about-gradient-transition {
            position: absolute;
            top: -40px;
            left: 0;
            width: 100%;
            height: 40px;
            background: linear-gradient(to bottom, rgba(6, 78, 59, 0.8), #000 90%);
            z-index: 2;
            pointer-events: none;
        }

        .about-title {
            background: linear-gradient(135deg, #ffffff 0%, #10b981 50%, #06d6a0 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            -webkit-text-fill-color: unset;
            animation: titleGlow 3s ease-in-out infinite;
        }

        @keyframes titleGlow {

            0%,
            100% {
                filter: brightness(1);
            }

            50% {
                filter: brightness(1.2);
            }
        }

        .enhanced-image-card {
            background: linear-gradient(145deg, #1f2937, #374151);
            border-radius: 2rem 0 0 2rem;
            position: relative;
            overflow: hidden;
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .enhanced-image-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(16, 185, 129, 0.1), transparent);
            animation: rotateGlow 4s linear infinite;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .enhanced-image-card:hover::before {
            opacity: 1;
        }

        @keyframes rotateGlow {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .enhanced-image-card::after {
            content: '';
            position: absolute;
            inset: 2px;
            border-radius: 2rem;
            z-index: 1;
            background: transparent;
        }

        .image-overlay {
            position: absolute;
            inset: 2px;
            border-radius: 2rem;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
            transition: all 0.4s ease;
            background: transparent;
        }

        .enhanced-image-card:hover .image-overlay {
            opacity: 1;
            background: transparent;
        }

        .enhanced-image-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow:
                0 35px 70px -15px rgba(0, 0, 0, 0.6),
                0 0 40px rgba(16, 185, 129, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .image-content {
            position: relative;
            z-index: 3;
            text-align: center;
            color: white;
            padding: 2rem;
        }

        .image-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            animation: iconFloat 3s ease-in-out infinite;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
        }

        @keyframes iconFloat {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .scroll-trigger {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .scroll-trigger.animate {
            opacity: 1;
            transform: translateX(0);
        }

        .scroll-trigger.from-right {
            transform: translateX(50px);
        }

        .scroll-trigger.from-right.animate {
            transform: translateX(0);
        }

        /* Add these new styles */
        .animate-spin-slow {
            animation: spin 6s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Enhanced dots animation */
        .dot.bg-green-400 {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Section reveal animation */
        .section-reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .section-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Gradient text animation */
        .gradient-text {
            background: linear-gradient(to right, #10b981, #059669);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            background-size: 200% 100%;
            animation: gradient 8s linear infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Dynamic Background Pattern */
        .dynamic-bg {
            position: relative;
            background-color: #000;
            overflow: hidden;
        }

        .dynamic-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 25% 25%, rgba(16, 185, 129, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(59, 130, 246, 0.05) 0%, transparent 50%);
            opacity: 0.5;
            z-index: 1;
        }

        /* Enhanced grid pattern with fade edges */
        .grid-pattern {
            position: absolute;
            width: 200%;
            height: 200%;
            background-image:
                linear-gradient(rgba(16, 185, 129, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(16, 185, 129, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
            opacity: 0.3;
            transform: rotate(45deg);
            mask-image: linear-gradient(to bottom,
                    transparent 0%,
                    black 15%,
                    black 85%,
                    transparent 100%);
        }

        @keyframes gridMove {
            0% {
                transform: translateY(-50%) rotate(45deg);
            }

            100% {
                transform: translateY(0%) rotate(45deg);
            }
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            filter: blur(50px);
            opacity: 0.1;
            z-index: 1;
        }

        .float-1 {
            width: 300px;
            height: 300px;
            background: #10b981;
            animation: float1 15s ease-in-out infinite;
        }

        .float-2 {
            width: 200px;
            height: 200px;
            background: #3b82f6;
            animation: float2 20s ease-in-out infinite;
        }

        @keyframes float1 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(100px, 50px);
            }
        }

        @keyframes float2 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-100px, -50px);
            }
        }

        /* Enhanced Section Transitions */
        .section-transition {
            position: relative;
            z-index: 1;
        }

        .section-transition::before {
            content: '';
            position: absolute;
            top: -100px;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(to bottom,
                    transparent 0%,
                    rgba(0, 0, 0, 0.2) 20%,
                    rgba(0, 0, 0, 0.6) 50%,
                    rgba(0, 0, 0, 0.8) 75%,
                    #000 100%);
            pointer-events: none;
            z-index: 1;
        }

        .section-transition::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(to top,
                    transparent 0%,
                    rgba(0, 0, 0, 0.2) 20%,
                    rgba(0, 0, 0, 0.6) 50%,
                    rgba(0, 0, 0, 0.8) 75%,
                    #000 100%);
            pointer-events: none;
            z-index: 1;
        }

        /* Improved Text Animations */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Enhanced Image Card Hover Effects */
        .enhanced-image-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .enhanced-image-card:hover {
            transform: translateY(-10px);
            box-shadow:
                0 25px 50px -12px rgba(16, 185, 129, 0.25),
                0 0 30px rgba(16, 185, 129, 0.1);
        }

        .enhanced-image-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom,
                    transparent 0%,
                    rgba(0, 0, 0, 0.5) 100%);
            border-radius: inherit;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .enhanced-image-card:hover::after {
            opacity: 1;
        }

        /* Smooth scroll for navigation */
        .scroll-indicator {
            cursor: pointer;
        }

        /* Hide scrollbar for specific containers */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section id="home" class="relative flex items-center min-h-screen overflow-hidden hero-bg">
        <div class="absolute inset-0 bg-gradient-to-r from-green-800/40 to-green-600/20"></div>
        <div class="container relative z-10 px-6 mx-auto">
            <div class="max-w-4xl">
                <h1 class="mb-6 text-5xl font-bold text-white md:text-7xl floating-animation text-reveal">
                    It's Great Time<br>
                    to Start your <span class="text-green-400">Journey Now</span>
                </h1>
                <p class="max-w-2xl mb-8 text-xl text-gray-200 text-reveal delay-1">
                    Jelajahi keindahan alam Indonesia dengan pengalaman yang tak terlupakan. Booking mudah, perjalanan
                    hebat!
                </p>
                <button class="px-8 py-4 text-lg font-semibold text-white rounded-full btn-primary text-reveal delay-2">
                    Mulai Petualangan <i class="ml-2 fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Wrap all main content sections -->
    <div class="section-wrapper">
        <!-- About Section -->
        <section class="relative py-20 section-transition dynamic-bg">
            <div class="grid-pattern"></div>
            <div class="floating-element float-1 left-[10%] top-[20%]"></div>
            <div class="floating-element float-2 right-[15%] bottom-[30%]"></div>

            <!-- Gradient transition di atas section -->
            <div class="about-gradient-transition"></div>

            <!-- Floating Particles -->
            <div class="floating-particles">
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
                <div class="particle"></div>
            </div>

            <div class="container relative z-10 px-6 mx-auto">
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <!-- Text Content -->
                    <div class="text-white scroll-trigger">
                        <span class="block mb-4 text-sm font-semibold tracking-widest text-green-400 uppercase text-reveal">
                            ABOUT
                        </span>
                        <h2 class="mb-8 text-5xl font-bold about-title text-reveal delay-1">
                            LUMAGO!
                        </h2>
                        <div class="space-y-4 leading-relaxed text-gray-300">
                            <p class="text-reveal delay-2">
                                Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut
                                labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                nisi
                                ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit
                                esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                                sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>

                            <p class="text-reveal delay-3">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                laudantium,
                                totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae
                                vitae
                                dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut
                                fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                            </p>

                            <p class="text-reveal delay-4">
                                Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci
                                velit,
                                sed
                                quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat
                                voluptatem.
                            </p>
                        </div>
                    </div>

                    <!-- Enhanced Image Card Component -->
                    <div class="relative transform lg:translate-x-35 scroll-trigger from-right">
                        <div class="ml-auto enhanced-image-card w-120 h-80" style="border-radius:2rem 0 0 2rem;">
                            <img src="{{ asset('storage/images/bg-landing-page.jpeg') }}" alt="About Image"
                                class="absolute inset-0 z-0 object-cover w-full h-full"
                                style="border-radius:2rem 0 0 2rem;">
                            <div class="image-overlay" style="border-radius:2rem 0 0 2rem;">
                                <div class="image-content">
                                    <div class="image-icon">
                                        <i class="fas fa-mountain"></i>
                                    </div>
                                    <h3 class="mb-2 text-xl font-bold">Adventure Awaits</h3>
                                    <p class="text-sm opacity-90">Discover the beauty of nature</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Wisata Lumajang Section -->
        <section class="relative py-20 section-transition dynamic-bg">
            <div class="grid-pattern"></div>
            <div class="floating-element float-2 left-[20%] bottom-[20%]"></div>
            <div class="floating-element float-1 right-[10%] top-[30%]"></div>

            <div class="container px-6 mx-auto">
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <!-- Image Card Component -->
                    <div class="relative transform lg:-translate-x-35">
                        <div class="ml-0 enhanced-image-card w-120 h-80 lg:mr-auto" style="border-radius:0 2rem 2rem 0;">
                            <img src="{{ asset('storage/images/bg-landing-page.jpeg') }}" alt="Wisata Image"
                                class="absolute inset-0 z-0 object-cover w-full h-full"
                                style="border-radius:0 2rem 2rem 0;">
                            <div class="image-overlay" style="border-radius:0 2rem 2rem 0;">
                                <div class="image-content">
                                    <div class="image-icon">
                                        <i class="fas fa-tree"></i>
                                    </div>
                                    <h3 class="mb-2 text-xl font-bold">Wisata Alam</h3>
                                    <p class="text-sm opacity-90">Keindahan alam Lumajang</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Text Content -->
                    <div class="order-1 text-white lg:order-2">
                        <span
                            class="block mb-4 text-sm font-semibold tracking-widest text-green-400 uppercase">WISATA</span>
                        <h2 class="mb-8 text-5xl font-bold">LUMAJANG</h2>
                        <div class="space-y-4 leading-relaxed text-gray-300">
                            <p>Kabupat Lumajang memiliki potensi keindahan alam yang luar biasa dan masih asli. Mulai dari
                                pegunungan hingga laut, hampir semua yang ada di Indonesia, Anda bisa menemukan berbagai
                                destinasi Kota Lumajang yang memiliki daya tarik tersendiri.</p>

                            <p>Tempat wisata di Lumajang yang beragam ini mulai dari wisata alam, wisata budaya, wisata
                                edukasi,
                                dan wisata kuliner. Beraneka ragam destinasi ini tentunya akan memberikan pengalaman yang
                                berbeda dan menarik bagi para wisatawan yang berkunjung ke Lumajang.</p>

                            <p>Setiap objek wisata memiliki keunikan dan pesona tersendiri yang menunggu untuk dijelajahi.
                                Dari
                                keindahan alam pegunungan hingga pesona pantai yang menakjubkan, Lumajang menawarkan
                                destinasi
                                yang sempurna untuk petualangan yang tak terlupakan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kenapa Lumajang Section -->
        <section class="relative py-20 section-transition dynamic-bg">
            <div class="grid-pattern"></div>
            <div class="floating-element float-1 left-[15%] top-[30%]"></div>
            <div class="floating-element float-2 right-[20%] bottom-[20%]"></div>

            <div class="container px-6 mx-auto">
                <div class="grid items-center gap-12 lg:grid-cols-2">
                    <!-- Text Content -->
                    <div class="text-white">
                        <span
                            class="block mb-4 text-sm font-semibold tracking-widest text-green-400 uppercase">KENAPA</span>
                        <h2 class="mb-8 text-5xl font-bold">LUMAJANG</h2>
                        <div class="space-y-4 leading-relaxed text-gray-300">
                            <p>Lumajang memiliki kombinasi yang sempurna antara keindahan alam yang menakjubkan dan kekayaan
                                budaya lokal yang masih terjaga. Dengan beragam destinasi mulai dari pegunungan hingga
                                pantai,
                                Lumajang menawarkan pengalaman wisata yang lengkap dan tak terlupakan.</p>

                            <p>Keramahan masyarakat lokal, aksesibilitas yang semakin baik, dan fasilitas wisata yang terus
                                berkembang membuat Lumajang menjadi destinasi yang tepat bagi wisatawan yang mencari
                                petualangan
                                autentik dengan kenyamanan modern.</p>

                            <p>Dari sunrise di Gunung Bromo hingga pesona air terjun yang tersembunyi, setiap sudut Lumajang
                                menyimpan kejutan dan keindahan yang siap memukau setiap pengunjung yang datang untuk
                                menjelajahi keajaiban alam Indonesia.</p>
                        </div>
                    </div>

                    <!-- Image Card Component -->
                    <div class="relative transform lg:translate-x-35">
                        <div class="ml-auto enhanced-image-card w-120 h-80" style="border-radius:2rem 0 0 2rem;">
                            <img src="{{ asset('storage/images/bg-landing-page.jpeg') }}" alt="Kenapa Lumajang"
                                class="absolute inset-0 z-0 object-cover w-full h-full"
                                style="border-radius:2rem 0 0 2rem;">
                            <div class="image-overlay" style="border-radius:2rem 0 0 2rem;">
                                <div class="image-content">
                                    <div class="image-icon">
                                        <i class="fas fa-globe-asia"></i>
                                    </div>
                                    <h3 class="mb-2 text-xl font-bold">Kenapa Lumajang?</h3>
                                    <p class="text-sm opacity-90">Alam & Budaya yang Memikat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Destinations Carousel Section --}}
        <section class="relative w-full px-4 py-20 section-transition dynamic-bg">
            <div class="grid-pattern"></div>
            <div class="floating-element float-2 left-[10%] bottom-[30%]"></div>
            <div class="floating-element float-1 right-[15%] top-[20%]"></div>

            <div class="relative mx-auto max-w-7xl">
                <!-- Enhanced Section Header -->
                <div class="mb-12 space-y-4 text-center">
                    <span class="block text-sm font-semibold tracking-widest text-green-400 uppercase text-reveal">
                        DESTINASI
                    </span>
                    <h2 class="mb-4 text-4xl font-bold text-white md:text-5xl text-reveal delay-1">
                        Explore <span class="text-green-400">Amazing Destinations</span>
                    </h2>
                    <p class="max-w-2xl mx-auto text-lg text-gray-300 text-reveal delay-2">
                        Discover breathtaking landscapes and unforgettable experiences in every corner of Lumajang
                    </p>
                    <!-- Decorative Line -->
                    <div class="flex items-center justify-center gap-4 text-reveal delay-3">
                        <div class="h-[1px] w-20 bg-gradient-to-r from-transparent via-green-400 to-transparent"></div>
                        <i class="text-xl text-green-400 fas fa-compass animate-spin-slow"></i>
                        <div class="h-[1px] w-20 bg-gradient-to-r from-transparent via-green-400 to-transparent"></div>
                    </div>
                </div>

                <!-- Enhanced Navigation Arrows -->
                <button id="prevBtn"
                    class="absolute left-0 z-20 p-4 -ml-4 text-white transition-all duration-300 -translate-y-1/2 rounded-full shadow-lg top-1/2 bg-black/30 backdrop-blur-sm hover:bg-green-500/30 group">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 transition-transform transform group-hover:-translate-x-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <button id="nextBtn"
                    class="absolute right-0 z-20 p-4 -mr-4 text-white transition-all duration-300 -translate-y-1/2 rounded-full shadow-lg top-1/2 bg-black/30 backdrop-blur-sm hover:bg-green-500/30 group">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 transition-transform transform group-hover:translate-x-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Cards Container -->
                <div id="cardsContainer" class="px-12 py-8 overflow-x-auto hide-scrollbar scroll-smooth">
                    <div class="flex items-center mx-auto space-x-0 w-max" id="cardsWrapper">
                        @foreach ($destinations as $index => $destination)
                            <x-destination-card :title="$destination->nama" :lokasi="$destination->lokasi" :image="$destination->gambarWisata->first()
                                ? asset('storage/images/' . $destination->gambarWisata->first()->path_gambar)
                                : asset('storage/images/default-wisata.jpg')" :url="route('wisata.detail', $destination->id)"
                                :isActive="$index === 2" />
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
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

            const scrollElements = document.querySelectorAll('.scroll-trigger');

            const elementInView = (el, dividend = 1) => {
                const elementTop = el.getBoundingClientRect().top;
                return (
                    elementTop <= (window.innerHeight || document.documentElement.clientHeight) / dividend
                );
            };

            const displayScrollElement = (element) => {
                element.classList.add('animate');
            };

            const hideScrollElement = (element) => {
                element.classList.remove('animate');
            };

            const handleScrollAnimation = () => {
                scrollElements.forEach((el) => {
                    if (elementInView(el, 1.25)) {
                        displayScrollElement(el);
                    } else {
                        hideScrollElement(el);
                    }
                });
            }

            window.addEventListener('scroll', () => {
                handleScrollAnimation();
            });

            // Initial check
            handleScrollAnimation();

            // Reveal animations on scroll
            const revealElements = document.querySelectorAll('.text-reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            revealElements.forEach(el => observer.observe(el));

            // Smooth scroll for navigation
            document.querySelector('.scroll-indicator').addEventListener('click', (e) => {
                e.preventDefault();
                const aboutSection = document.querySelector('.about-section');
                aboutSection.scrollIntoView({
                    behavior: 'smooth'
                });
            });

            // Parallax effect for hero section
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const hero = document.querySelector('.hero-bg');
                hero.style.backgroundPositionY = `${scrolled * 0.5}px`;
            });
        });
    </script>
@endpush
