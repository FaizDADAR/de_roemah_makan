# Tech Stack - De Roemah Makan

Aplikasi ini dibangun menggunakan teknologi modern untuk memastikan performa tinggi dan kemudahan pengembangan.

## Core Technologies
- **Framework**: Laravel 13 (Cutting-edge version)
- **PHP**: ^8.4 (Mendukung fitur-fitur terbaru PHP)
- **Database**: MySQL 8.0
- **Admin Panel**: Filament 5 (Unified Schema System)
- **Database Manager**: phpMyAdmin (Web-based Interface)

## Frontend
- **CSS**: Tailwind CSS (via Vite)
- **JavaScript**: Vanilla JS / Alpine.js (Lightweight & Reactive)
- **Icons**: Heroicons (Outline & Solid)

## Infrastructure
- **Containerization**: Docker Compose
- **Web Server**: PHP Built-in Server (Artisan Serve) yang berjalan di dalam container.
- **Port Mapping**: 
  - `:8000` (Web Application)
  - `:8081` (phpMyAdmin)
  - `:3306` (Database MySQL)

## Environment Configuration
- **DB_HOST**: `db` (Nama service database di Docker network)
- **APP_URL**: `http://localhost:8000`
