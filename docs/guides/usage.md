# Panduan Operasional Sistem

Dokumen ini berisi instruksi penggunaan untuk panel administrasi dan pemahaman alur transaksi pelanggan pada aplikasi De Roemah Makan.

## Manajemen Panel Admin
Akses melalui alamat: `/admin`

### Pengelolaan Menu
- Unggah informasi produk meliputi nama, deskripsi, dan harga.
- Penggunaan gambar: Masukkan path gambar relatif terhadap folder publik (contoh: /images/menu/produk.jpg). Pastikan aset tersedia di direktori fisik server.

### Monitoring dan Statistik
- **Dashboard**: Menyajikan visualisasi pendapatan riil dan tren pesanan berdasarkan data yang tersimpan.
- **Laporan**: Fungsi ekspor tersedia pada menu Pesanan untuk menghasilkan dokumen CSV guna keperluan audit keuangan.

## Alur Transaksi Pelanggan
1. Pemilihan produk melalui katalog digital.
2. Proses checkout dengan pengisian data identitas dan koordinat lokasi.
3. Sinkronisasi data: Sistem akan melakukan persistensi data ke database secara otomatis sebelum dialihkan ke antarmuka WhatsApp.
4. Finalisasi: Pesan otomatis akan dikirimkan ke Admin dengan menyertakan ID Pesanan unik untuk validasi.

## Manajemen Catering
Admin wajib memantau indikator bentrok jadwal pada daftar catering. Sistem memberikan peringatan visual jika terdapat pesanan pada tanggal yang sama untuk memudahkan koordinasi logistik dapur.
