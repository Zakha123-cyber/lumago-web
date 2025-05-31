<!-- Enhanced Footer -->
<footer class="relative overflow-hidden bg-black py-16">
    <!-- Decorative grid pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="grid-pattern"></div>
    </div>

    <!-- Floating elements -->
    <div class="floating-element float-1 left-[5%] top-[20%]"></div>
    <div class="floating-element float-2 right-[10%] bottom-[30%]"></div>

    <!-- Main content -->
    <div class="container mx-auto px-6 relative z-10">
        <div class="grid md:grid-cols-4 gap-12">
            <!-- Brand Section -->
            <div class="text-reveal">
                <div class="text-3xl font-bold text-white mb-6 flex items-center">
                    <span class="gradient-text">Luma</span>
                    <span
                        class="bg-gradient-to-r from-green-400 to-green-600 text-white px-3 py-1 rounded-lg ml-1">GO!</span>
                </div>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Jelajahi keindahan alam Indonesia dengan mudah dan aman bersama LumaGO! Temukan pengalaman wisata
                    tak terlupakan.
                </p>
                <!-- Social Icons -->
                <div class="flex space-x-4">
                    <a href="#"
                        class="text-gray-400 hover:text-green-400 transition-all transform hover:-translate-y-1">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#"
                        class="text-gray-400 hover:text-green-400 transition-all transform hover:-translate-y-1">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#"
                        class="text-gray-400 hover:text-green-400 transition-all transform hover:-translate-y-1">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="text-reveal delay-1">
                <h3 class="text-white font-semibold mb-6 relative inline-block">
                    Contact Us
                    <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-green-400 to-transparent">
                    </div>
                </h3>
                <div class="space-y-4">
                    <a href="tel:+6285156747890"
                        class="flex items-center text-gray-400 hover:text-green-400 transition-all group">
                        <i class="fas fa-phone mr-3 group-hover:rotate-12 transition-transform"></i>
                        <span>+62 851 5674 7890</span>
                    </a>
                    <a href="mailto:LumaGO@gmail.com"
                        class="flex items-center text-gray-400 hover:text-green-400 transition-all group">
                        <i class="fas fa-envelope mr-3 group-hover:rotate-12 transition-transform"></i>
                        <span>LumaGO@gmail.com</span>
                    </a>
                    <div class="flex items-start text-gray-400">
                        <i class="fas fa-map-marker-alt mr-3 mt-1"></i>
                        <span>Jl. Raya Lumajang No. 123<br>Lumajang, Jawa Timur</span>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="text-reveal delay-2">
                <h3 class="text-white font-semibold mb-6 relative inline-block">
                    Quick Links
                    <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-green-400 to-transparent">
                    </div>
                </h3>
                <div class="space-y-3">
                    <a href="#"
                        class="block text-gray-400 hover:text-green-400 transition-all hover:translate-x-2 transform">
                        <i class="fas fa-chevron-right mr-2 text-sm"></i>Home
                    </a>
                    <a href="#"
                        class="block text-gray-400 hover:text-green-400 transition-all hover:translate-x-2 transform">
                        <i class="fas fa-chevron-right mr-2 text-sm"></i>Booking Wisata
                    </a>
                    <a href="#"
                        class="block text-gray-400 hover:text-green-400 transition-all hover:translate-x-2 transform">
                        <i class="fas fa-chevron-right mr-2 text-sm"></i>About Us
                    </a>
                    <a href="#"
                        class="block text-gray-400 hover:text-green-400 transition-all hover:translate-x-2 transform">
                        <i class="fas fa-chevron-right mr-2 text-sm"></i>Contact
                    </a>
                </div>
            </div>

            <!-- Newsletter Section -->
            <div class="text-reveal delay-3">
                <h3 class="text-white font-semibold mb-6 relative inline-block">
                    Newsletter
                    <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-green-400 to-transparent">
                    </div>
                </h3>
                <p class="text-gray-400 mb-4">Subscribe untuk mendapatkan info wisata terbaru</p>
                <form class="relative">
                    <input type="email" placeholder="Enter your email"
                        class="w-full bg-gray-800/50 text-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-green-400/50">
                    <button
                        class="absolute right-2 top-1/2 -translate-y-1/2 text-green-400 hover:text-green-300 transition-colors">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="mt-16 pt-8 border-t border-gray-800/50">
            <div class="text-center">
                <p class="text-gray-400">
                    ©2025 <span class="text-green-400">LumaGO!</span> Agency. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
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
    }

    @keyframes gridMove {
        0% {
            transform: translateY(-50%) rotate(45deg);
        }

        100% {
            transform: translateY(0%) rotate(45deg);
        }
    }

    .floating-element {
        position: absolute;
        border-radius: 50%;
        filter: blur(50px);
        opacity: 0.05;
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
</style>
