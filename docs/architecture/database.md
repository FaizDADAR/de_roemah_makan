# Database Architecture

Struktur database dirancang untuk mendukung operasional restoran secara menyeluruh, mulai dari manajemen menu hingga pencatatan catering.

## Entitas Utama

### 1. `users`
Menangani otentikasi admin.
- `id`, `name`, `email`, `password`, `remember_token`

### 2. `menu_items`
Daftar makanan dan minuman.
- `name`, `description`, `price`, `category`
- `image_url`: Path lokal ke gambar menu.
- `available`: Status ketersediaan (boolean).
- Flag: `is_best_seller`, `is_favorite`, `is_recommended`, `is_popular`.

### 3. `orders` & `order_items`
Pencatatan transaksi pelanggan.
- **Order**: `customer_name`, `phone`, `total`, `status` (pending, diproses, selesai), `note`.
- **Order Items**: Relasi *one-to-many* yang mencatat item apa saja yang dibeli beserta harga saat transaksi (denormalisasi harga untuk histori).

### 4. `caterings`
Manajemen pesanan besar di hari tertentu.
- `customer_name`, `phone`, `people` (jumlah porsi), `date`, `time`, `status`.
- **Logic**: Dilengkapi dengan pengecekan bentrok jadwal di hari yang sama.

## Hubungan Antar Tabel
- `order_items.order_id` ➔ `orders.id`
- `order_items.menu_item_id` ➔ `menu_items.id`
