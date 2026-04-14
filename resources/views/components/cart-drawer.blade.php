{{-- Cart Drawer Component --}}
<div id="cart-overlay" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm hidden cart-overlay" onclick="toggleCart()"></div>

<div id="cart-drawer" class="fixed top-0 right-0 bottom-0 z-50 w-full max-w-sm flex flex-col translate-x-full cart-drawer"
    style="background: #fff; box-shadow: -8px 0 32px rgba(0,0,0,0.12);">

    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color: #EDE8E3;">
        <div class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: #F5E6D3;">
                <svg class="w-[18px] h-[18px]" style="color: #8B5E3C;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div>
                <span class="font-bold text-gray-800 text-sm block">Keranjang</span>
                <span id="cart-count" class="text-xs text-gray-400">0 item</span>
            </div>
        </div>
        <button onclick="toggleCart()" class="p-2 rounded-xl hover:bg-gray-100 transition text-gray-500">
            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    {{-- Items --}}
    <div id="cart-items" class="flex-1 overflow-y-auto p-4 flex flex-col gap-3">
        <div class="flex flex-col items-center justify-center h-full gap-4 text-gray-400">
            <div class="w-20 h-20 rounded-2xl flex items-center justify-center" style="background: #F5E6D3;">
                <svg class="w-9 h-9" style="color: #C4A882;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div class="text-center">
                <p class="font-semibold text-gray-600 text-sm">Keranjang kosong</p>
                <p class="text-xs text-gray-400 mt-1">Tambahkan menu favoritmu!</p>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div id="cart-footer" class="p-4 border-t flex-col gap-3" style="border-color: #EDE8E3; display: none;">
        <div class="flex flex-col gap-1.5">
            <div class="flex justify-between text-xs text-gray-500">
                <span id="cart-item-count">Subtotal (0 item)</span>
                <span id="cart-subtotal">Rp 0</span>
            </div>
            <div class="flex justify-between text-xs text-gray-500">
                <span>Biaya layanan</span>
                <span class="text-green-600 font-medium">Gratis</span>
            </div>
        </div>
        <div class="flex justify-between items-center py-2.5 px-3 rounded-xl mt-2" style="background: #F5E6D3;">
            <span class="text-sm font-bold" style="color: #8B5E3C;">Total</span>
            <span id="cart-total" class="font-bold text-base" style="color: #8B5E3C;">Rp 0</span>
        </div>
        <div class="flex gap-2 mt-2">
            <button onclick="clearCart()" class="px-4 py-2.5 rounded-xl border text-sm font-medium transition hover:bg-gray-50 text-gray-500" style="border-color: #ddd;">
                Kosongkan
            </button>
            <a href="{{ route('checkout.create') }}" onclick="toggleCart()"
               class="flex-1 py-2.5 rounded-xl text-white text-sm font-semibold transition hover:opacity-90 flex items-center justify-center gap-2"
               style="background: linear-gradient(135deg, #8B5E3C, #A0522D); box-shadow: 0 4px 12px rgba(139,94,60,0.3);">
                Checkout
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>
</div>
