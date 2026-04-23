@extends('layouts.app')

@section('title', 'Pesan Catering - De Roemah Makan')

@section('content')
<div class="max-w-4xl mx-auto pb-20" x-data="cateringForm()">

    {{-- Success State --}}
    @if(session('success') && session('catering'))
        @php $catering = session('catering'); @endphp
        <div class="flex flex-col items-center justify-center py-20 gap-4 text-center">
            <div class="w-20 h-20 rounded-full flex items-center justify-center animate-bounce" style="background: #dcfce7;">
                <svg class="w-10 h-10" style="color: #16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Pesanan Terkirim!</h2>
            <p class="text-gray-500 text-sm max-w-sm">
                Terima kasih, <strong>{{ $catering->customer_name }}</strong>! Kami telah mencatat pesanan catering Anda.
            </p>
            <a href="{{ route('catering.create') }}" class="mt-2 px-6 py-3 rounded-xl font-semibold text-white transition hover:scale-105" style="background: #8B5E3C;">
                Pesan Lagi
            </a>
        </div>
    @else

    <div class="mb-8 text-center md:text-left">
        <h1 class="text-3xl font-bold text-gray-800">Layanan Catering</h1>
        <p class="text-sm text-gray-500 mt-1">Pilih menu favorit Anda untuk acara istimewa</p>
    </div>

    <form action="{{ route('catering.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf

        {{-- Left: Menu Selection --}}
        <div class="lg:col-span-2 space-y-6">
            <h3 class="font-bold text-gray-700 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.746 18 18.168 18.477 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                Pilih Menu
            </h3>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($menuItems as $item)
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-100 flex flex-col gap-2 transition-all hover:shadow-md cursor-pointer"
                     @click="openKeypad({{ $item->id }}, '{{ $item->name }}', {{ $item->price }})">
                    <div class="aspect-square rounded-xl overflow-hidden bg-gray-50 relative">
                        <img src="{{ asset($item->image_url) }}" class="w-full h-full object-cover">
                        <template x-if="getItemQty({{ $item->id }}) > 0">
                            <div class="absolute top-2 right-2 bg-brown-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold" style="background: #8B5E3C;">
                                <span x-text="getItemQty({{ $item->id }})"></span>
                            </div>
                        </template>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-800 truncate">{{ $item->name }}</h4>
                        <p class="text-[10px] text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                    <button type="button" class="text-[10px] py-1.5 rounded-lg font-bold transition"
                            :class="getItemQty({{ $item->id }}) > 0 ? 'bg-brown-50 text-brown-700' : 'bg-gray-100 text-gray-600'"
                            style="color: #8B5E3C;">
                        <span x-text="getItemQty({{ $item->id }}) > 0 ? 'Edit Jumlah' : 'Tambah'"></span>
                    </button>
                    
                    {{-- Hidden Inputs for Form --}}
                    <template x-if="getItemQty({{ $item->id }}) > 0">
                        <input type="hidden" :name="'items['+{{ $item->id }}+'][id]'" value="{{ $item->id }}">
                    </template>
                    <template x-if="getItemQty({{ $item->id }}) > 0">
                        <input type="hidden" :name="'items['+{{ $item->id }}+'][qty]'" :value="getItemQty({{ $item->id }})">
                    </template>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Right: Customer Details --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl p-6 shadow-xl sticky top-24 border border-gray-100">
                <h3 class="font-bold text-gray-800 mb-6">Detail Pemesanan</h3>
                
                <div class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Nama</label>
                        <input type="text" name="customer_name" required class="w-full bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-brown-500" placeholder="Nama Anda">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">WhatsApp</label>
                        <input type="tel" name="phone" required class="w-full bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-brown-500" placeholder="08xxx">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-1">
                            <label class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Tanggal</label>
                            <input type="date" name="date" required min="{{ date('Y-m-d') }}" class="w-full bg-gray-50 border-none rounded-xl text-xs focus:ring-2 focus:ring-brown-500">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Jam</label>
                            <input type="time" name="time" required class="w-full bg-gray-50 border-none rounded-xl text-xs focus:ring-2 focus:ring-brown-500">
                        </div>
                    </div>
                    <input type="hidden" name="people" value="1"> {{-- Default value for backward compatibility --}}
                    <div class="space-y-1">
                        <label class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">Catatan</label>
                        <textarea name="note" rows="2" class="w-full bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-brown-500" placeholder="Alamat atau instruksi..."></textarea>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-dashed border-gray-200">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-500 text-sm">Total Item</span>
                        <span class="font-bold text-gray-800" x-text="totalItems">0</span>
                    </div>
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-gray-500 text-sm">Estimasi Total</span>
                        <span class="font-bold text-lg" style="color: #8B5E3C;">Rp <span x-text="formatPrice(totalPrice)">0</span></span>
                    </div>
                    <button type="submit" class="w-full py-4 rounded-2xl font-bold text-white shadow-lg transition transform hover:scale-105 active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                            style="background: #8B5E3C;" :disabled="totalItems == 0">
                        Konfirmasi Catering
                    </button>
                </div>
            </div>
        </div>
    </form>

    {{-- Keypad Modal --}}
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] flex items-end md:items-center justify-center p-4"
         x-show="keypadVisible" x-transition.opacity style="display: none;">
        <div class="bg-white w-full max-w-sm rounded-[2rem] overflow-hidden shadow-2xl"
             @click.away="keypadVisible = false">
            <div class="p-6 text-center border-b border-gray-50">
                <h3 class="text-gray-400 text-[10px] uppercase font-bold tracking-widest mb-1" x-text="currentItemName">Menu</h3>
                <div class="text-4xl font-black" style="color: #8B5E3C;" x-text="currentQty">0</div>
                <p class="text-gray-400 text-xs mt-1">Masukkan Jumlah Porsi</p>
            </div>
            
            <div class="p-6 grid grid-cols-3 gap-3">
                <template x-for="n in ['1','2','3','4','5','6','7','8','9']">
                    <button type="button" @click="pressKey(n)" class="h-16 rounded-2xl bg-gray-50 text-xl font-bold text-gray-700 active:bg-gray-200 transition-colors" x-text="n"></button>
                </template>
                <button type="button" @click="pressKey('minus')" class="h-16 rounded-2xl bg-red-50 text-red-500 text-2xl font-bold active:bg-red-100">-</button>
                <button type="button" @click="pressKey('0')" class="h-16 rounded-2xl bg-gray-50 text-xl font-bold text-gray-700 active:bg-gray-200">0</button>
                <button type="button" @click="confirmQty()" class="h-16 rounded-2xl text-white text-sm font-bold active:opacity-90 transition-opacity" style="background: #16a34a;">ENTER</button>
            </div>
            
            <button type="button" @click="keypadVisible = false" class="w-full py-4 text-gray-400 text-xs font-bold hover:bg-gray-50">BATAL</button>
        </div>
    </div>

    @endif
