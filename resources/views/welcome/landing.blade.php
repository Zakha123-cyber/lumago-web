<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LumaGO - Booking Wisata</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        .hero-bg {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%23065f46" width="1200" height="600"/><path fill="%23047857" d="M0,300 Q300,200 600,300 T1200,300 L1200,600 L0,600 Z"/></svg>');
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
</head>

<body class="bg-gray-900">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-transparent backdrop-blur-sm transition-all duration-300" id="navbar">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div class="text-2xl font-bold text-white">
                        <span class="text-green-400">Luma</span><span
                            class="bg-green-400 text-green-900 px-2 py-1 rounded-lg ml-1">GO!</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-white hover:text-green-400 transition-colors">Home</a>
                    <a href="#wisata" class="text-white hover:text-green-400 transition-colors">Booking Wisata</a>
                    <button class="btn-primary text-white px-6 py-2 rounded-full font-semibold">LOGIN</button>
                </div>
                <div class="md:hidden">
                    <button class="text-white text-2xl">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-bg min-h-screen flex items-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-green-800/80 to-green-600/60"></div>
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

    <!-- About Section -->
    <section class="section-dark py-20">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-white mb-6">LumaGO!</h2>
                    <p class="text-gray-300 leading-relaxed mb-6">
                        Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur.
                    </p>
                    <p class="text-gray-300 leading-relaxed">
                        Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id
                        est laborum consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua.
                    </p>
                </div>
                <div class="relative">
                    <div
                        class="w-80 h-64 bg-gradient-to-br from-orange-400 to-orange-600 rounded-3xl overflow-hidden card-hover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <i class="fas fa-sun text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Wisata Lumajang Section -->
    <section class="section-dark py-20">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="relative order-2 md:order-1">
                    <div
                        class="w-80 h-64 bg-gradient-to-br from-green-600 to-green-800 rounded-3xl overflow-hidden card-hover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <i class="fas fa-tree text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div class="order-1 md:order-2">
                    <span class="text-green-400 font-semibold">WISATA</span>
                    <h2 class="text-4xl font-bold text-white mb-6">LUMAJANG</h2>
                    <p class="text-gray-300 leading-relaxed mb-6">
                        Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur.
                    </p>
                    <p class="text-gray-300 leading-relaxed">
                        Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id
                        est laborum consectetur adipiscing elit sed do eiusmod tempor incididunt.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kenapa Lumajang Section -->
    <section class="section-dark py-20">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="text-green-400 font-semibold">KENAPA</span>
                    <h2 class="text-4xl font-bold text-white mb-6">LUMAJANG</h2>
                    <p class="text-gray-300 leading-relaxed mb-6">
                        Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur.
                    </p>
                    <p class="text-gray-300 leading-relaxed">
                        Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id
                        est laborum consectetur adipiscing elit sed do eiusmod tempor incididuit ut labore et dolore
                        magna aliqua.
                    </p>
                </div>
                <div class="relative">
                    <div
                        class="w-80 h-64 bg-gradient-to-br from-blue-400 to-orange-500 rounded-3xl overflow-hidden card-hover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <i class="fas fa-mountain text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Destinations Gallery -->
    <section id="wisata" class="section-dark py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-4">Destinasi Populer</h2>
                <p class="text-gray-300 max-w-2xl mx-auto">Jelajahi berbagai destinasi wisata menakjubkan di Lumajang
                </p>
            </div>

            <div class="grid md:grid-cols-4 gap-6 mb-8">
                <div
                    class="relative h-64 bg-gradient-to-br from-green-500 to-blue-600 rounded-2xl overflow-hidden card-hover group cursor-pointer">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-all duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-mountain text-white text-4xl"></i>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <h3 class="font-bold text-lg">Gunung Bromo</h3>
                        <p class="text-sm opacity-90">Sunrise Point</p>
                    </div>
                </div>

                <div
                    class="relative h-64 bg-gradient-to-br from-blue-500 to-green-600 rounded-2xl overflow-hidden card-hover group cursor-pointer">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-all duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-water text-white text-4xl"></i>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <h3 class="font-bold text-lg">Air Terjun</h3>
                        <p class="text-sm opacity-90">Kapas Biru</p>
                    </div>
                </div>

                <div
                    class="relative h-64 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl overflow-hidden card-hover group cursor-pointer">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-all duration-300">
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-fire text-white text-4xl"></i>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <h3 class="font-bold text-lg">Kawah Ijen</h3>
                        <p class="text-sm opacity-90">Blue Fire</p>
                    </div>
                </div>

                <div
                    class="relative h-64 bg-gradient-to-br from-green-400 to-blue-500 rounded-2xl overflow-hidden card-hover group cursor-pointer">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition-all duration-300">
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-leaf text-white text-4xl"></i>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <h3 class="font-bold text-lg">Hutan Bambu</h3>
                        <p class="text-sm opacity-90">Kemuning</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Arrows -->
            <div class="flex justify-center space-x-4 mb-8">
                <button
                    class="w-12 h-12 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all duration-300">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button
                    class="w-12 h-12 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all duration-300">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Hero Waterfall -->
    <section class="relative h-screen overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-green-600 to-blue-800"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white">
                <i class="fas fa-water text-8xl mb-8 opacity-20"></i>
                <h2 class="text-6xl font-bold mb-4">Sekumpul Waterfall</h2>
                <p class="text-xl opacity-90">Discover the hidden paradise</p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-900 to-transparent"></div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="text-2xl font-bold text-white mb-4">
                        <span class="text-green-400">Luma</span><span
                            class="bg-green-400 text-green-900 px-2 py-1 rounded-lg ml-1">GO!</span>
                    </div>
                    <p class="text-gray-400 mb-4">Jelajahi keindahan alam Indonesia dengan mudah dan aman bersama
                        LumaGO!</p>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4">Contact</h3>
                    <div class="space-y-2 text-gray-400">
                        <p><i class="fas fa-phone mr-2"></i> +62 851 5674 789</p>
                        <p><i class="fas fa-envelope mr-2"></i> LumaGO@gmail.com</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4">Follow</h3>
                    <div class="space-y-2 text-gray-400">
                        <p><i class="fab fa-instagram mr-2"></i> @LumaGO</p>
                        <p><i class="fab fa-facebook mr-2"></i> @LumaGO</p>
                        <p><i class="fab fa-youtube mr-2"></i> LumaGO Channel</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4">Quick Links</h3>
                    <div class="space-y-2">
                        <a href="#" class="block text-gray-400 hover:text-green-400 transition-colors">Home</a>
                        <a href="#" class="block text-gray-400 hover:text-green-400 transition-colors">Booking
                            Wisata</a>
                        <a href="#" class="block text-gray-400 hover:text-green-400 transition-colors">About
                            Us</a>
                        <a href="#"
                            class="block text-gray-400 hover:text-green-400 transition-colors">Contact</a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">©2025 LumaGO! Agency</p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('bg-green-900/90');
            } else {
                navbar.classList.remove('bg-green-900/90');
            }
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Card hover effects with JavaScript
        document.querySelectorAll('.card-hover').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Loading animation
        window.addEventListener('load', function() {
            const elements = document.querySelectorAll('.floating-animation');
            elements.forEach((el, index) => {
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });
    </script>
</body>

</html>
