# Dokumentasi Proyek De Roemah Makan

Pusat informasi teknis dan operasional untuk aplikasi De Roemah Makan. Dokumentasi ini disusun secara sistematis untuk memudahkan pemahaman arsitektur, pengembangan, dan manajemen sistem.

---

## Arsitektur dan Desain
- [Desain Sistem](architecture/system_design.md): Arsitektur tingkat tinggi dan alur data sistem.
- [Spesifikasi Database](architecture/database_schema.md): Detail teknis tabel, relasi, dan skema database.
- [Catatan Refaktor](architecture/refactoring_notes.md): Dokumentasi transisi sistem Booking menjadi Catering.

## Teknis dan Pengembangan
- [Teknologi Utama](stack/tech_stack.md): Daftar teknologi dan dependensi yang digunakan.
- [Log Perubahan](development/change_log.md): Catatan histori perbaikan dan pengembangan fitur.
- [Logika Kode](snippets/checkout_logic.md): Referensi implementasi logika krusial dalam aplikasi.
- [Rencana Pengembangan](management/project_roadmap.md): Status terkini dan peta jalan pengembangan masa depan.

## Panduan Penggunaan
- [Manual Operasional](guides/usage.md): Panduan penggunaan panel admin dan alur pemesanan.
- [Panduan Instalasi Dari Nol](guides/installation_guide.md): Langkah-langkah setup Arch Linux, PHP, dan Docker.
- [Konfigurasi Docker](guides/docker_setup.md): Panduan teknis infrastruktur Docker dan phpMyAdmin.

---

## Standar Kontribusi
Untuk menjaga integritas kode, setiap kontribusi harus mematuhi standar berikut:
1. Menggunakan format commit konvensional (feat, fix, docs).
2. Memperbarui dokumentasi terkait apabila terdapat perubahan skema atau alur bisnis.
3. Melakukan validasi pada lingkungan Docker sebelum melakukan sinkronisasi ke cabang utama.
