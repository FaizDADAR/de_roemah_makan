# Panduan Instalasi Sistem Komprehensif (Arch Linux)

Dokumen ini menyajikan instruksi teknis mendalam untuk melakukan setup lingkungan pengembangan dari sistem operasi Arch Linux yang masih murni (*fresh install*) hingga aplikasi De Roemah Makan siap dioperasikan.

## 1. Persiapan Sistem Dasar

Pada sistem Arch Linux yang baru terpasang, beberapa paket fundamental harus diinstal untuk memfasilitasi manajemen paket dan repositori.

### Pembaruan Database Paket
```bash
#jika belum tersambung ke internet  (nmcli device wifi connect "SSID_WIFI" password "PASSWORD_WIFI")
sudo pacman -Syu
```

### Instalasi Paket Dasar & Networking
Aplikasi memerlukan peralatan jaringan dan kontrol versi untuk mengelola dependensi:
```bash
sudo pacman -S base-devel git wget curl
```

## 2. Konfigurasi Lingkungan Runtime (PHP & Composer)

Aplikasi dibangun menggunakan framework Laravel yang memiliki ketergantungan ketat pada versi PHP dan ekstensi tertentu.

### Instalasi PHP dan Ekstensi
```bash
sudo pacman -S php php-gd php-intl php-imagick php-sqlite php-zip composer
```

### Konfigurasi Lanjutan php.ini
Laravel dan Filament (Admin Panel) memerlukan beberapa modul aktif. Buka konfigurasi menggunakan editor teks:
```bash
sudo nano /etc/php/php.ini
```
Hapus tanda komentar (`;`) pada baris-baris berikut:
- `extension=bcmath` (Perhitungan presisi tinggi)
- `extension=calendar`
- `extension=exif` (Manajemen metadata gambar)
- `extension=gd` (Pemrosesan gambar menu)
- `extension=gettext`
- `extension=iconv`
- `extension=intl` (Internasionalisasi)
- `extension=mysqli`
- `extension=pdo_mysql` (Koneksi database utama)
- `extension=sockets`
- `extension=zip` (Kompresi file)

*Catatan: Pastikan `memory_limit` diset minimal ke `512M` untuk menghindari kegagalan saat menjalankan Composer.*

## 3. Ekosistem Frontend (Node.js)

Untuk melakukan kompilasi aset CSS (Tailwind) dan JavaScript (Vite), diperlukan runtime Node.js.

```bash
sudo pacman -S nodejs npm
```

## 4. Infrastruktur Kontainerisasi (Docker)

Seluruh database dan layanan pendukung (phpMyAdmin) dijalankan di dalam kontainer untuk menjaga isolasi sistem host.

### Instalasi Docker Engine
```bash
sudo pacman -S docker docker-compose
```

### Aktivasi dan Hak Akses
Jalankan daemon Docker dan konfigurasikan agar berjalan otomatis saat boot:
```bash
sudo systemctl enable --now docker
```

Tambahkan pengguna aktif ke dalam grup `docker` agar instruksi dapat dijalankan tanpa hak akses root:
```bash
sudo usermod -aG docker $USER
```
*Penting: Anda harus melakukan logout dan login kembali agar perubahan grup ini diakui oleh sistem.*

## 5. Setup Lingkungan Kerja (Opsional namun Disarankan)

Untuk kenyamanan pengembangan, instalasi browser dan editor teks sangat disarankan:
```bash
sudo pacman -S firefox visual-studio-code-bin
```
*(Catatan: Visual Studio Code mungkin memerlukan akses ke AUR atau menggunakan versi open-source `code`).*

## 6. Instalasi dan Deployment Aplikasi

### Kloning Proyek & Identitas Git
Konfigurasikan identitas Git Anda terlebih dahulu:
```bash
git config --global user.name "Nama Anda" #contoh "wongireng"
git config --global user.email "email@anda.com" #contoh "wongirengfiral@gmail.com"

git clone https://github.com/FaizDADAR/de_roemah_makan.git
cd de_roemah_makan
```

### Inisialisasi Environment
```bash
cp .env.example .env
```

### Deployment Kontainer
Proses ini akan mengunduh image MySQL dan phpMyAdmin serta membangun image aplikasi:
```bash
docker-compose up -d --build
```

### Finalisasi Database
Jalankan migrasi tabel dan seeding data awal ke dalam kontainer database:
```bash
docker exec de_roemah_makan_app php artisan migrate --seed
```

## 7. Verifikasi Operasional

Sistem dapat diakses melalui endpoint berikut:
- **Web Interface**: `http://localhost:8000`
- **Admin Dashboard**: `http://localhost:8000/admin`
- **Database Administration**: `http://localhost:8081`

### Troubleshooting Port
Jika port `8000` telah digunakan oleh proses lain, Docker akan mencoba melakukan mapping ke port lain (misalnya `8001`). Selalu periksa status kontainer melalui:
```bash
docker ps
```
