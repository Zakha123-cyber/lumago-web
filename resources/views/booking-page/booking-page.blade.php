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

            <div class="container relative z-10 px-6 mx-auto">
                <div class="mb-12 text-center fade-up">
                    <span class="block text-sm font-semibold tracking-widest text-green-400 uppercase">EXPLORE</span>
                    <h1 class="mt-4 mb-6 text-4xl font-bold text-white md:text-5xl">
                        Discover Amazing Places
                    </h1>
                    <p class="max-w-2xl mx-auto text-gray-400">
                        Find and book your next adventure in Lumajang's most beautiful destinations
                    </p>
                </div>

                <!-- Search Section -->
                <div class="max-w-3xl mx-auto mb-16 fade-up">
                    <form action="{{ route('wisata.index') }}" method="GET"
                        class="p-4 border bg-white/5 backdrop-blur-lg rounded-2xl border-white/10">
                        <div class="flex flex-wrap gap-4">
                            <div class="flex-1 min-w-[200px]">
                                <input type="text" name="search" placeholder="Search destinations..."
                                    value="{{ request('search') }}"
                                    class="w-full px-4 py-3 text-white rounded-lg bg-white/10 focus:outline-none focus:ring-2 focus:ring-green-400/50">
                            </div>
                            <div class="flex-none">
                                <button type="submit"
                                    class="flex items-center gap-2 px-6 py-3 text-white transition-all duration-300 bg-green-500 rounded-lg hover:bg-green-600">
                                    <i class="fas fa-search"></i>
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Destinations Grid -->
        <div class="container px-6 pb-20 mx-auto">
            <!-- Filters -->
            <div class="flex flex-wrap items-center justify-between mb-8 fade-up">
                <h2 class="text-2xl font-bold text-white mb-7 md:mb-0">
                    {{ request('kategori') ?? 'Popular' }} Destinations
                </h2>
                <div class="flex gap-4 pb-2 mt-4 overflow-x-auto">
                    <a href="{{ route('wisata.index') }}"
                        class="px-4 py-2 rounded-lg {{ !request('kategori') ? 'bg-green-500/10 text-green-400' : 'bg-white/5 text-gray-400' }} hover:bg-green-500/20 transition-all whitespace-nowrap">
                        All
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('wisata.index', ['kategori' => $category->nama_kategori]) }}"
                            class="px-4 py-2 rounded-lg {{ request('kategori') == $category->nama_kategori ? 'bg-green-500/10 text-green-400' : 'bg-white/5 text-gray-400' }} hover:bg-green-500/20 transition-all whitespace-nowrap">
                            {{ $category->nama_kategori }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($wisata as $index => $item)
                    <div class="fade-up" style="animation-delay: {{ $index * 0.1 }}s">
                        <x-booking-card :wisata="$item" />
                    </div>
                @empty
                    <div class="col-span-3 py-12 text-center text-gray-400">
                        <i class="mb-4 text-4xl fas fa-search"></i>
                        <p class="text-lg">No destinations found</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($wisata->hasPages())
                <div class="mt-12 fade-up">
                    {{ $wisata->links() }}
                </div>
            @endif
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
