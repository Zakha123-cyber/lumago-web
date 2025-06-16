@extends('layouts.superadmin')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide img {
            width: 100%;
            height: 480px;
            object-fit: cover;
            border-radius: 0.75rem;
            background: #222;
        }

        @media (max-width: 768px) {
            .swiper-slide img {
                height: 260px;
            }
        }

        /* Custom arrow style */
        .swiper-button-next,
        .swiper-button-prev {
            color: #22c55e !important;
            background: rgba(30, 41, 59, 0.7);
            border: 2px solid #22c55e;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.18);
            width: 48px !important;
            height: 48px !important;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            transition: background 0.2s, box-shadow 0.2s, border 0.2s, color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #22c55e;
            color: #fff !important;
            border-color: #fff;
            box-shadow: 0 4px 16px rgba(34, 197, 94, 0.25);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            display: none;
        }

        .custom-arrow {
            width: 24px;
            height: 24px;
            display: block;
        }

        .swiper-pagination-bullet {
            background: #fff !important;
            opacity: 0.5;
        }

        .swiper-pagination-bullet-active {
            opacity: 1;
        }

        .thumbnail-swiper .swiper-slide {
            opacity: 0.5;
            border: 2px solid transparent;
            border-radius: 0.5rem;
            transition: all 0.2s;
            cursor: pointer;
            margin-right: 12px;
        }

        .thumbnail-swiper .swiper-slide-thumb-active {
            opacity: 1;
            border-color: #22c55e;
        }

        .thumbnail-swiper img {
            height: 70px;
            object-fit: cover;
            border-radius: 0.5rem;
            background: #222;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-5xl px-4 mx-auto space-y-10">
        {{-- Header --}}
        <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">{{ $wisata->nama }}</h2>
                <p class="mt-1 text-lg text-gray-400">{{ $wisata->lokasi }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('superadmin.wisata.edit', $wisata->id) }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-500 rounded-lg hover:bg-blue-600">
                    <i class="mr-2 fa-solid fa-edit"></i>
                    Edit Wisata
                </a>
                <a href="{{ route('superadmin.wisata.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 transition-colors rounded-lg hover:text-white hover:bg-white/10">
                    <i class="mr-2 fa-solid fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Tombol Tambah Kategori & Gambar Wisata --}}
        <div class="flex flex-wrap gap-3 mb-6">
            <button onclick="document.getElementById('modalGambar').showModal()"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-green-500 rounded-lg hover:bg-green-600">
                <i class="mr-2 fa-solid fa-image"></i> Tambah Gambar Wisata
            </button>
        </div>

        {{-- Modal Tambah Gambar Wisata --}}
        <dialog id="modalGambar" class="w-full max-w-md p-0 bg-gray-800 border rounded-xl border-white/10">
            <form method="POST" action="{{ route('superadmin.gambar-wisata.store') }}" enctype="multipart/form-data"
                class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="wisata_id" value="{{ $wisata->id }}">
                <h3 class="mb-2 text-lg font-bold text-white">Tambah Gambar Wisata</h3>
                <input type="file" name="gambar[]" multiple required
                    class="w-full text-gray-900 bg-white border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-green-500 file:text-white hover:file:bg-green-600" />
                @error('gambar')
                    <p class="text-sm text-red-400">{{ $message }}</p>
                @enderror
                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" onclick="document.getElementById('modalGambar').close()"
                        class="px-4 py-2 text-sm text-white bg-gray-600 rounded-lg hover:bg-gray-700">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-green-500 rounded-lg hover:bg-green-600">Upload</button>
                </div>
            </form>
        </dialog>

        {{-- Carousel --}}
        @if ($wisata->gambarWisata->count() > 0)
            <div class="p-4 mb-8 border rounded-xl bg-gray-800/50 border-white/10">
                <div class="relative mb-4 overflow-hidden swiper main-swiper rounded-xl">
                    <div class="swiper-wrapper">
                        @foreach ($wisata->gambarWisata as $gambar)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/' . $gambar->path_gambar) }}" alt="{{ $wisata->nama }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next">
                        <span class="custom-arrow">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </div>
                    <div class="swiper-button-prev">
                        <span class="custom-arrow">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="mt-2 swiper thumbnail-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($wisata->gambarWisata as $gambar)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/' . $gambar->path_gambar) }}" alt="Thumbnail">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Info Grid --}}
        <div class="grid gap-8 mb-8 md:grid-cols-2">
            <div class="space-y-8">
                <div class="p-6 border rounded-xl bg-gray-800/50 border-white/10">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-white">Informasi Tiket</h3>
                        <span class="px-3 py-1 text-sm text-green-400 rounded-full bg-green-400/10">
                            {{ $wisata->kategori->nama }}
                        </span>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-400">Harga Tiket</h4>
                            <p class="mt-1 text-xl font-bold text-white">
                                Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}
                            </p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-400">Jam Operasional</h4>
                            <p class="mt-1 text-white">{{ $wisata->jam_operasional }}</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 border rounded-xl bg-gray-800/50 border-white/10">
                    <h3 class="mb-4 text-lg font-medium text-white">Statistik</h3>
                    <div class="space-y-4">
                        <div class="p-4 rounded-lg bg-white/5">
                            <h4 class="text-sm font-medium text-gray-400">Total Pengunjung</h4>
                            <p class="mt-1 text-xl font-bold text-white">
                                {{ $wisata->transaksi->sum('jumlah_tiket') ?? 0 }}
                                <span class="text-sm font-normal text-gray-400">orang</span>
                            </p>
                        </div>
                        <div class="p-4 rounded-lg bg-white/5">
                            <h4 class="text-sm font-medium text-gray-400">Total Transaksi</h4>
                            <p class="mt-1 text-xl font-bold text-white">
                                {{ $wisata->transaksi->count() ?? 0 }}
                                <span class="text-sm font-normal text-gray-400">transaksi</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-8">
                <div class="p-6 border rounded-xl bg-gray-800/50 border-white/10">
                    <h3 class="mb-4 text-lg font-medium text-white">Admin Pengelola</h3>
                    <div class="flex items-center gap-4">
                        <div
                            class="flex items-center justify-center w-12 h-12 text-xl font-bold text-white bg-green-500 rounded-full">
                            {{ strtoupper(substr($wisata->admin->name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="font-medium text-white break-words">{{ $wisata->admin->name }}</h4>
                            <p class="text-sm text-gray-400 break-words">{{ $wisata->admin->email }}</p>
                            <p class="text-sm text-gray-400 break-words">{{ $wisata->admin->phone }}</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 border rounded-xl bg-gray-800/50 border-white/10">
                    <h3 class="mb-4 text-lg font-medium text-white">Lokasi</h3>
                    <div>
                        <h4 class="text-sm font-medium text-gray-400">Alamat Lengkap</h4>
                        <p class="mt-1 text-white break-words">{{ $wisata->lokasi }}</p>
                    </div>
                    <a href="{{ $wisata->link_maps }}" target="_blank"
                        class="flex items-center justify-center w-full gap-2 px-4 py-2 mt-4 text-sm font-medium text-white transition-colors bg-green-500 rounded-lg hover:bg-green-600">
                        <i class="fa-solid fa-location-dot"></i>
                        Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6 mb-8 border rounded-xl bg-gray-800/50 border-white/10">
            <h3 class="mb-4 text-lg font-medium text-white">Deskripsi</h3>
            <p class="leading-relaxed text-gray-300 break-words">{{ $wisata->deskripsi }}</p>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            const thumbnailSwiper = new Swiper(".thumbnail-swiper", {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesProgress: true,
                breakpoints: {
                    0: {
                        slidesPerView: 3
                    },
                    640: {
                        slidesPerView: 4
                    }
                }
            });

            const mainSwiper = new Swiper(".main-swiper", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                thumbs: {
                    swiper: thumbnailSwiper,
                },
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                },
            });
        </script>
    @endpush
@endsection
