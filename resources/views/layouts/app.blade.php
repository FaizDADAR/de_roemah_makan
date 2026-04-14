<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="De Roemah Makan - Restoran masakan Nusantara dengan aneka hidangan lezat. Pesan online dan booking meja dengan mudah.">
    <title>@yield('title', 'De Roemah Makan - Masakan Nusantara')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brown: {
                            50: '#FBF7F4',
                            100: '#F5E6D3',
                            200: '#EDD5BC',
                            300: '#DDB896',
                            400: '#C4A882',
                            500: '#A0522D',
                            600: '#8B5E3C',
                            700: '#6B3F1F',
                            800: '#4A2C15',
                            900: '#2D1A0E',
                        },
                        cream: '#F4F6F9',
                        accent: '#C0392B',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
        .input-field {
            @apply w-full px-3 py-2.5 rounded-xl border text-sm outline-none transition-all;
            border-color: #EDE8E3;
            background: #FAF8F6;
        }
        .input-field:focus {
            border-color: #8B5E3C;
            box-shadow: 0 0 0 3px rgba(139, 94, 60, 0.1);
        }
        .sidebar-link {
            @apply flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm font-medium transition-all text-left;
        }
        .sidebar-link.active {
            background: linear-gradient(135deg, #F5E6D3, #EDD5BC);
            color: #8B5E3C;
            box-shadow: 0 1px 4px rgba(139, 94, 60, 0.12);
        }
        .food-card {
            @apply bg-white rounded-2xl overflow-hidden flex flex-col;
            border: 1px solid #EDE8E3;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .food-card:hover {
            box-shadow: 0 8px 24px rgba(139, 94, 60, 0.12);
            transform: translateY(-2px);
        }
        .btn-primary {
            @apply px-6 py-3 rounded-xl font-semibold text-sm text-white transition;
            background: linear-gradient(135deg, #8B5E3C, #A0522D);
            box-shadow: 0 4px 12px rgba(139, 94, 60, 0.3);
        }
        .btn-primary:hover { opacity: 0.9; }
        .btn-primary:disabled { opacity: 0.6; cursor: not-allowed; }
        .badge-status {
            @apply text-xs font-semibold px-3 py-1 rounded-full;
        }
        /* Cart drawer animation */
        .cart-overlay { transition: opacity 0.3s; }
        .cart-drawer { transition: transform 0.3s; }
        /* Scrollbar styling */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #DDB896; border-radius: 3px; }
        /* Toast notification */
        .toast {
            @apply fixed top-20 right-4 z-[100] px-4 py-3 rounded-xl text-sm font-medium shadow-lg;
            animation: slideIn 0.3s ease, fadeOut 0.3s ease 2.7s forwards;
        }
        .toast-success { background: #dcfce7; color: #16a34a; border: 1px solid #bbf7d0; }
        .toast-error { background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes fadeOut { to { opacity: 0; transform: translateX(100%); } }
    </style>
</head>
<body class="min-h-screen flex flex-col" style="background: #F4F6F9;">
    {{-- Toast Notifications --}}
    @if(session('success'))
    <div class="toast toast-success" id="toast">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="toast toast-error" id="toast">✕ {{ session('error') }}</div>
    @endif

    {{-- Navbar --}}
    @include('components.navbar')

    <div class="flex flex-1 pt-16">
        {{-- Sidebar --}}
        @include('components.sidebar')

        {{-- Main Content --}}
        <main class="flex-1 min-w-0 p-4 md:p-6 md:ml-64">
            @yield('content')
        </main>
    </div>

    {{-- Cart Drawer --}}
    @include('components.cart-drawer')

    {{-- Global JavaScript --}}
    <script>
        // CSRF setup for AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Format ke Rupiah
        function formatRupiah(n) {
            return 'Rp ' + n.toLocaleString('id-ID');
        }

        // Toast auto-remove
        const toast = document.getElementById('toast');
        if (toast) setTimeout(() => toast.remove(), 3000);

        // Cart state
        let cartData = { cart: [], totalItems: 0, totalPrice: 0 };

        // Load cart on page load
        async function loadCart() {
            try {
                const res = await fetch('/cart', { headers: { 'Accept': 'application/json' } });
                cartData = await res.json();
                updateCartUI();
            } catch (e) { console.error('Failed to load cart', e); }
        }

        // Add to cart
        async function addToCart(menuItemId) {
            try {
                const res = await fetch('/cart/add', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    body: JSON.stringify({ menu_item_id: menuItemId })
                });
                const data = await res.json();
                cartData = data;
                updateCartUI();
                showToast(data.message, 'success');
            } catch (e) { showToast('Gagal menambahkan item', 'error'); }
        }

        // Update cart qty
        async function updateCartQty(menuItemId, delta) {
            try {
                const res = await fetch('/cart/update', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    body: JSON.stringify({ menu_item_id: menuItemId, delta: delta })
                });
                cartData = await res.json();
                updateCartUI();
            } catch (e) { showToast('Gagal update item', 'error'); }
        }

        // Remove from cart
        async function removeFromCart(menuItemId) {
            try {
                const res = await fetch('/cart/remove', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    body: JSON.stringify({ menu_item_id: menuItemId })
                });
                cartData = await res.json();
                updateCartUI();
            } catch (e) { showToast('Gagal hapus item', 'error'); }
        }

        // Clear cart
        async function clearCart() {
            try {
                const res = await fetch('/cart/clear', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                });
                cartData = await res.json();
                updateCartUI();
            } catch (e) { showToast('Gagal mengosongkan keranjang', 'error'); }
        }

        // Toggle cart drawer
        function toggleCart() {
            const overlay = document.getElementById('cart-overlay');
            const drawer = document.getElementById('cart-drawer');
            const isOpen = !drawer.classList.contains('translate-x-full');
            if (isOpen) {
                drawer.classList.add('translate-x-full');
                overlay.classList.add('hidden');
            } else {
                drawer.classList.remove('translate-x-full');
                overlay.classList.remove('hidden');
            }
        }

        // Update cart badge & drawer content
        function updateCartUI() {
            // Badge
            const badge = document.getElementById('cart-badge');
            if (badge) {
                badge.textContent = cartData.totalItems > 9 ? '9+' : cartData.totalItems;
                badge.style.display = cartData.totalItems > 0 ? 'flex' : 'none';
            }

            // Update add-to-cart button states
            document.querySelectorAll('[data-cart-btn]').forEach(btn => {
                const id = parseInt(btn.dataset.cartBtn);
                const inCart = cartData.cart.some(item => item.id === id);
                if (inCart) {
                    btn.innerHTML = `<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Ditambah`;
                    btn.style.background = '#dcfce7';
                    btn.style.color = '#16a34a';
                    btn.style.boxShadow = 'none';
                } else {
                    btn.innerHTML = `<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Keranjang`;
                    btn.style.background = 'linear-gradient(135deg, #8B5E3C, #A0522D)';
                    btn.style.color = '#fff';
                    btn.style.boxShadow = '0 2px 6px rgba(139,94,60,0.3)';
                }
            });

            // Drawer content
            const drawerItems = document.getElementById('cart-items');
            const drawerFooter = document.getElementById('cart-footer');
            const drawerCount = document.getElementById('cart-count');

            if (drawerCount) drawerCount.textContent = cartData.totalItems + ' item';

            if (drawerItems) {
                if (cartData.cart.length === 0) {
                    drawerItems.innerHTML = `
                        <div class="flex flex-col items-center justify-center h-full gap-4 text-gray-400">
                            <div class="w-20 h-20 rounded-2xl flex items-center justify-center" style="background: #F5E6D3;">
                                <svg class="w-9 h-9" style="color: #C4A882;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <div class="text-center">
                                <p class="font-semibold text-gray-600 text-sm">Keranjang kosong</p>
                                <p class="text-xs text-gray-400 mt-1">Tambahkan menu favoritmu!</p>
                            </div>
                        </div>`;
                } else {
                    drawerItems.innerHTML = cartData.cart.map(item => `
                        <div class="flex gap-3 p-3 rounded-2xl" style="background: #FAF8F6; border: 1px solid #EDE8E3;">
                            <img src="${item.image_url}" alt="${item.name}" class="w-16 h-16 rounded-xl object-cover flex-shrink-0"
                                onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&q=80'">
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-sm text-gray-800 truncate">${item.name}</p>
                                <p class="text-xs mt-0.5 font-medium" style="color: #8B5E3C;">${formatRupiah(item.price)}</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <button onclick="updateCartQty(${item.id}, -1)" class="w-6 h-6 rounded-lg flex items-center justify-center border transition hover:bg-gray-100" style="border-color: #ddd;">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                    </button>
                                    <span class="text-sm font-bold w-5 text-center text-gray-800">${item.qty}</span>
                                    <button onclick="updateCartQty(${item.id}, 1)" class="w-6 h-6 rounded-lg flex items-center justify-center text-white transition" style="background: #8B5E3C;">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </button>
                                    <div class="flex-1"></div>
                                    <button onclick="removeFromCart(${item.id})" class="p-1.5 rounded-lg hover:bg-red-50 transition" style="color: #C0392B;">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `).join('');
                }
            }

            if (drawerFooter) {
                drawerFooter.style.display = cartData.cart.length > 0 ? 'flex' : 'none';
                const footerTotal = document.getElementById('cart-total');
                const footerSubtotal = document.getElementById('cart-subtotal');
                const footerItemCount = document.getElementById('cart-item-count');
                if (footerTotal) footerTotal.textContent = formatRupiah(cartData.totalPrice);
                if (footerSubtotal) footerSubtotal.textContent = formatRupiah(cartData.totalPrice);
                if (footerItemCount) footerItemCount.textContent = `Subtotal (${cartData.totalItems} item)`;
            }
        }

        // Show toast
        function showToast(message, type = 'success') {
            const existing = document.querySelector('.toast');
            if (existing) existing.remove();
            const div = document.createElement('div');
            div.className = `toast toast-${type}`;
            div.textContent = (type === 'success' ? '✓ ' : '✕ ') + message;
            document.body.appendChild(div);
            setTimeout(() => div.remove(), 3000);
        }

        // Mobile sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', loadCart);
    </script>

    @stack('scripts')
</body>
</html>
