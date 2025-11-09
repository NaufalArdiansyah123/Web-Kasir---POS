# 🏪 Web-KASIR - Point of Sale System

Sistem Point of Sale (POS) modern yang dibangun dengan Laravel 10 dan Tailwind CSS untuk mengelola penjualan, stok produk, dan laporan penjualan.

## ✨ Fitur Utama

### 🔐 **Autentikasi & Otorisasi**

-   Login dengan 3 role: Admin, Manajer, Kasir
-   Kontrol akses berbasis role (RBAC)
-   Password hashing yang aman

### 📊 **Dashboard**

-   Statistik penjualan hari ini
-   Ringkasan transaksi terbaru
-   Total produk dan kategori

### 🛍️ **Manajemen Produk** _(Admin)_

-   Tambah, edit, hapus produk via modal
-   Kategori produk
-   Tracking stok produk
-   Harga dan deskripsi produk

### 📦 **Manajemen Stok** _(Admin & Manajer)_

-   Kelola stok barang dengan mudah
-   Tambah atau kurangi stok
-   Preview stok baru dengan color indicator
-   Catatan perubahan stok

### 💳 **Sistem Transaksi**

-   Interface penjualan yang intuitif
-   Keranjang belanja interaktif
-   Hitung otomatis total dan kembalian
-   Generate struk transaksi

### 📝 **Riwayat Transaksi**

-   Lihat semua transaksi dengan pagination
-   Statistik pendapatan hari ini
-   Lihat detail struk setiap transaksi

### 📊 **Laporan Penjualan** _(Admin & Manajer)_

-   Filter periode: Hari ini, Minggu, Bulan, Custom
-   Grafik penjualan dengan Chart.js
-   Detail transaksi per periode

## 🛠️ **Teknologi**

-   **Backend:** Laravel 10
-   **Frontend:** Blade Templates + Tailwind CSS
-   **Database:** MySQL
-   **Chart:** Chart.js
-   **Build Tool:** Vite

## 🚀 **Instalasi & Setup**

```bash
# Clone atau download project
cd we-kasir

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate:fresh --seed

# Build assets
npm run build

# Jalankan server
php artisan serve
```

**Akses:** http://127.0.0.1:8000

## 👥 **User Default**

| Role    | Email             | Password |
| ------- | ----------------- | -------- |
| Admin   | admin@kasir.com   | password |
| Manajer | manajer@kasir.com | password |
| Kasir   | kasir@kasir.com   | password |

## 📂 **Struktur Project**

```
app/Http/Controllers/      # Business logic
resources/views/           # Blade templates
database/migrations/       # Database schema
database/seeders/          # Sample data
routes/web.php             # Route definitions
```

## 📝 **License**

MIT License
