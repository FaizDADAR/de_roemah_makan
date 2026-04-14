# De Roemah Makan - Website Restoran

Website restoran **De Roemah Makan** yang dibangun menggunakan **Laravel 13** + **Filament Admin Panel v5**.

## 📋 Deskripsi

Website ini merupakan projectfull PHP menggunakan Laravel Framework. Website menyediakan fitur menu makanan, keranjang belanja, checkout pesanan, booking meja, dan panel admin untuk mengelola data.

## 🛠️ Teknologi

- **Framework**: Laravel 13
- **Admin Panel**: Filament v5
- **Database**: MySQL 8
- **Styling**: TailwindCSS v3 (CDN)
- **Font**: Inter (Google Fonts)

## 📁 Struktur Penting

```
app/
├── Filament/Resources/          # Resource admin (MenuItem, Order, Booking)
├── Http/Controllers/            # Controller frontend
│   ├── HomeController.php       # Halaman beranda
│   ├── MenuController.php       # Daftar menu + filter
│   ├── BookingController.php    # Form booking meja
│   ├── OrderController.php      # Checkout pesanan
│   ├── StatusController.php     # Cek status pesanan/booking
│   └── CartController.php       # API keranjang (AJAX)
└── Models/                      # Eloquent models
    ├── MenuItem.php
    ├── Order.php
    ├── OrderItem.php
    └── Booking.php

resources/views/
├── layouts/app.blade.php        # Layout utama
├── components/                  # Komponen Blade
│   ├── navbar.blade.php
│   ├── sidebar.blade.php
│   ├── food-card.blade.php
│   └── cart-drawer.blade.php
└── pages/                       # Halaman
    ├── home.blade.php
    ├── menu.blade.php
    ├── booking.blade.php
    ├── checkout.blade.php
    └── status.blade.php
```

## 🚀 Instalasi

### Prasyarat
- PHP 8.2+
- Composer
- MySQL 8+
- ext-intl (PHP extension)

### Langkah-langkah

1. **Clone repository**
   ```bash
   git clone <repo-url>
   cd de_roemah_makan
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Konfigurasi environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup database**
   - Buat database MySQL: `de_roemah_makan`
   - Sesuaikan kredensial di file `.env`

5. **Jalankan migration & seeder**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Jalankan server**
   ```bash
   php artisan serve
   ```

7. **Akses website**
   - Frontend: `http://localhost:8000`
   - Admin Panel: `http://localhost:8000/admin`


## 📄 Halaman & Fitur

### Frontend (User)
| Halaman | URL | Deskripsi |
|---------|-----|-----------|
| Beranda | `/` | Banner hero, menu rekomendasi & populer |
| Menu | `/menu` | Daftar menu dengan filter kategori, pencarian, ketersediaan, harga |
| Booking | `/booking` | Form reservasi meja |
| Checkout | `/checkout` | Checkout pesanan dari keranjang |
| Status | `/status` | Cek status pesanan & booking via nomor HP |

### Admin Panel (Filament)
| Resource | Deskripsi |
|----------|-----------|
| Menu Items | CRUD data menu (nama, harga, kategori, gambar, badges) |
| Pesanan | Kelola pesanan (lihat detail, ubah status) |
| Booking | Kelola booking meja (lihat detail, ubah status) |

## 🗂️ Kategori Menu
- 🍛 Hidangan Utama
- 🍪 Kue Kering
- 🧁 Kue Basah
- 🍟 Gorengan
- 🥨 Kerupuk
- 🥤 Minuman

## 🛒 Sistem Keranjang

Keranjang belanja menggunakan **session-based cart** yang dikelola melalui AJAX endpoint:
- `POST /cart/add` - Tambah item
- `POST /cart/update` - Update quantity
- `POST /cart/remove` - Hapus item
- `POST /cart/clear` - Kosongkan keranjang
- `GET /cart` - Get data keranjang

## 📝 Catatan Pengembangan

- Project ini merupakan Laravel + Filament
- Desain menggunakan color scheme coklat warm (#8B5E3C) yang konsisten
- Semua data menu di-seed dari data asli project React (16 menu items)
- Order items dinormalisasi ke tabel terpisah
- Cart menggunakan Laravel Session

## 📜 Lisensi

Hak Cipta © {{ date('Y') }} De Roemah Makan. Semua hak dilindungi.
