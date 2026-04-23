# Panduan Penggunaan & Operasional

## 1. Panel Admin (Filament)
Akses: `/admin`

### Manajemen Menu
- Masukkan nama, deskripsi, dan harga.
- Untuk gambar, cukup masukkan path seperti `/images/menu/nama-file.jpg`. Pastikan file gambar ada di folder `public/images/menu/`.

### Dashboard Stats
- **Total Pendapatan**: Dihitung dari pesanan dengan status 'selesai'.
- **Grafik Pesanan**: Memantau aktivitas pesanan harian.

### Export Laporan
- Masuk ke menu **Pesanan**.
- Klik tombol **Export Laporan (CSV)**. File ini dapat dibuka langsung di Excel untuk pembukuan.

## 2. Alur Checkout Pelanggan
1. Pelanggan memilih menu dan masuk ke halaman Checkout.
2. Pelanggan mengisi Nama, WhatsApp, dan Lokasi (mendukung Google Maps Geolocation).
3. Saat tombol **Order Sekarang** diklik:
   - Data dikirim ke server via AJAX untuk dicatat ke database.
   - Keranjang dikosongkan.
   - Pelanggan diarahkan ke WhatsApp Admin dengan format pesan otomatis yang mencantumkan **ID Pesanan**.

## 3. Manajemen Catering
- Jika muncul peringatan **"Bentrok"** di daftar catering, admin disarankan menghubungi salah satu pelanggan untuk negosiasi jam atau penyesuaian porsi.
