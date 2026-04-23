# Development Change Log

Catatan perubahan teknis harian untuk melacak perbaikan bug dan optimasi sistem.

## [2026-04-24] - Perbaikan Admin, Docker & Dokumentasi

### Fixed
- **Docker Compose YAML Structure**: Memperbaiki error `volumes.phpmyadmin additional properties not allowed`. 
  - Solusi: Memindahkan service `phpmyadmin` ke dalam blok `services:`.
- **Form Component Namespaces**: Memperbaiki error `Class "Section" not found`.
  - Solusi: Memisahkan pemanggilan antara `Filament\Schemas\Components` (untuk Section) dan `Filament\Forms\Components` (untuk TextInput, Select, dll).
  - File terdampak: `MenuItemResource.php`, `OrderResource.php`, `CateringResource.php`.
- **Artisan Serve Conflict**: Memberikan edukasi terkait konflik port 8000/8001 antara Host dan Docker.

### Added
- **Timeline Progress**: Menambahkan histori pengembangan dari awal proyek.

---

## [2026-04-23] - Refactor & Analytics
- **Catering System**: Mengganti sistem Booking menjadi Catering.
- **Dashboard Stats**: Widget statistik pendapatan dan pesanan baru.
- **Financial Export**: Fitur export laporan ke CSV.
- **AJAX Checkout**: Pencatatan otomatis ke database sebelum redirect WhatsApp.

## [2026-04-22] - Initial Foundation
- **Docker Setup**: Inisialisasi lingkungan Docker (PHP 8.4 + MySQL 8).
- **Database Schema**: Pembuatan tabel awal (Users, Menu, Orders).
- **Frontend UI**: Implementasi layout dasar De Roemah Makan.
- **Admin Panel**: Setup awal Filament Admin.
