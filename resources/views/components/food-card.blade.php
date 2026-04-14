{{-- FoodCard Component --}}
{{-- Usage: @include('components.food-card', ['item' => $menuItem]) --}}
<div class="food-card group">
    {{-- Image / Placeholder --}}
    <div class="relative h-40 overflow-hidden flex-shrink-0 flex items-center justify-center" style="background: linear-gradient(135deg, #F5E6D3, #EDD5BC);">
        @if($item->image_url)
            <img src="{{ $item->image_url }}" alt="{{ $item->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 onerror="this.parentElement.innerHTML='<span class=\'text-5xl\'>🍽️</span>'">
        @else
            @php
                $emojis = [
                    'Hidangan Utama' => '🍛', 'Kue Kering' => '🍪', 'Kue Basah' => '🧁',
                    'Gorengan' => '🍟', 'Kerupuk' => '🥨', 'Minuman' => '🥤',
                ];
            @endphp
            <span class="text-5xl">{{ $emojis[$item->category] ?? '🍽️' }}</span>
        @endif
        {{-- Overlay gradient --}}
        <div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(to top, rgba(0,0,0,0.15) 0%, transparent 50%);"></div>

        {{-- Badges top-left --}}
        <div class="absolute top-2 left-2 flex flex-col gap-1">
            @if($item->is_best_seller)
                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full text-white shadow-sm" style="background: #C0392B;">🔥 Best Seller</span>
            @elseif($item->is_favorite)
                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full text-white shadow-sm" style="background: #e67e22;">❤️ Favorit</span>
            @endif
        </div>

        {{-- Status badge top-right --}}
        <div class="absolute top-2 right-2">
            @if($item->available)
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full shadow-sm" style="background: #dcfce7; color: #16a34a;">✓ Tersedia</span>
            @else
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full shadow-sm" style="background: rgba(0,0,0,0.5); color: #fff;">Habis</span>
            @endif
        </div>
    </div>

    {{-- Content --}}
    <div class="p-3.5 flex flex-col flex-1 gap-2">
        {{-- Category badge --}}
        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full self-start" style="background: #F5E6D3; color: #8B5E3C;">
            {{ $item->category }}
        </span>

        <h3 class="font-semibold text-gray-800 text-sm leading-snug">{{ $item->name }}</h3>
        <p class="text-xs text-gray-400 leading-relaxed flex-1 line-clamp-2">{{ $item->description }}</p>

        <div class="flex items-center justify-between mt-auto pt-2 border-t" style="border-color: #F5EDE5;">
            <span class="font-bold text-sm" style="color: #8B5E3C;">{{ $item->formatted_price }}</span>
            @if($item->available)
                <button onclick="addToCart({{ $item->id }})"
                        data-cart-btn="{{ $item->id }}"
                        class="flex items-center gap-1 px-2.5 py-1.5 rounded-xl text-xs font-semibold transition-all"
                        style="background: linear-gradient(135deg, #8B5E3C, #A0522D); color: #fff; box-shadow: 0 2px 6px rgba(139,94,60,0.3);">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Keranjang
                </button>
            @else
                <span class="flex items-center gap-1 px-2.5 py-1.5 rounded-xl text-xs font-semibold" style="background: #f3f4f6; color: #9ca3af;">
                    Habis
                </span>
            @endif
        </div>
    </div>
</div>
