@extends('layouts.app')

@section('title', 'Status Pesanan - De Roemah Makan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Status Pesanan & Catering</h1>
        <p class="text-sm text-gray-500 mt-1">Masukkan nomor HP untuk melihat status</p>
    </div>

    {{-- Search --}}
    <form action="{{ route('status.search') }}" method="POST" class="flex gap-2 mb-6">
        @csrf
        <div class="flex-1 relative">
            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="tel" name="phone" placeholder="Masukkan nomor HP..." value="{{ $phone ?? '' }}" class="input-field pl-9" required>
        </div>
        <button type="submit" class="px-5 py-2.5 rounded-xl font-semibold text-white text-sm transition hover:opacity-90" style="background: #8B5E3C;">
            Cari
        </button>
    </form>

    @if(isset($phone))
        @if((!isset($orders) || $orders->isEmpty()) && (!isset($caterings) || $caterings->isEmpty()))
            <div class="flex flex-col items-center py-16 gap-3 text-gray-400">
                <svg class="w-10 h-10 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="font-medium">Tidak ada data ditemukan</p>
                <p class="text-sm">Nomor HP <strong>{{ $phone }}</strong> belum memiliki pesanan atau catering</p>
            </div>
        @endif

        {{-- Orders --}}
        @if(isset($orders) && $orders->isNotEmpty())
            <section class="mb-6">
                <h2 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                    <svg class="w-[18px] h-[18px]" style="color: #8B5E3C;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Pesanan ({{ $orders->count() }})
                </h2>
                <div class="flex flex-col gap-3">
                    @foreach($orders as $order)
                        @php
                            $statusColors = [
                                'pending' => ['bg' => '#fef9c3', 'text' => '#854d0e', 'label' => 'Pending'],
                                'diproses' => ['bg' => '#dbeafe', 'text' => '#1d4ed8', 'label' => 'Diproses'],
                                'selesai' => ['bg' => '#dcfce7', 'text' => '#16a34a', 'label' => 'Selesai'],
                            ];
                            $s = $statusColors[$order->status] ?? $statusColors['pending'];
                        @endphp
                        <div class="bg-white rounded-2xl p-5 shadow-sm" style="border: 1px solid #F0E8DF;">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $order->customer_name }}</p>
                                    <p class="text-xs text-gray-400 font-mono mt-0.5">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                                </div>
                                <span class="badge-status" style="background: {{ $s['bg'] }}; color: {{ $s['text'] }};">{{ $s['label'] }}</span>
                            </div>
                            <div class="flex flex-col gap-1.5 mb-3">
                                @foreach($order->items as $item)
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">{{ $item->name }} × {{ $item->qty }}</span>
                                        <span class="text-gray-700 font-medium">{{ $item->formatted_subtotal }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t" style="border-color: #F0E8DF;">
                                <span class="text-sm text-gray-500">Total</span>
                                <span class="font-bold" style="color: #8B5E3C;">{{ $order->formatted_total }}</span>
                            </div>
                            @if($order->note)
                                <p class="text-xs text-gray-400 mt-2 italic">Catatan: {{ $order->note }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Caterings --}}
        @if(isset($caterings) && $caterings->isNotEmpty())
            <section>
                <h2 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                    <svg class="w-[18px] h-[18px]" style="color: #8B5E3C;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Catering ({{ $caterings->count() }})
                </h2>
                <div class="flex flex-col gap-3">
                    @foreach($caterings as $catering)
                        @php
                            $statusColors = [
                                'pending' => ['bg' => '#fef9c3', 'text' => '#854d0e', 'label' => 'Pending'],
                                'dikonfirmasi' => ['bg' => '#dcfce7', 'text' => '#16a34a', 'label' => 'Dikonfirmasi'],
                            ];
                            $s = $statusColors[$catering->status] ?? $statusColors['pending'];
                        @endphp
                        <div class="bg-white rounded-2xl p-5 shadow-sm" style="border: 1px solid #F0E8DF;">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $catering->customer_name }}</p>
                                    <p class="text-xs text-gray-400 font-mono mt-0.5">#{{ str_pad($catering->id, 6, '0', STR_PAD_LEFT) }}</p>
                                </div>
                                <span class="badge-status" style="background: {{ $s['bg'] }}; color: {{ $s['text'] }};">{{ $s['label'] }}</span>
                            </div>
                            <div class="grid grid-cols-3 gap-3">
                                <div class="flex flex-col gap-0.5">
                                    <span class="text-xs text-gray-400 flex items-center gap-1">📅 Tanggal</span>
                                    <span class="text-sm font-medium text-gray-700">{{ $catering->date->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <span class="text-xs text-gray-400 flex items-center gap-1">🕐 Jam</span>
                                    <span class="text-sm font-medium text-gray-700">{{ $catering->time }}</span>
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <span class="text-xs text-gray-400 flex items-center gap-1">👥 Orang</span>
                                    <span class="text-sm font-medium text-gray-700">{{ $catering->people }} orang</span>
                                </div>
                            </div>
                            @if($catering->note)
                                <p class="text-xs text-gray-400 mt-3 italic">Catatan: {{ $catering->note }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    @endif
</div>
@endsection
