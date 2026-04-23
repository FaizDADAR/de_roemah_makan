# Panduan Instalasi Sistem

Dokumen ini merupakan standar operasional prosedur untuk melakukan instalasi dan konfigurasi sistem De Roemah Makan pada lingkungan baru.

## 1. Prasyarat Sistem

Sebelum memulai proses instalasi, pastikan sistem operasi berbasis Arch Linux telah terpasang dan memiliki akses internet untuk pengunduhan dependensi.

### Instalasi Dependensi Dasar
Lakukan instalasi paket-paket yang diperlukan melalui manajer paket sistem:

```bash
sudo pacman -S git php docker docker-compose composer nodejs npm
```

## 2. Konfigurasi Runtime PHP

Sistem memerlukan beberapa modul PHP tertentu agar dapat beroperasi secara optimal. Modul-modul ini harus diaktifkan melalui file konfigurasi pusat.

### Langkah Aktivasi Ekstensi
1. Buka file konfigurasi menggunakan editor teks:
   ```bash
   sudo nano /etc/php/php.ini
   ```
2. Pastikan baris-baris berikut telah diaktifkan (tanpa tanda `;` di awal baris):
   - `extension=intl`
   - `extension=gd`
   - `extension=pdo_mysql`
   - `extension=zip`
   - `extension=bcmath`

## 3. Konfigurasi Infrastruktur Docker

Infrastruktur berbasis kontainer digunakan untuk menjaga konsistensi lingkungan pengembangan dan produksi.

### Aktivasi Layanan
Aktifkan dan jalankan layanan Docker:
```bash
sudo systemctl enable --now docker
```

### Manajemen Izin Akses
Berikan izin kepada pengguna sistem untuk menjalankan instruksi Docker tanpa memerlukan hak akses root:
```bash
sudo usermod -aG docker $USER
```
*Sesi pengguna harus diperbarui (logout/login) agar perubahan hak akses dapat diterapkan.*

## 4. Inisialisasi Aplikasi

### Akuisisi Kode Sumber
Gunakan Git untuk melakukan kloning repositori ke direktori lokal:
```bash
git clone https://github.com/FaizDADAR/de_roemah_makan.git
cd de_roemah_makan
```

### Manajemen Environment
Inisialisasi file konfigurasi lingkungan dari template yang tersedia:
```bash
cp .env.example .env
```

## 5. Orkerstrasi Layanan

Gunakan Docker Compose untuk menginisialisasi dan menjalankan seluruh ekosistem aplikasi (Backend, Database, dan Database Manager).

```bash
docker-compose up -d --build
```

## 6. Finalisasi Database

Setelah seluruh kontainer beroperasi secara stabil, lakukan pembaruan skema database dan inisialisasi data awal:

```bash
docker exec de_roemah_makan_app php artisan migrate --seed
```

## 7. Verifikasi Akses

Aksesibilitas sistem dapat diverifikasi melalui alamat berikut:
- **Interface Pengguna**: http://localhost:8000
- **Panel Administrasi**: http://localhost:8000/admin
- **Manajemen Database**: http://localhost:8081
