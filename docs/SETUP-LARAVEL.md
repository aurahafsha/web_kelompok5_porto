# Panduan Setup Laravel – Kelompok 5

Panduan ini wajib diikuti oleh setiap anggota sebelum mulai bekerja.

## 1. Yang harus terpasang di komputer

| Program | Versi | Cek dengan |
|---|---|---|
| PHP | 8.2 atau lebih baru (ikut XAMPP versi terbaru) | `php -v` |
| Composer | versi terbaru | `composer -V` |
| MySQL | lewat XAMPP (Apache tidak wajib) | XAMPP Control Panel |
| Git dan VS Code | terbaru | `git --version` |

Jika PHP belum terbaca di terminal, tambahkan `C:\xampp\php` ke Environment Variables → Path, lalu buka VS Code lagi.

## 2. Ambil proyek

```bash
git clone https://github.com/aurahafsha/web_kelompok5_porto.git
cd web_kelompok5_porto
git checkout main
git pull
```

Folder clone jangan diletakkan di dalam OneDrive.

## 3. Pasang dependensi

```bash
composer install
```

Folder `vendor/` tidak ada di GitHub dan harus dibuat ulang di setiap komputer dengan perintah ini.

## 4. Buat file .env lokal

```bash
copy .env.example .env         (Windows Command Prompt)
php artisan key:generate
```

Buka `.env` lalu isi bagian database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_portofolio_siswa_rpl
DB_USERNAME=root
DB_PASSWORD=
```

`.env` tidak boleh di-commit. Hanya `.env.example` yang masuk GitHub.

## 5. Buat database dan jalankan migrasi

1. Buka http://localhost/phpmyadmin, lalu buat database `db_portofolio_siswa_rpl` dengan collation `utf8mb4_unicode_ci`.
2. Jalankan:
   ```bash
   php artisan migrate
   php artisan storage:link
   ```

Migrasi di folder `database/migrations/` adalah sumber kebenaran struktur database. Jangan mengimpor file SQL lama bersamaan dengan migrasi, karena akan membuat tabel ganda.

## 6. Atur guard login (sekali oleh Aura)

Buka `config/auth.php`, lalu ganti bagian `guards` dan `providers` sesuai contoh di `docs/auth-guards-snippet.txt`. Tanpa langkah ini login siswa dan admin tidak akan berfungsi.

## 7. Jalankan aplikasi

```bash
php artisan serve
```

Buka http://127.0.0.1:8000 di browser. Jika halaman tampil, setup sudah berhasil.

## 8. Masalah umum

| Gejala | Solusi |
|---|---|
| `composer` tidak dikenali | Install Composer dari getcomposer.org, lalu buka terminal baru |
| `Access denied for user 'root'` | Isi `DB_PASSWORD` sesuai XAMPP masing-masing |
| `SQLSTATE[HY000] [1049] Unknown database` | Database belum dibuat, ulangi langkah 5 |
| `No application encryption key` | Jalankan `php artisan key:generate` |
| Gambar tidak muncul | Jalankan `php artisan storage:link` |
| Halaman berubah setelah pull | Jalankan `php artisan view:clear` dan `php artisan route:clear` |

## 9. Pengalihan login per role (dikerjakan Aura di Tahap 4)

Secara bawaan, Laravel mengalihkan tamu ke route bernama `login`, yaitu form login siswa. Akibatnya, tamu yang membuka `/admin/dashboard` akan diarahkan ke login siswa. Perbaikannya ada di `app/Http/Middleware/Authenticate.php`:

```php
protected function redirectTo(Request $request): ?string
{
    if ($request->is('admin*')) {
        return route('login.admin');
    }

    return route('login');
}
```

Pastikan file `Authenticate.php` ada. Jika tidak ada, buat dengan `php artisan make:middleware Authenticate`. Di Laravel 11 atau 12, cara daftar middleware ada di `bootstrap/app.php` dan perlu dicek bersama.
