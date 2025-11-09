# Quick Start Guide - WE-Kasir

## 🚀 Cara Menjalankan Proyek

### 1. Pastikan XAMPP Sudah Berjalan

-   Start Apache
-   Start MySQL

### 2. Buka Terminal di Folder Proyek

```bash
cd c:\xampp\htdocs\we-kasir
```

### 3. Jalankan Server Laravel

```bash
php artisan serve
```

### 4. Buka Browser

Akses: **http://localhost:8000**

---

## 👤 Login Credentials

### Admin (Akses Penuh)

-   **Email**: admin@kasir.com
-   **Password**: password

### Manajer (Lihat Laporan)

-   **Email**: manajer@kasir.com
-   **Password**: password

### Kasir (Transaksi Saja)

-   **Email**: kasir@kasir.com
-   **Password**: password

---

## 📋 Menu yang Tersedia

### Untuk Admin:

✅ Dashboard - Statistik lengkap
✅ Transaksi - Buat transaksi penjualan
✅ Produk - Kelola produk (tambah, edit, hapus)
✅ Kategori - Kelola kategori produk
✅ Laporan - Lihat laporan penjualan dengan grafik
✅ Riwayat - Lihat riwayat transaksi

### Untuk Manajer:

✅ Dashboard - Statistik lengkap
✅ Laporan - Lihat laporan penjualan dengan grafik
✅ Riwayat - Lihat riwayat transaksi

### Untuk Kasir:

✅ Dashboard - Statistik dasar
✅ Transaksi - Buat transaksi penjualan
✅ Riwayat - Lihat riwayat transaksi

---

## 🛒 Cara Melakukan Transaksi

1. Login sebagai **Kasir** atau **Admin**
2. Klik menu **"Transaksi"**
3. Pilih produk yang akan dibeli (klik pada card produk)
4. Produk akan masuk ke keranjang di sebelah kanan
5. Atur jumlah dengan tombol **+** atau **-**
6. Masukkan **jumlah pembayaran**
7. Sistem akan otomatis hitung **kembalian**
8. Klik **"Proses Transaksi"**
9. Struk akan muncul dan bisa dicetak

---

## 📊 Cara Melihat Laporan

1. Login sebagai **Admin** atau **Manajer**
2. Klik menu **"Laporan"**
3. Pilih filter periode:
    - Hari Ini
    - Minggu Ini
    - Bulan Ini
    - Custom (pilih tanggal sendiri)
4. Lihat grafik penjualan dan detail transaksi

---

## ⚙️ Fitur Tambahan

### Dashboard

-   Total produk, kategori, dan user
-   Pendapatan hari ini
-   Transaksi hari ini
-   5 Transaksi terbaru
-   Produk dengan stok rendah (< 10)

### Manajemen Produk (Admin)

-   Tambah produk baru
-   Edit harga dan stok
-   Hapus produk
-   Monitor stok

### Manajemen Kategori (Admin)

-   Tambah kategori
-   Edit kategori
-   Hapus kategori

---

## 🔧 Troubleshooting

### Halaman Error 500

```bash
php artisan config:clear
php artisan cache:clear
```

### CSS Tidak Muncul

```bash
npm run build
```

Atau untuk development:

```bash
npm run dev
```

### Database Error

-   Pastikan MySQL di XAMPP sudah running
-   Cek file `.env` (DB_DATABASE=we_kasir)
-   Pastikan database `we_kasir` sudah dibuat

---

## 📱 Fitur Responsif

Website ini responsif dan bisa diakses dari:

-   Desktop (optimal)
-   Tablet
-   Mobile

---

## 💡 Tips Penggunaan

1. **Stok Otomatis**: Stok akan berkurang otomatis saat transaksi berhasil
2. **Warning Stok**: Dashboard akan menampilkan warning untuk produk dengan stok < 10
3. **Cetak Struk**: Gunakan tombol "Cetak Struk" atau Ctrl+P
4. **Filter Laporan**: Gunakan custom date untuk melihat periode spesifik
5. **Grafik Interaktif**: Hover pada grafik untuk detail per tanggal

---

## 📞 Support

Untuk pembelajaran lebih lanjut, lihat file **DOKUMENTASI.md** untuk informasi lengkap.

---

**Selamat menggunakan WE-Kasir! 🎉**
