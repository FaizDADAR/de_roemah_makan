# Refactoring Notes: Booking to Catering

## Latar Belakang
Awalnya sistem menggunakan model `Booking`, namun dalam operasional De Roemah Makan, kebutuhan pelanggan lebih condong ke arah **Catering** (pesanan porsi besar untuk acara) daripada sekadar pemesanan meja.

## Perubahan yang Dilakukan
1. **Model & Migration**: Mengganti nama tabel `bookings` menjadi `caterings`.
2. **Labels**: Mengubah label "Jumlah Orang" menjadi "Jumlah Porsi" untuk lebih mencerminkan kebutuhan catering.
3. **Admin Resource**: Memperbarui `BookingResource` menjadi `CateringResource`.

## Fitur Tambahan (Reminder Logic)
- **Clash Detection**: Menambahkan deskripsi peringatan di tabel admin jika ada pesanan di tanggal yang sama.
  - *Rationale*: Membantu dapur menghindari kelebihan beban kerja (*overload*).
- **Near-Delivery Badge**: Badge notifikasi merah pada menu navigasi untuk pesanan yang akan diantar dalam 3 hari ke depan.
  - *Rationale*: Memastikan tim admin memiliki waktu persiapan (H-3).
