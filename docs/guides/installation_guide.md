# Panduan Instalasi dari Nol

Dokumen ini menjelaskan langkah-langkah komprehensif untuk menyiapkan lingkungan pengembangan pada sistem operasi Arch Linux hingga aplikasi De Roemah Makan siap dijalankan.

## 1. Persiapan Lingkungan Arch Linux

Pastikan sistem Anda diperbarui dan paket-paket dasar telah terinstal.

### Instalasi Paket Utama
Gunakan manajer paket `pacman` untuk menginstal dependensi yang diperlukan:

```bash
sudo pacman -S git php docker docker-compose composer nodejs npm
```

### Konfigurasi PHP (php.ini)
Aplikasi Laravel memerlukan beberapa ekstensi PHP aktif. Buka file konfigurasi menggunakan editor `nano`:

```bash
sudo nano /etc/php/php.ini
```

Cari dan hapus tanda titik koma (`;`) pada baris berikut untuk mengaktifkan ekstensi:
- `extension=intl`
- `extension=gd`
- `extension=pdo_mysql`
- `extension=zip`
- `extension=bcmath` (jika tersedia)

*Simpan perubahan dengan menekan `Ctrl + O`, lalu keluar dengan `Ctrl + X`.*

## 2. Konfigurasi Docker

Setelah Docker terinstal, aktifkan layanannya agar berjalan secara otomatis:

```bash
sudo systemctl enable --now docker
```

Agar dapat menjalankan Docker tanpa perintah `sudo`, masukkan pengguna Anda ke grup docker:

```bash
sudo usermod -aG docker $USER
```
*Lakukan logout dan login kembali agar perubahan grup berlaku.*

## 3. Instalasi Proyek

### Kloning Repositori
```bash
git clone https://github.com/FaizDADAR/de_roemah_makan.git
cd de_roemah_makan
```

### Konfigurasi Environment
Salin file template `.env` dan sesuaikan jika diperlukan:
```bash
cp .env.example .env
```

## 4. Inisialisasi Kontainer

Jalankan seluruh layanan menggunakan Docker Compose. Proses ini akan mengunduh image dan menyusun kontainer secara otomatis:

```bash
docker-compose up -d --build
```

## 5. Migrasi dan Seeding Data

Setelah kontainer aktif, jalankan migrasi database dan masukkan data awal (seed) ke dalam database di dalam kontainer:

```bash
docker exec de_roemah_makan_app php artisan migrate --seed
```

## 6. Akses Aplikasi

Aplikasi kini dapat diakses melalui alamat berikut:
- **Aplikasi Utama**: http://localhost:8000
- **Panel Admin**: http://localhost:8000/admin
- **Database Manager (phpMyAdmin)**: http://localhost:8081
