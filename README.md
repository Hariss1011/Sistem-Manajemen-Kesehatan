# Sistem Manajemen Kesehatan

Aplikasi berbasis web untuk membantu pengelolaan data dan administrasi layanan kesehatan secara terstruktur dalam satu sistem terpusat.

Proyek ini dikembangkan sebagai proyek akademik untuk menerapkan pengembangan aplikasi web, pengelolaan basis data, dan perancangan sistem informasi menggunakan Laravel.

## 📌 Tentang Proyek

**Sistem Manajemen Kesehatan** merupakan aplikasi yang dirancang untuk mempermudah pengelolaan informasi kesehatan melalui antarmuka web. Aplikasi ini berfokus pada pengelolaan data secara terorganisasi agar proses administrasi menjadi lebih praktis dan efisien.

## ✨ Fitur Utama

- **Pengelolaan Data Pasien** — Mengelola informasi dan data pendaftaran pasien.
- **Pengelolaan Data Dokter** — Mengelola informasi dokter yang terdaftar dalam sistem.
- **Pengelolaan Jadwal** — Mengatur dan mengelola jadwal dokter.
- **Pengelolaan Stok Obat** — Mengelola data obat dan informasi persediaan.
- **Dashboard Admin** — Menyediakan tampilan terpusat untuk mengakses fitur administrasi.
- **Pengelolaan Data** — Mendukung operasi tambah, lihat, ubah, dan hapus data sesuai modul yang tersedia.

## 🛠️ Teknologi yang Digunakan

| Teknologi | Kegunaan                                 |
| --------- | ---------------------------------------- |
| PHP       | Bahasa pemrograman sisi server           |
| Laravel   | Kerangka kerja pengembangan aplikasi web |
| MySQL     | Sistem manajemen basis data relasional   |
| Blade     | Mesin templat untuk tampilan aplikasi    |
| AdminLTE  | Templat antarmuka dashboard administrasi |

## 📸 Tampilan Aplikasi

Bagian ini digunakan untuk menampilkan tangkapan layar antarmuka dan fitur utama aplikasi.

<!-- Tambahkan gambar screenshot aplikasi di bagian ini. -->

## ⚙️ Persyaratan Sistem

Pastikan perangkat telah memiliki perangkat lunak berikut:

- PHP dengan versi yang sesuai dengan proyek
- Composer
- MySQL
- Node.js dan npm
- Git

## 🚀 Instalasi dan Menjalankan Aplikasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lingkungan lokal.

### 1. Kloning repositori

```bash
git clone https://github.com/Hariss1011/Sistem-Manajemen-Kesehatan.git
cd Sistem-Manajemen-Kesehatan
```

### 2. Instal dependensi

```bash
composer install
npm install
```

### 3. Konfigurasi lingkungan aplikasi

Salin file `.env.example` menjadi `.env`. Pada Windows, kamu dapat menyalin file tersebut secara manual melalui File Explorer.

Kemudian, jalankan perintah:

```bash
php artisan key:generate
```

### 4. Konfigurasi basis data

Buat basis data MySQL terlebih dahulu, lalu sesuaikan konfigurasi berikut di dalam file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan nama basis data, nama pengguna, dan kata sandi dengan konfigurasi MySQL di perangkatmu.

### 5. Jalankan migrasi basis data

```bash
php artisan migrate
```

Jika proyek menyediakan seeder untuk mengisi data awal, periksa konfigurasi seeder terlebih dahulu. Apabila sudah siap digunakan, jalankan:

```bash
php artisan db:seed
```

### 6. Bangun aset frontend

```bash
npm run build
```

### 7. Jalankan aplikasi

```bash
php artisan serve
```

Buka alamat berikut melalui peramban:

`http://127.0.0.1:8000`

## 📂 Struktur Proyek

Aplikasi menggunakan struktur direktori standar Laravel, dengan beberapa direktori utama sebagai berikut:

```text
app/
├── Http/
│   └── Controllers/
└── Models/
database/
├── migrations/
└── seeders/
resources/
└── views/
routes/
└── web.php
```

Struktur tersebut merupakan gambaran umum dan dapat berbeda sesuai implementasi modul di dalam proyek.

## 🎯 Tujuan Pengembangan

Melalui proyek ini, beberapa kemampuan teknis yang diterapkan dan dikembangkan meliputi:

- Pengembangan aplikasi web menggunakan PHP dan Laravel.
- Pengelolaan basis data relasional menggunakan MySQL.
- Implementasi operasi CRUD pada modul pengelolaan data.
- Pengorganisasian tampilan menggunakan Blade dan AdminLTE.
- Perancangan sistem informasi dengan struktur data dan alur administrasi yang terorganisasi.

## 📌 Status Proyek

Proyek ini dikembangkan untuk keperluan akademik dan portofolio. Pengembangan dan penyempurnaan fitur dapat dilakukan secara bertahap sesuai kebutuhan.

## 👨‍💻 Pengembang

**Akhmad Haris**

- GitHub: [Hariss1011](https://github.com/Hariss1011)

---

Dikembangkan sebagai bagian dari pembelajaran pengembangan aplikasi web dan sistem informasi.
