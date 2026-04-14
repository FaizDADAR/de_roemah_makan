@extends('layouts.app')

@section('title', 'Booking Meja - De Roemah Makan')

@section('content')
<div class="max-w-lg mx-auto">

    {{-- Success State --}}
    @if(session('success') && session('booking'))
        @php $booking = session('booking'); @endphp
        <div class="flex flex-col items-center justify-center py-20 gap-4 text-center">
            <div class="w-20 h-20 rounded-full flex items-center justify-center" style="background: #dcfce7;">
                <svg class="w-10 h-10" style="color: #16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Booking Berhasil!</h2>
            <p class="text-gray-500 text-sm">
                Terima kasih, <strong>{{ $booking->customer_name }}</strong>! Booking Anda sedang diproses.
                Kami akan menghubungi Anda di nomor <strong>{{ $booking->phone }}</strong> untuk konfirmasi.
            </p>
            <a href="{{ route('booking.create') }}" class="mt-2 px-6 py-3 rounded-xl font-semibold text-white transition hover:opacity-90" style="background: #8B5E3C;">
                Booking Lagi
            </a>
        </div>
    @else

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Booking Meja</h1>
        <p class="text-sm text-gray-500 mt-1">Reservasi tempat duduk untuk kenyamanan Anda</p>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm" style="border: 1px solid #F0E8DF;">
        <form action="{{ route('booking.store') }}" method="POST" class="flex flex-col gap-4">
            @csrf

            {{-- Nama --}}
            <div class="flex flex-col gap-1.5">
                <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                    <svg class="w-4 h-4" style="color: #8B5E3C;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Nama Lengkap *
                </label>
                <input type="text" name="customer_name" placeholder="Masukkan nama Anda" value="{{ old('customer_name') }}" class="input-field" required>
                @error('customer_name') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Phone --}}
            <div class="flex flex-col gap-1.5">
                <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                    <svg class="w-4 h-4" style="color: #8B5E3C;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    Nomor HP *
                </label>
                <input type="tel" name="phone" placeholder="Contoh: 08123456789" value="{{ old('phone') }}" class="input-field" required>
                @error('phone') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Jumlah Orang --}}
            <div class="flex flex-col gap-1.5">
                <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                    <svg class="w-4 h-4" style="color: #8B5E3C;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Jumlah Orang *
                </label>
                <select name="people" class="input-field" required>
                    <option value="">Pilih jumlah orang</option>
                    @for($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ old('people') == $i ? 'selected' : '' }}>{{ $i }} orang</option>
                    @endfor
                </select>
                @error('people') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Tanggal & Jam --}}
            <div class="grid grid-cols-2 gap-3">
                <div class="flex flex-col gap-1.5">
                    <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                        <svg class="w-4 h-4" style="color: #8B5E3C;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Tanggal *
                    </label>
                    <input type="date" name="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}" class="input-field" required>
                    @error('date') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                        <svg class="w-4 h-4" style="color: #8B5E3C;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Jam *
                    </label>
                    <input type="time" name="time" value="{{ old('time') }}" class="input-field" required>
                    @error('time') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Catatan --}}
            <div class="flex flex-col gap-1.5">
                <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700">
                    <svg class="w-4 h-4" style="color: #8B5E3C;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Catatan (opsional)
                </label>
                <textarea name="note" placeholder="Permintaan khusus, alergi makanan, dll." rows="3" class="input-field resize-none">{{ old('note') }}</textarea>
            </div>

            <button type="submit" class="btn-primary w-full mt-2">
                Booking Sekarang
            </button>
        </form>
    </div>

    {{-- Info --}}
    <div class="mt-4 p-4 rounded-2xl text-sm" style="background: #FBF7F4; border: 1px solid #F0E8DF;">
        <p class="font-semibold mb-1" style="color: #8B5E3C;">ℹ️ Informasi Booking</p>
        <ul class="text-gray-500 space-y-1 text-xs">
            <li>• Konfirmasi akan dikirim via WhatsApp</li>
            <li>• Booking berlaku 15 menit setelah jam yang ditentukan</li>
            <li>• Jam buka: 08.00 – 21.00 WIB</li>
        </ul>
    </div>

    @endif
</div>
@endsection
