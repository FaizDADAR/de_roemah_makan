@extends('layouts.app')

@section('title', 'De Roemah Makan - Masakan Nusantara')

@section('content')
    <div class="flex flex-col gap-8">

        {{-- Banner Hero --}}
        <div class="animate-fade-in-up rounded-3xl p-8 md:p-12 relative overflow-hidden"
            style="background: linear-gradient(135deg, #8B5E3C 0%, #C0392B 100%);">
            <div class="relative z-10 max-w-lg">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold mb-4"
                    style="background: rgba(255,255,255,0.2); color: #fff;">
                    ⭐ Rumah Makan Terpercaya
                </div>
                <h1 class="text-2xl md:text-4xl font-bold text-white leading-tight mb-3">
                    Selamat Datang di<br>
                    <span style="color: #F5E6D3;">De Roemah Makan</span>
                </h1>
                <p class="text-white/80 text-sm md:text-base mb-6 leading-relaxed">
                    Nikmati aneka hidangan Nusantara, pesan mudah &amp; catering praktis
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('menu') }}"
                        class="px-6 py-3 rounded-xl font-semibold text-sm transition hover:opacity-90"
                        style="background: #fff; color: #8B5E3C;">
                        Pesan Sekarang
                    </a>
                    <a href="{{ route('catering.create') }}"
                        class="px-6 py-3 rounded-xl font-semibold text-sm transition border"
                        style="border-color: rgba(255,255,255,0.5); color: #fff;">
                        Pesan Catering
                    </a>
                </div>
            </div>
            {{-- Decorative circles --}}
            <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full opacity-10" style="background: #fff;"></div>
            <div class="absolute -right-8 -bottom-20 w-48 h-48 rounded-full opacity-10" style="background: #fff;"></div>
        </div>

        {{-- Info Strip --}}
        <div class="grid grid-cols-3 gap-3 animate-fade-in-up delay-100">
            @php
                $infoItems = [
                    ['icon' => '🕐', 'label' => 'Jam Buka', 'value' => '08.00 – 21.00'],
                    ['icon' => '📍', 'label' => 'Lokasi', 'value' => 'Kuala Tungkal. Jl. Kalimantan'],
                    ['icon' => '⭐', 'label' => 'Rating', 'value' => '4.8 / 5.0 ⭐'],
                ];
            @endphp
            @foreach($infoItems as $info)
                <div class="bg-white rounded-2xl p-4 flex flex-col items-center text-center gap-1 shadow-sm"
                    style="border: 1px solid #F0E8DF;">
                    <span style="color: #8B5E3C;" class="text-lg">{{ $info['icon'] }}</span>
                    <p class="text-xs text-gray-400">{{ $info['label'] }}</p>
                    <p class="text-xs font-semibold text-gray-700">{{ $info['value'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Menu Rekomendasi --}}
        <section class="animate-fade-in-up delay-200">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-800">Menu Rekomendasi</h2>
                <a href="{{ route('menu') }}" class="flex items-center gap-1 text-sm font-medium transition"
                    style="color: #8B5E3C;">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($recommended as $item)
                    @include('components.food-card', ['item' => $item])
                @empty
                    @for($i = 0; $i < 4; $i++)
                        <div class="bg-white rounded-2xl h-64 animate-pulse" style="border: 1px solid #F0E8DF;"></div>
                    @endfor
                @endforelse
            </div>
        </section>

        {{-- Menu Populer --}}
        <section class="animate-fade-in-up delay-300">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-800">Menu Populer</h2>
                <a href="{{ route('menu') }}" class="flex items-center gap-1 text-sm font-medium transition"
                    style="color: #8B5E3C;">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($popular as $item)
                    @include('components.food-card', ['item' => $item])
                @empty
                    @for($i = 0; $i < 4; $i++)
                        <div class="bg-white rounded-2xl h-64 animate-pulse" style="border: 1px solid #F0E8DF;"></div>
                    @endfor
                @endforelse
            </div>
        </section>
    </div>
@endsection