# Konfigurasi Infrastruktur Docker

Panduan teknis mengenai manajemen kontainer dan integrasi alat manajemen database dalam ekosistem De Roemah Makan.

## Implementasi phpMyAdmin

Layanan phpMyAdmin diintegrasikan melalui Docker Compose untuk memfasilitasi administrasi database secara efisien.

### Detail Konfigurasi
```yaml
phpmyadmin:
    image: phpmyadmin:latest
    container_name: de_roemah_phpmyadmin
    depends_on:
        - db
    environment:
        - PMA_HOST=db
    ports:
        - "8081:80"
    networks:
        - deroemahmakan
```

## Mekanisme Konektivitas

Integrasi antara phpMyAdmin dan database MySQL menggunakan protokol jaringan internal Docker:

- **Resolusi Host**: Layanan phpMyAdmin berkomunikasi dengan database menggunakan hostname db yang didefinisikan dalam jaringan virtual deroemahmakan.
- **Isolasi Jaringan**: Seluruh layanan berada dalam satu subnet yang sama untuk menjamin keamanan dan kecepatan pertukaran data tanpa memerlukan eksposur IP publik secara langsung.

## Prosedur Inisialisasi

Untuk mengaktifkan atau memperbarui layanan, gunakan perintah berikut:

```bash
docker-compose up -d
```

### Penjelasan Perintah
- **Up**: Menginstruksikan Docker untuk melakukan pengecekan dependensi, menarik image yang diperlukan, dan menginisialisasi kontainer sesuai spesifikasi YAML.
- **Detached (-d)**: Menjalankan layanan di latar belakang sehingga proses tidak mengunci sesi terminal aktif.

## Troubleshooting
Apabila layanan tidak dapat diakses, pastikan kontainer database (de_roemah_db) dalam status aktif dan periksa alokasi port 8081 pada host sistem untuk menghindari konflik.
