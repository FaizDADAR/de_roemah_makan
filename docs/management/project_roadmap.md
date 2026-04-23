# Project Roadmap & Development Status

Dokumen ini melacak kemajuan proyek De Roemah Makan dan merencanakan pengembangan di masa depan.

## Status Saat Ini: `v1.2.0 - Refactor & Analytics`

### Milestone 1: Core System (Selesai)
- [x] Inisialisasi Project Laravel & Docker.
- [x] Setup Database Schema (Users, Menu, Orders).
- [x] Implementasi Frontend UI (Home, Menu, Cart).
- [x] Integrasi WhatsApp API (Redirect).

### Milestone 2: Admin & Business Logic (Selesai)
- [x] Implementasi Filament Admin Panel.
- [x] Refactor fitur Booking menjadi **Catering**.
- [x] Penambahan Dashboard Analytics & Charts.
- [x] Fitur Export Laporan Keuangan (CSV).
- [x] Pencatatan pesanan otomatis via AJAX sebelum redirect.

## Roadmap Masa Depan

### Milestone 3: Customer Experience (Q3 2026)
- [ ] **Real-time Status Tracking**: Pelanggan bisa melihat status pesanan secara live (Tanpa refresh).
- [ ] **User Accounts**: Sistem member untuk mendapatkan poin/diskon.
- [ ] **Multi-language**: Dukungan Bahasa Inggris untuk turis.

### Milestone 4: Operational Excellence (Q4 2026)
- [ ] **Stock Management**: Pengurangan stok otomatis saat pesanan selesai.
- [ ] **Mobile App**: Aplikasi Android/iOS khusus untuk kurir pengantaran.
- [ ] **Payment Gateway**: Integrasi Midtrans untuk pembayaran non-tunai.

## Versioning Policy
Proyek ini menggunakan **Semantic Versioning (SemVer)**:
- `MAJOR`: Perubahan arsitektur besar/breaking changes.
- `MINOR`: Penambahan fitur baru yang kompatibel.
- `PATCH`: Perbaikan bug atau optimasi kecil.
