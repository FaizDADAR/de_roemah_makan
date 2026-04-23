# Development Change Log

Catatan perubahan teknis harian untuk melacak perbaikan bug dan optimasi sistem.

## [2026-04-24] - Perbaikan Admin & Database Manager

### Added
- **phpMyAdmin Service**: Menambahkan service `phpmyadmin` pada `docker-compose.yml`.
  - Akses: `http://localhost:8081`
  - Tujuan: Memberikan antarmuka visual untuk manajemen database tanpa perlu aplikasi desktop.

### Fixed
- **Admin Edit Error**: Memperbaiki error `Class "Filament\Tables\Actions\EditAction" not found`.
  - Solusi: Menggunakan absolute namespace `\Filament\Actions\EditAction` karena perubahan struktur internal pada versi Filament yang digunakan.
  - File terdampak: `MenuItemResource.php`, `OrderResource.php`, `CateringResource.php`.
- **Image Standardization**: Menyeragamkan ukuran gambar menu di tabel admin menjadi `w-12 h-12` (48px) dengan `object-cover` untuk tampilan yang lebih rapi.
- **Missing Home Route**: Memperbaiki error 500 karena pemanggilan rute `booking.create` yang sudah di-refactor menjadi `catering.create` pada file `home.blade.php`.

## [2026-04-23] - Refactor & Analytics
### Added
- **Catering System**: Mengganti sistem Booking menjadi Catering.
- **Dashboard Stats**: Widget statistik pendapatan dan pesanan baru.
- **Financial Export**: Fitur export laporan ke CSV.
- **AJAX Checkout**: Pencatatan otomatis ke database sebelum redirect WhatsApp.
