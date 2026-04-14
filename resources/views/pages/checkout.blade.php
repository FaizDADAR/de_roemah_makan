@extends('layouts.app')

@section('title', 'Checkout - De Roemah Makan')

@section('content')
<div class="max-w-2xl mx-auto">

    {{-- Success State --}}
    @if(session('success') && session('order'))
        @php $order = session('order'); @endphp
        <div class="flex flex-col items-center justify-center py-20 gap-4 text-center">
            <div class="w-20 h-20 rounded-full flex items-center justify-center" style="background: #dcfce7;">
                <svg class="w-10 h-10" style="color: #16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Pesanan Berhasil!</h2>
            <p class="text-gray-500 text-sm">
                Terima kasih, <strong>{{ $order->customer_name }}</strong>! Pesanan Anda sedang diproses.
            </p>
            <div class="px-4 py-2 rounded-xl text-sm font-mono" style="background: #F5E6D3; color: #8B5E3C;">
                ID: #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
            </div>
            <div class="flex gap-3 mt-2">
                <a href="{{ route('status.index') }}" class="px-5 py-2.5 rounded-xl border font-medium text-sm transition hover:bg-gray-50" style="border-color: #ddd; color: #555;">
                    Cek Status
                </a>
                <a href="{{ route('menu') }}" class="px-5 py-2.5 rounded-xl font-semibold text-white text-sm transition hover:opacity-90" style="background: #8B5E3C;">
                    Pesan Lagi
                </a>
            </div>
        </div>
    @else

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('menu') }}" class="p-2 rounded-xl hover:bg-gray-100 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Checkout</h1>
            <p class="text-sm text-gray-500">Lengkapi data pesanan Anda</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        {{-- Form --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm" style="border: 1px solid #F0E8DF;">
            <h2 class="font-bold text-gray-800 mb-4">Data Pemesan</h2>
            <form action="{{ route('checkout.store') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <div class="flex flex-col gap-1.5">
                    <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                        <svg class="w-4 h-4" style="color: #8B5E3C;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Nama Lengkap *
                    </label>
                    <input type="text" name="customer_name" placeholder="Masukkan nama Anda" value="{{ old('customer_name') }}" class="input-field" required>
                    @error('customer_name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                        <svg class="w-4 h-4" style="color: #8B5E3C;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        Nomor HP *
                    </label>
                    <input type="tel" name="phone" placeholder="Contoh: 08123456789" value="{{ old('phone') }}" class="input-field" required>
                    @error('phone') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                        <svg class="w-4 h-4" style="color: #8B5E3C;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Catatan (opsional)
                    </label>
                    <textarea name="note" placeholder="Catatan untuk dapur..." rows="3" class="input-field resize-none">{{ old('note') }}</textarea>
                </div>
                <button type="submit" class="btn-primary w-full mt-1" id="checkout-btn">
                    Pesan Sekarang
                </button>
            </form>
        </div>

        {{-- Order summary --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm h-fit" style="border: 1px solid #F0E8DF;">
            <h2 class="font-bold text-gray-800 mb-4">Ringkasan Pesanan</h2>
            <div id="checkout-summary" class="flex flex-col gap-3">
                <p class="text-sm text-gray-400 text-center py-8">Memuat keranjang...</p>
            </div>
        </div>
    </div>

    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Render order summary from cart data
    function renderCheckoutSummary() {
        const summary = document.getElementById('checkout-summary');
        const btn = document.getElementById('checkout-btn');
        if (!summary) return;

        if (cartData.cart.length === 0) {
            summary.innerHTML = '<p class="text-sm text-gray-400 text-center py-8">Keranjang kosong</p>';
            if (btn) btn.disabled = true;
        } else {
            let html = '';
            cartData.cart.forEach(item => {
                html += `
                    <div class="flex justify-between items-start gap-2">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-700 truncate">${item.name}</p>
                            <p class="text-xs text-gray-400">${formatRupiah(item.price)} × ${item.qty}</p>
                        </div>
                        <span class="text-sm font-semibold text-gray-700 whitespace-nowrap">${formatRupiah(item.price * item.qty)}</span>
                    </div>`;
            });
            html += `
                <div class="border-t pt-3 mt-1 flex justify-between items-center" style="border-color: #F0E8DF;">
                    <span class="font-bold text-gray-800">Total</span>
                    <span class="font-bold text-lg" style="color: #8B5E3C;">${formatRupiah(cartData.totalPrice)}</span>
                </div>`;
            summary.innerHTML = html;
            if (btn) btn.disabled = false;
        }
    }

    // Override loadCart to also render summary
    const origLoadCart = loadCart;
    loadCart = async function() {
        await origLoadCart();
        renderCheckoutSummary();
    };
    loadCart();
});
</script>
@endpush
@endsection
