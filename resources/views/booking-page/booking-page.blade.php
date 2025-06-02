@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-900">
        <!-- Hero Section -->
        <div class="relative py-20 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 z-0">
                <div class="grid-pattern"></div>
            </div>

            <!-- Floating Elements -->
            <div class="floating-element float-1 left-[5%] top-[20%]"></div>
            <div class="floating-element float-2 right-[10%] bottom-[30%]"></div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="text-center mb-12 fade-up">
                    <span class="text-green-400 font-semibold text-sm tracking-widest uppercase block">EXPLORE</span>
                    <h1 class="text-4xl md:text-5xl font-bold text-white mt-4 mb-6">
                        Discover Amazing Places
                    </h1>
                    <p class="text-gray-400 max-w-2xl mx-auto">
                        Find and book your next adventure in Lumajang's most beautiful destinations
                    </p>
                </div>

                <!-- Search Section -->
                <div class="max-w-3xl mx-auto mb-16 fade-up">
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-4 border border-white/10">
                        <div class="flex flex-wrap gap-4">
                            <div class="flex-1 min-w-[200px]">
                                <input type="text" placeholder="Search destinations..."
                                    class="w-full bg-white/10 text-white rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-400/50">
                            </div>
                            <div class="flex-none">
                                <button
                                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition-all duration-300 flex items-center gap-2">
                                    <i class="fas fa-search"></i>
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Destinations Grid -->
        <div class="container mx-auto px-6 pb-20">
            <!-- Filters -->
            <div class="flex flex-wrap items-center justify-between mb-8 fade-up">
                <h2 class="text-2xl font-bold text-white mb-4 md:mb-0">Popular Destinations</h2>
                <div class="flex gap-4">
                    <button
                        class="px-4 py-2 rounded-lg bg-green-500/10 text-green-400 hover:bg-green-500/20 transition-all">
                        All
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-white/5 text-gray-400 hover:bg-white/10 transition-all">
                        Waterfalls
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-white/5 text-gray-400 hover:bg-white/10 transition-all">
                        Mountains
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-white/5 text-gray-400 hover:bg-white/10 transition-all">
                        Beaches
                    </button>
                </div>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @for ($i = 0; $i < 9; $i++)
                    <div class="fade-up" style="animation-delay: {{ $i * 0.1 }}s">
                        <x-booking-card />
                    </div>
                @endfor
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12 fade-up">
                <button
                    class="bg-white/5 hover:bg-white/10 text-white px-8 py-3 rounded-lg transition-all duration-300 flex items-center gap-2 mx-auto">
                    <span>Load More</span>
                    <i class="fas fa-arrow-down"></i>
                </button>
            </div>
        </div>
    </div>

    @push('styles')
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

            .fade-up {
                opacity: 0;
                transform: translateY(20px);
                animation: fadeUp 0.6s ease-out forwards;
            }

            @keyframes gridMove {
                0% {
                    transform: translateY(-50%) rotate(45deg);
                }

                100% {
                    transform: translateY(0%) rotate(45deg);
                }
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

            @keyframes fadeUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    @endpush
@endsection
