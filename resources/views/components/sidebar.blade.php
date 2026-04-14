{{-- Sidebar Component --}}
<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/40 md:hidden backdrop-blur-sm hidden" onclick="toggleSidebar()"></div>

<aside id="sidebar"
    class="fixed top-16 left-0 bottom-0 z-30 w-64 flex flex-col overflow-y-auto transition-transform duration-300 -translate-x-full md:translate-x-0"
    style="background: #fff; border-right: 1px solid #EDE8E3; box-shadow: 2px 0 12px rgba(0,0,0,0.04);">

    {{-- Header --}}
    <div class="px-4 py-3 flex items-center justify-between border-b" style="border-color: #EDE8E3;">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4" style="color: #8B5E3C;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            <span class="font-semibold text-sm" style="color: #8B5E3C;">Filter & Kategori</span>
        </div>
        <div class="flex items-center gap-1">
            @if(request()->hasAny(['category', 'search', 'available', 'price']))
                <a href="{{ route('menu') }}" class="text-xs px-2 py-0.5 rounded-full font-medium" style="background: #FEE2E2; color: #C0392B;">Reset</a>
            @endif
            <button onclick="toggleSidebar()" class="p-1 rounded-lg hover:bg-gray-100 md:hidden">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>

    <div class="p-4 flex flex-col gap-5 flex-1">
        {{-- Search --}}
        <form action="{{ route('menu') }}" method="GET" class="relative">
            @foreach(request()->except('search') as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" name="search" placeholder="Cari menu..." value="{{ request('search') }}"
                class="w-full pl-9 pr-3 py-2.5 rounded-xl border text-sm outline-none transition"
                style="border-color: #EDE8E3; background: #FAF8F6; color: #333;">
        </form>

        {{-- Kategori --}}
        <div>
            <p class="text-[10px] font-bold uppercase tracking-widest mb-2.5 px-1" style="color: #B8A090;">Kategori</p>
            <div class="flex flex-col gap-0.5">
                @php
                    $categories = [
                        ['id' => 'semua', 'label' => 'Semua Menu', 'emoji' => '🍽️'],
                        ['id' => 'Hidangan Utama', 'label' => 'Hidangan Utama', 'emoji' => '🍛'],
                        ['id' => 'Kue Kering', 'label' => 'Kue Kering', 'emoji' => '🍪'],
                        ['id' => 'Kue Basah', 'label' => 'Kue Basah', 'emoji' => '🧁'],
                        ['id' => 'Gorengan', 'label' => 'Gorengan', 'emoji' => '🍟'],
                        ['id' => 'Kerupuk', 'label' => 'Kerupuk', 'emoji' => '🥨'],
                        ['id' => 'Minuman', 'label' => 'Minuman', 'emoji' => '🥤'],
                    ];
                    $currentCategory = request('category', 'semua');
                @endphp
                @foreach($categories as $cat)
                    @php
                        $isActive = $currentCategory === $cat['id'] || ($cat['id'] === 'semua' && !request('category'));
                        $params = array_merge(request()->except('category'), $cat['id'] !== 'semua' ? ['category' => $cat['id']] : []);
                    @endphp
                    <a href="{{ route('menu', $params) }}"
                       class="sidebar-link {{ $isActive ? 'active' : '' }}"
                       @unless($isActive) style="color: #666;" @endunless>
                        <span class="text-base leading-none">{{ $cat['emoji'] }}</span>
                        <span class="flex-1 text-sm">{{ $cat['label'] }}</span>
                        @if($isActive)
                            <span class="w-1.5 h-1.5 rounded-full" style="background: #8B5E3C;"></span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>

        <div class="border-t" style="border-color: #EDE8E3;"></div>

        {{-- Ketersediaan --}}
        <div>
            <p class="text-[10px] font-bold uppercase tracking-widest mb-2.5 px-1" style="color: #B8A090;">Ketersediaan</p>
            <div class="flex flex-col gap-0.5">
                @php
                    $availOptions = [
                        ['id' => '', 'label' => 'Semua', 'dot' => '#B8A090'],
                        ['id' => 'true', 'label' => 'Tersedia', 'dot' => '#22c55e'],
                        ['id' => 'false', 'label' => 'Habis', 'dot' => '#d1d5db'],
                    ];
                @endphp
                @foreach($availOptions as $opt)
                    @php
                        $isActive = request('available') === $opt['id'] || ($opt['id'] === '' && !request('available'));
                        $params = array_merge(request()->except('available'), $opt['id'] !== '' ? ['available' => $opt['id']] : []);
                    @endphp
                    <a href="{{ route('menu', $params) }}"
                       class="sidebar-link {{ $isActive ? 'active' : '' }}"
                       @unless($isActive) style="color: #666;" @endunless>
                        <span class="w-2 h-2 rounded-full flex-shrink-0" style="background: {{ $opt['dot'] }};"></span>
                        {{ $opt['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="border-t" style="border-color: #EDE8E3;"></div>

        {{-- Harga --}}
        <div>
            <p class="text-[10px] font-bold uppercase tracking-widest mb-2.5 px-1" style="color: #B8A090;">Rentang Harga</p>
            <div class="flex flex-col gap-0.5">
                @php
                    $priceOptions = [
                        ['id' => '', 'label' => 'Semua Harga'],
                        ['id' => 'lt10', 'label' => '< Rp 10.000'],
                        ['id' => '10to20', 'label' => 'Rp 10.000 – 20.000'],
                        ['id' => 'gt20', 'label' => '> Rp 20.000'],
                    ];
                @endphp
                @foreach($priceOptions as $opt)
                    @php
                        $isActive = request('price') === $opt['id'] || ($opt['id'] === '' && !request('price'));
                        $params = array_merge(request()->except('price'), $opt['id'] !== '' ? ['price' => $opt['id']] : []);
                    @endphp
                    <a href="{{ route('menu', $params) }}"
                       class="sidebar-link {{ $isActive ? 'active' : '' }}"
                       @unless($isActive) style="color: #666;" @endunless>
                        {{ $opt['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="px-4 py-3 border-t text-center" style="border-color: #EDE8E3;">
        <p class="text-[10px] text-gray-400">De Roemah Makan © {{ date('Y') }}</p>
    </div>
</aside>
