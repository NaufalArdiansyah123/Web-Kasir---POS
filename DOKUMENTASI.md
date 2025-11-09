# WE-Kasir - Point of Sale System

Aplikasi Point of Sale (Kasir) sederhana menggunakan Laravel 10 dan Tailwind CSS untuk pembelajaran.

## Fitur Utama

### 🔐 Autentikasi & Role Management

-   Login dan Register menggunakan Laravel Breeze
-   3 Role User:
    -   **Admin/Owner**: Akses penuh (CRUD produk, kategori, lihat laporan, tambah user)
    -   **Manajer**: Lihat laporan (tidak bisa mengubah data)
    -   **Kasir**: Hanya bisa melakukan transaksi

### 📦 Manajemen Produk

-   CRUD Produk (Nama, Harga, Stok, Kategori, Deskripsi)
-   CRUD Kategori Produk
-   Monitoring stok rendah di dashboard

### 💰 Sistem Transaksi

-   Interface kasir untuk memilih produk
-   Keranjang belanja dinamis
-   Perhitungan otomatis total dan kembalian
-   Pengurangan stok otomatis setelah transaksi
-   Cetak struk transaksi (HTML/Print)
-   Riwayat transaksi

### 📊 Laporan Penjualan

-   Filter periode: Harian, Mingguan, Bulanan, Custom
-   Grafik penjualan menggunakan Chart.js
-   Total pendapatan dan jumlah transaksi
-   Detail transaksi per periode

### 🎨 Tampilan UI

-   Design modern dan responsif menggunakan Tailwind CSS
-   Layout dengan sidebar dan topbar
-   Warna tema: Hitam, Putih, dan biru untuk aksen
-   Rounded corners, shadows, dan hover effects

## Tech Stack

-   **Backend**: Laravel 10
-   **Frontend**: Blade Templates + Tailwind CSS
-   **Database**: MySQL
-   **Charts**: Chart.js
-   **Authentication**: Laravel Breeze

## Struktur Database

### Tabel Users

-   id, name, email, password, role, timestamps

### Tabel Categories

-   id, name, description, timestamps

### Tabel Products

-   id, name, price, stock, category_id, description, timestamps

### Tabel Transactions

-   id, user_id, total, bayar, kembalian, tanggal, timestamps

### Tabel Transaction_Details

-   id, transaction_id, product_id, qty, subtotal, timestamps

## Instalasi

### 1. Clone / Extract Project

```bash
cd c:\xampp\htdocs\we-kasir
```

### 2. Install Dependencies (Sudah dilakukan)

```bash
composer install
npm install
npm run build
```

### 3. Setup Environment

File `.env` sudah dikonfigurasi dengan:

```env
DB_DATABASE=we_kasir
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Buat Database

Buat database MySQL dengan nama `we_kasir` melalui phpMyAdmin atau command line:

```sql
CREATE DATABASE we_kasir;
```

### 5. Jalankan Migration & Seeder

```bash
php artisan migrate --seed
```

### 6. Jalankan Development Server

```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## Login Credentials

Setelah menjalankan seeder, gunakan credentials berikut:

### Admin

-   Email: `admin@kasir.com`
-   Password: `password`

### Manajer

-   Email: `manajer@kasir.com`
-   Password: `password`

### Kasir

-   Email: `kasir@kasir.com`
-   Password: `password`

## Penggunaan

### Sebagai Admin

1. Login menggunakan akun admin
2. Kelola kategori produk di menu "Kategori"
3. Tambah/edit/hapus produk di menu "Produk"
4. Lihat dashboard untuk overview sistem
5. Lihat laporan penjualan di menu "Laporan"
6. Bisa juga melakukan transaksi

### Sebagai Kasir

1. Login menggunakan akun kasir
2. Buka menu "Transaksi"
3. Pilih produk yang akan dibeli
4. Produk akan masuk ke keranjang
5. Atur quantity dengan tombol +/-
6. Input jumlah pembayaran
7. Sistem akan hitung kembalian otomatis
8. Klik "Proses Transaksi"
9. Cetak struk jika diperlukan

### Sebagai Manajer

1. Login menggunakan akun manajer
2. Lihat dashboard dan statistik
3. Akses menu "Laporan" untuk melihat penjualan
4. Tidak bisa mengubah data produk/kategori

## Struktur Folder

```
we-kasir/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── CategoryController.php
│   │   │   ├── ProductController.php
│   │   │   ├── TransactionController.php
│   │   │   ├── ReportController.php
│   │   │   └── DashboardController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/
│       ├── Category.php
│       ├── Product.php
│       ├── Transaction.php
│       └── TransactionDetail.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── dashboard.blade.php
│       ├── categories/
│       ├── products/
│       ├── transactions/
│       └── reports/
└── routes/
    └── web.php
```

## Fitur Role-Based Access Control

| Fitur           | Admin | Manajer | Kasir |
| --------------- | ----- | ------- | ----- |
| Dashboard       | ✅    | ✅      | ✅    |
| Transaksi       | ✅    | ❌      | ✅    |
| Kelola Produk   | ✅    | ❌      | ❌    |
| Kelola Kategori | ✅    | ❌      | ❌    |
| Laporan         | ✅    | ✅      | ❌    |
| Riwayat         | ✅    | ✅      | ✅    |

## Catatan Penting

-   Stok produk akan otomatis berkurang setelah transaksi berhasil
-   Dashboard menampilkan produk dengan stok < 10 sebagai warning
-   Transaksi menggunakan database transaction untuk memastikan data consistency
-   Pembayaran harus >= total belanja
-   Semua harga dalam format Rupiah (IDR)

## Development

Untuk development dengan hot reload:

```bash
npm run dev
php artisan serve
```

## Troubleshooting

### Error 500 saat akses halaman

-   Pastikan sudah jalankan `php artisan migrate --seed`
-   Clear cache: `php artisan config:clear && php artisan cache:clear`

### Tailwind tidak muncul

-   Jalankan `npm run build` atau `npm run dev`
-   Clear browser cache

### Database error

-   Pastikan MySQL service berjalan di XAMPP
-   Cek konfigurasi database di file `.env`
-   Pastikan database `we_kasir` sudah dibuat

## License

Project ini dibuat untuk keperluan pembelajaran.

---

**Dibuat dengan ❤️ menggunakan Laravel 10 & Tailwind CSS**
