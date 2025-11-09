# 🔧 Troubleshooting Guide - WE-Kasir

## Masalah Umum dan Solusinya

### 1. ❌ Error 500 - Internal Server Error

**Penyebab:**

-   Cache Laravel yang corrupt
-   File .env tidak terbaca
-   Migration belum dijalankan

**Solusi:**

```bash
# Clear semua cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimize
php artisan optimize
```

---

### 2. 🎨 CSS/Tailwind Tidak Muncul

**Penyebab:**

-   Asset belum di-build
-   Vite belum running

**Solusi:**

```bash
# Build sekali untuk production
npm run build

# Atau untuk development (auto-reload)
npm run dev
```

Jika masih error:

```bash
# Reinstall dependencies
rm -rf node_modules
npm install
npm run build
```

---

### 3. 💾 Database Connection Error

**Pesan Error:**

```
SQLSTATE[HY000] [1049] Unknown database 'we_kasir'
```

**Solusi:**

```bash
# Buat database via MySQL
C:\xampp\mysql\bin\mysql -u root -e "CREATE DATABASE we_kasir;"

# Atau buat manual via phpMyAdmin:
# 1. Buka http://localhost/phpmyadmin
# 2. Klik "New"
# 3. Nama database: we_kasir
# 4. Collation: utf8mb4_unicode_ci
```

**Cek koneksi:**

```bash
php artisan migrate:status
```

---

### 4. 🔑 SQLSTATE[42S02] Table Not Found

**Penyebab:**

-   Migration belum dijalankan
-   Database kosong

**Solusi:**

```bash
# Jalankan migration
php artisan migrate

# Atau migrate fresh dengan seed
php artisan migrate:fresh --seed
```

---

### 5. 🚫 403 Forbidden / Unauthorized

**Penyebab:**

-   User tidak punya akses ke halaman tersebut
-   Role tidak sesuai

**Solusi:**

-   Login dengan user yang sesuai:
    -   Admin untuk kelola produk/kategori
    -   Kasir untuk transaksi
    -   Manajer untuk laporan

**Test Role:**

```
Admin: admin@kasir.com / password
Manajer: manajer@kasir.com / password
Kasir: kasir@kasir.com / password
```

---

### 6. 📦 Class Not Found

**Pesan Error:**

```
Class 'App\Http\Controllers\...' not found
```

**Solusi:**

```bash
# Regenerate autoload
composer dump-autoload

# Clear compiled
php artisan clear-compiled
```

---

### 7. 🔐 Login Redirect Loop

**Penyebab:**

-   Session tidak tersimpan
-   APP_KEY tidak di-generate

**Solusi:**

```bash
# Generate key
php artisan key:generate

# Clear config
php artisan config:clear
```

---

### 8. 📊 Chart.js Tidak Muncul

**Penyebab:**

-   Script belum di-load
-   Data kosong

**Solusi:**

1. Pastikan ada transaksi di database
2. Buat transaksi dummy
3. Cek console browser (F12) untuk error
4. Pastikan CDN Chart.js ter-load

---

### 9. 🛒 Keranjang Tidak Berfungsi

**Penyebab:**

-   JavaScript error
-   CSRF token tidak valid

**Solusi:**

1. Refresh halaman (Ctrl + F5)
2. Clear browser cache
3. Cek console browser (F12)
4. Pastikan dalam mode login

---

### 10. 🖨️ Struk Tidak Tercetak

**Penyebab:**

-   Browser block popup
-   Print CSS tidak load

**Solusi:**

1. Allow popup di browser
2. Gunakan Ctrl+P manual
3. Cek print preview
4. Gunakan browser lain (Chrome recommended)

---

### 11. ⚠️ Stok Tidak Berkurang

**Penyebab:**

-   Transaksi gagal (rollback)
-   Error saat proses

**Solusi:**

1. Cek log error: `storage/logs/laravel.log`
2. Pastikan stok cukup
3. Cek database transaction
4. Test ulang dengan produk berbeda

---

### 12. 📱 Tampilan Mobile Berantakan

**Penyebab:**

-   Cache browser
-   Tailwind tidak ter-build

**Solusi:**

```bash
npm run build
```

Lalu:

1. Clear browser cache (Ctrl + Shift + Delete)
2. Hard refresh (Ctrl + F5)

---

### 13. 🔄 Seeder Error

**Pesan Error:**

```
SQLSTATE[23000]: Integrity constraint violation
```

**Solusi:**

```bash
# Fresh migrate dengan seed
php artisan migrate:fresh --seed
```

---

### 14. 📝 Form Submit Tidak Jalan

**Penyebab:**

-   CSRF token expired
-   Session timeout

**Solusi:**

1. Refresh halaman
2. Submit ulang
3. Cek apakah masih login

---

### 15. 🌐 Server Tidak Jalan

**Pesan Error:**

```
[Illuminate\Database\QueryException]
could not find driver
```

**Solusi:**

1. Pastikan PHP extension di-enable:

    - php_pdo_mysql
    - php_mysqli

2. Edit `php.ini` di XAMPP:
    - Cari: `;extension=pdo_mysql`
    - Hapus `;` (uncomment)
    - Restart Apache

---

## 🆘 Command Darurat

Jika semua gagal, reset total:

```bash
# 1. Drop semua table
php artisan migrate:fresh

# 2. Migrate dan seed ulang
php artisan migrate --seed

# 3. Clear semua cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 4. Optimize
php artisan optimize

# 5. Rebuild assets
npm run build
```

---

## 📞 Debugging Tips

### Check Error Logs

```bash
# Linux/Mac
tail -f storage/logs/laravel.log

# Windows (buka di text editor)
storage/logs/laravel.log
```

### Enable Debug Mode

Di file `.env`:

```env
APP_DEBUG=true
APP_ENV=local
```

### Browser Console

1. Buka browser
2. Tekan F12
3. Tab "Console"
4. Lihat error JavaScript

### Network Tab

1. F12 → Network
2. Submit form/action
3. Lihat response yang error (merah)
4. Cek detail error

---

## ✅ Checklist Sebelum Deploy

-   [ ] `APP_DEBUG=false` di `.env`
-   [ ] `APP_ENV=production`
-   [ ] Ganti `APP_KEY` yang secure
-   [ ] Database credentials benar
-   [ ] `npm run build` (bukan dev)
-   [ ] `php artisan optimize`
-   [ ] File permissions benar
-   [ ] `.env` tidak ter-commit ke git

---

## 🔍 Cara Cek Status

### Cek Database

```bash
php artisan migrate:status
```

### Cek Route

```bash
php artisan route:list
```

### Cek Config

```bash
php artisan config:show
```

### Test Database Connection

```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

---

## 📧 Masih Error?

1. **Cek dokumentasi**: Baca `DOKUMENTASI.md`
2. **Cek logs**: `storage/logs/laravel.log`
3. **Google error message**: Copy paste error ke Google
4. **Stack Overflow**: Cari solusi di forum
5. **Laravel Docs**: https://laravel.com/docs/10.x

---

**Tips**: Selalu backup database sebelum mencoba fix yang destructive!

```bash
# Backup database
C:\xampp\mysql\bin\mysqldump -u root we_kasir > backup.sql

# Restore database
C:\xampp\mysql\bin\mysql -u root we_kasir < backup.sql
```

---

**Good luck! 🍀**
