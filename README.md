# Sistem Gudang

Sistem Gudang adalah aplikasi berbasis Laravel untuk mengelola inventaris barang. Aplikasi ini menggunakan Docker untuk penyebaran yang mudah dan konsisten.

## Prerequisites

Sebelum memulai, pastikan kamu telah menginstal perangkat lunak berikut:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Instalasi

Ikuti langkah-langkah di bawah ini untuk menginstal dan menjalankan proyek ini di lokalmu.

### 1. Clone Repository

Pertama, clone repository ini ke mesin lokalmu:

```bash
git clone https://github.com/arosyihuddin/SistemGudang-Laravel.git
cd SistemGudang-Laravel
```

### 2. Konfigurasi Environment

Salin file `.env.example` ke `.env`:

```bash
cp .env.example .env
```

Edit file `.env` sesuai kebutuhan, terutama bagian pengaturan database:

```dotenv
DB_CONNECTION=mysql          # Jenis koneksi database, menggunakan MySQL
DB_HOST=db                   # Host database, dalam hal ini adalah service db di Docker
DB_PORT=3306                 # Port untuk koneksi database MySQL
DB_DATABASE=db_sistem_gudang # Nama database yang akan digunakan
DB_USERNAME=root             # Username untuk koneksi ke database (default untuk MySQL)
DB_PASSWORD=secret           # Password untuk user database
```

### 3. Bangun dan Jalankan Container

Gunakan Docker Compose untuk membangun dan menjalankan aplikasi:

```bash
docker-compose up -d
```

### 4. Menunggu MySQL Siap

Pastikan MySQL sudah berjalan dengan baik. Kamu bisa mengecek log dengan:

```bash
docker-compose logs db
```

### 5. Jalankan Migrasi

Setelah MySQL siap, jalankan migrasi untuk membuat tabel yang diperlukan di database:

```bash
docker-compose exec app php artisan migrate
```

### 6. Akses Aplikasi

Setelah semuanya berjalan, kamu dapat mengakses aplikasi di:

```
http://localhost:8000
```

### 7. Dokumentasi API

Untuk dokumentasi API, silakan kunjungi link berikut:

[Dokumentasi Postman](https://documenter.getpostman.com/view/20046465/2sAXqwYKsZ)

## Menghentikan Aplikasi

Untuk menghentikan aplikasi, gunakan perintah berikut:

```bash
docker-compose down
```

## Kontribusi

Jika kamu ingin berkontribusi, silakan buat branch baru dan kirim pull request. Semua kontribusi sangat dihargai!
