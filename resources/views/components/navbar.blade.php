{{-- Navbar Component --}}
<header class="fixed top-0 left-0 right-0 z-40 h-16 flex items-center justify-between px-4 md:px-6"
    style="background: linear-gradient(135deg, #6B3F1F 0%, #8B5E3C 60%, #A0522D 100%); box-shadow: 0 2px 16px rgba(139,94,60,0.18);">

    {{-- Left: hamburger + logo --}}
    <div class="flex items-center gap-3">
        <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-xl text-white/80 hover:text-white hover:bg-white/15 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center shadow-sm" style="background: rgba(255,255,255,0.18);">
                <svg class="w-[18px] h-[18px] text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <div class="hidden sm:block">
                <span class="font-bold text-white text-base tracking-tight leading-none block">De Roemah Makan</span>
                <span class="text-white/60 text-[10px] leading-none">Masakan Nusantara</span>
            </div>
            <span class="font-bold text-white text-base tracking-tight sm:hidden">DRM</span>
        </a>
    </div>

    {{-- Center: nav links --}}
    <nav class="hidden md:flex items-center gap-0.5">
        @php
            $navLinks = [
                ['label' => 'Beranda', 'route' => 'home'],
                ['label' => 'Menu', 'route' => 'menu'],
                ['label' => 'Catering', 'route' => 'catering.create'],
                ['label' => 'Status Pesanan', 'route' => 'status.index'],
            ];
        @endphp
        @foreach($navLinks as $link)
            <a href="{{ route($link['route']) }}"
               class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ request()->routeIs($link['route']) ? 'bg-white/20 text-white shadow-sm' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                {{ $link['label'] }}
            </a>
        @endforeach
    </nav>

    {{-- Right: icons --}}
    <div class="flex items-center gap-1.5">
        <button onclick="toggleCart()" class="p-2 rounded-xl text-white/70 hover:text-white hover:bg-white/15 transition relative">
            <svg class="w-[19px] h-[19px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"></path></svg>
            <span id="cart-badge" class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] rounded-full text-[10px] font-bold items-center justify-center text-white px-1" style="background: #C0392B; display: none;">0</span>
        </button>
        <div class="flex items-center gap-2 ml-1 pl-2 border-l border-white/20">
            <div class="w-8 h-8 rounded-xl flex items-center justify-center text-sm font-bold shadow-sm" style="background: rgba(255,255,255,0.2); color: #fff;">
                T
            </div>
        </div>
    </div>
</header>
