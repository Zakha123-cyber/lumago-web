@php
    $cardClasses = $isActive
        ? 'w-72 h-80 shadow-xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.3)] scale-110 z-10'
        : 'w-52 h-64 shadow-md hover:scale-105';
@endphp

<div class="destination-card relative flex-shrink-0 bg-white rounded-xl overflow-hidden transition-all duration-300 mx-2 transform {{ $cardClasses }}"
    data-title="{{ $title }}" data-subtitle="{{ $subtitle ?? '' }}" data-url="{{ $url ?? '' }}">

    {{-- Background Image --}}
    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover" loading="lazy">

    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-t {{ $isActive ? 'from-black/60' : 'from-black/70' }} to-transparent">
    </div>

    {{-- Active Badge --}}
    @if ($isActive)
        <div class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
            Active
        </div>
    @endif

    {{-- Content --}}
    <div class="absolute bottom-0 left-0 {{ $isActive ? 'p-6' : 'p-4' }} text-white w-full">
        <h3 class="font-bold {{ $isActive ? 'text-2xl' : 'text-xl' }} mb-1">
            {{ $title }}
        </h3>

        @if ($isActive && $subtitle)
            <p class="text-sm opacity-90 mt-1">{{ $subtitle }}</p>
        @endif
    </div>

    {{-- Link Wrapper --}}
    @if ($url)
        <a href="{{ $url }}" class="absolute inset-0 z-20" aria-label="Explore {{ $title }}"></a>
    @endif
</div>
