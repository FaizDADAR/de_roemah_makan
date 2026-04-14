@extends('layouts.app')

@section('title', 'Daftar Menu - De Roemah Makan')

@section('content')
<div class="flex flex-col gap-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Daftar Menu</h1>
        <p class="text-sm text-gray-500 mt-1">
            {{ $items->count() }} menu ditemukan
            @if(request('category') && request('category') !== 'semua')
                di kategori "{{ request('category') }}"
            @endif
        </p>
    </div>

    @if($items->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-gray-400">
            <span class="text-5xl mb-4">🍽️</span>
            <p class="font-medium">Menu tidak ditemukan</p>
            <p class="text-sm mt-1">Coba ubah filter atau kata kunci pencarian</p>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($items as $item)
                @include('components.food-card', ['item' => $item])
            @endforeach
        </div>
    @endif
</div>
@endsection