</div>

<script>
function cateringForm() {
    return {
        keypadVisible: false,
        currentItemId: null,
        currentItemName: '',
        currentItemPrice: 0,
        currentQty: '0',
        items: [], // [{id, qty, price}]
        
        openKeypad(id, name, price) {
            this.currentItemId = id;
            this.currentItemName = name;
            this.currentItemPrice = price;
            const existing = this.items.find(i => i.id === id);
            this.currentQty = existing ? existing.qty.toString() : '0';
            this.keypadVisible = true;
        },
        
        pressKey(key) {
            if (key === 'minus') {
                if (this.currentQty !== '0') {
                    let val = parseInt(this.currentQty) - 1;
                    this.currentQty = val.toString();
                }
                return;
            }
            
            if (this.currentQty === '0') {
                this.currentQty = key;
            } else {
                if (this.currentQty.length < 3) { // Max 999
                    this.currentQty += key;
                }
            }
        },
        
        confirmQty() {
            const qty = parseInt(this.currentQty);
            const index = this.items.findIndex(i => i.id === this.currentItemId);
            
            if (qty > 0) {
                if (index !== -1) {
                    this.items[index].qty = qty;
                } else {
                    this.items.push({
                        id: this.currentItemId,
                        qty: qty,
                        price: this.currentItemPrice
                    });
                }
            } else if (index !== -1) {
                this.items.splice(index, 1);
            }
            
            this.keypadVisible = false;
        },
        
        getItemQty(id) {
            const item = this.items.find(i => i.id === id);
            return item ? item.qty : 0;
        },
        
        get totalItems() {
            return this.items.reduce((sum, item) => sum + item.qty, 0);
        },
        
        get totalPrice() {
            return this.items.reduce((sum, item) => sum + (item.qty * item.price), 0);
        },
        
        formatPrice(price) {
            return new Intl.NumberFormat('id-ID').format(price);
        }
    }
}
</script>

<style>
[x-cloak] { display: none !important; }
</style>
@endsection
