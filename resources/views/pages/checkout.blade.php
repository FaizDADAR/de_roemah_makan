@extends('layouts.app')

@section('title', 'Checkout - De Roemah Makan')

@section('content')
    <div class="max-w-2xl mx-auto">

        {{-- Success State --}}
        @if(session('success') && session('order'))
            @php $order = session('order'); @endphp
            <div class="flex flex-col items-center justify-center py-20 gap-4 text-center">
                <div class="w-20 h-20 rounded-full flex items-center justify-center" style="background: #dcfce7;">
                    <svg class="w-10 h-10" style="color: #16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Pesanan Berhasil!</h2>
                <p class="text-gray-500 text-sm">
                    Terima kasih, <strong>{{ $order->customer_name }}</strong>! Pesanan Anda sedang diproses.
                </p>
                <div class="px-4 py-2 rounded-xl text-sm font-mono" style="background: #F5E6D3; color: #8B5E3C;">
                    ID: #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                </div>
                <div class="flex gap-3 mt-2">
                    <a href="{{ route('status.index') }}"
                        class="px-5 py-2.5 rounded-xl border font-medium text-sm transition hover:bg-gray-50"
                        style="border-color: #ddd; color: #555;">
                        Cek Status
                    </a>
                    <a href="{{ route('menu') }}"
                        class="px-5 py-2.5 rounded-xl font-semibold text-white text-sm transition hover:opacity-90"
                        style="background: #8B5E3C;">
                        Pesan Lagi
                    </a>
                </div>
            </div>
        @else

            <div class="flex items-center gap-3 mb-6">
                <a href="{{ route('menu') }}" class="p-2 rounded-xl hover:bg-gray-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                        </path>
                    </svg>
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
                    <form id="checkout-form" class="flex flex-col gap-4">
                        @csrf
                        <div class="flex flex-col gap-1.5">
                            <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                                <svg class="w-4 h-4" style="color: #8B5E3C;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Nama Lengkap *
                            </label>
                            <input type="text" id="customer_name" placeholder="Masukkan nama Anda" class="input-field" required>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                                <svg class="w-4 h-4" style="color: #8B5E3C;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Lokasi / Alamat *
                            </label>
                            <textarea id="address" placeholder="Tuliskan alamat lengkap pengiriman" rows="2"
                                class="input-field resize-none" required></textarea>
                            <button type="button" onclick="getLocation()"
                                class="text-xs font-semibold mt-1 flex items-center gap-1 w-fit px-3 py-1.5 rounded-lg border transition hover:bg-gray-50 text-gray-500"
                                style="border-color: #ddd;">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Ambil Lokasi Saya
                            </button>
                            <p id="location-status" class="text-xs text-gray-500 hidden mt-1"></p>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                                <svg class="w-4 h-4" style="color: #8B5E3C;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Catatan (opsional)
                            </label>
                            <textarea id="note" placeholder="Catatan untuk dapur..." rows="2"
                                class="input-field resize-none"></textarea>
                        </div>
                        <button type="submit" class="btn-primary w-full mt-1" id="checkout-btn" disabled>
                            Order Sekarang
                        </button>
                    </form>
                </div>

                {{-- Order summary --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm h-fit" style="border: 1px solid #F0E8DF;">
                    <h2 class="font-bold text-gray-800 mb-4">Ringkasan Pesanan</h2>
                    <div id="checkout-summary" class="flex flex-col gap-3">
                        <p class="text-sm text-gray-400 text-center py-8">Memuat keranjang...</p>
                    </div>

                    <div class="mt-4 p-3 bg-blue-50 text-blue-800 rounded-xl text-xs flex gap-2">
                        <svg class="w-5 h-5 flex-shrink-0 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p>Harga pesanan akan dikonfirmasi lebih lanjut oleh pihak kami. Kami tidak mengirimkan harga ke pesan
                            WhatsApp demi menjaga keamanan transaksi.</p>
                    </div>
                </div>
            </div>

        @endif
    </div>

    @push('scripts')
        <script>
            // Ambil Geolocation
            function getLocation() {
                const status = document.getElementById('location-status');
                const addressInput = document.getElementById('address');

                if (!navigator.geolocation) {
                    status.textContent = 'Geolocation tidak didukung di browser Anda.';
                    status.classList.remove('hidden');
                    return;
                }

                status.textContent = 'Mencari lokasi...';
                status.classList.remove('hidden');

                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        // Add maps link to address input
                        const mapsLink = `https://www.google.com/maps?q=${lat},${lng}`;

                        if (addressInput.value) {
                            addressInput.value += `\nLokasi Maps: ${mapsLink}`;
                        } else {
                            addressInput.value = `Lokasi Maps: ${mapsLink}`;
                        }

                        status.textContent = 'Lokasi berhasil ditambahkan!';
                        status.classList.add('text-green-600');
                        setTimeout(() => { status.classList.add('hidden'); }, 3000);
                    },
                    () => {
                        status.textContent = 'Gagal mengakses GPS. Pastikan izin lokasi diaktifkan.';
                        status.classList.add('text-red-500');
                    }
                );
            }

            document.addEventListener('DOMContentLoaded', function () {
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
                                <span class="font-bold text-gray-800">Total Perkiraan</span>
                                <span class="font-bold text-lg" style="color: #8B5E3C;">${formatRupiah(cartData.totalPrice)}</span>
                            </div>`;
                        summary.innerHTML = html;
                        if (btn) btn.disabled = false;
                    }
                }

                // WhatsApp Checkout logic
                const form = document.getElementById('checkout-form');
                if (form) {
                    form.addEventListener('submit', async function (e) {
                        e.preventDefault();

                        if (cartData.cart.length === 0) {
                            showToast('Keranjang masih kosong', 'error');
                            return;
                        }

                        const name = document.getElementById('customer_name').value;
                        const address = document.getElementById('address').value;
                        const note = document.getElementById('note').value;

                        let itemsText = '';
                        cartData.cart.forEach(item => {
                            itemsText += `- ${item.name} x${item.qty}\n`;
                        });

                        let message = `Halo Admin De Roemah Makan,\n\nSaya ingin memesan:\n\n${itemsText}\nNama: ${name}\nLokasi: ${address}`;

                        if (note) {
                            message += `\nCatatan: ${note}`;
                        }

                        message += `\n\nMohon konfirmasi pesanan saya.\nTerima kasih.`;

                        // URL WA
                        const adminPhone = '6283172550797';
                        const waUrl = `https://wa.me/${adminPhone}?text=${encodeURIComponent(message)}`;

                        showToast('Pesanan berhasil dibuat! Mengalihkan ke WhatsApp...', 'success');

                        // Clear the cart on the server (simulating success creation)
                        try {
                            await fetch('/cart/clear', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                            });
                            cartData = { cart: [], totalItems: 0, totalPrice: 0 };
                            updateCartUI();
                        } catch (e) {
                            console.error('Failed clearing cart');
                        }

                        // Redirect ke WA
                        setTimeout(() => {
                            window.location.href = waUrl;
                        }, 1500);
                    });
                }

                // Override loadCart to also render summary
                const origLoadCart = loadCart;
                loadCart = async function () {
                    await origLoadCart();
                    renderCheckoutSummary();
                };
                loadCart();
            });
        </script>
    @endpush
@endsection