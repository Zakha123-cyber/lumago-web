@props(['title', 'lokasi', 'image', 'url' => '#', 'isActive' => false])

@php
    $cardClasses = $isActive
        ? 'w-72 h-96 shadow-xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.3)] scale-110 z-10'
        : 'w-52 h-72 shadow-md hover:scale-105';
@endphp

<div onclick="window.location.href='{{ $url }}'"
    class="destination-card relative flex-shrink-0 bg-white/10 rounded-xl overflow-hidden transition-all duration-300 mx-2 transform {{ $cardClasses }} cursor-pointer">
    {{-- Background Image with Zoom Effect --}}
    <div class="w-full h-full overflow-hidden">
        <img src="{{ $image }}" alt="{{ $title }}"
            class="w-full h-full object-cover rounded-xl transition-transform duration-700 group-hover:scale-110"
            loading="lazy">
    </div>

    {{-- Enhanced Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

    {{-- Content Container --}}
    <div class="absolute bottom-0 left-0 w-full p-6 text-white transform transition-all duration-300">
        {{-- Location Badge --}}
        <div class="inline-flex items-center bg-white/20 backdrop-blur-sm px-3 py-1.5 rounded-full mb-3">
            <i class="fas fa-map-marker-alt text-green-400 mr-2"></i>
            <span class="text-xs font-medium">{{ \Illuminate\Support\Str::limit($lokasi, 32) }}</span>
        </div>

        {{-- Title with Enhanced Typography --}}
        <h3 class="font-bold {{ $isActive ? 'text-2xl' : 'text-xl' }} mb-2 leading-tight">
            {{ $title }}
        </h3>

        {{-- Decorative Line --}}
        <div class="w-12 h-1 bg-green-400 rounded-full opacity-75"></div>
    </div>

    {{-- Hover Effect Overlay --}}
    <div
        class="absolute inset-0 bg-black/20 opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
        <div
            class="transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
            <span class="bg-green-500/90 text-white px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm">
                Lihat Detail
            </span>
        </div>
    </div>
</div>
