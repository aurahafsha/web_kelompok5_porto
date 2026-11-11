# Daftar Tugas Kelompok 5 – Website Portofolio Karya Siswa RPL (Laravel)

Dokumen ini adalah sumber kebenaran pembagian kerja. Centang kotak setelah PR di-merge.

## Pembagian peran

| Orang | Peran | Area yang boleh diedit |
|---|---|---|
| Aura Hafsha Trisna Anggira | Ketua, pengatur alur, backend, database | `routes/`, `app/`, `config/`, `database/`, `docs/`, `.env.example` |
| Muhammad Surya Bayu Saputra | Slicing seluruh halaman dari Figma | `resources/views/` (kecuali `errors/`), `public/css/` |
| Syafira Eka Wijayanti | Bantu slicing, aset gambar, halaman error, pemeriksaan visual | `public/images/`, `resources/views/errors/`, `resources/views/komponen/`, komentar pada PR |

## Tahap 0 – Persiapan (Aura)

- [ ] Overlay Laravel di-merge ke `main` (PR `setup/laravel-struktur`)
- [ ] Aturan branch `main` aktif (wajib PR, minimal 1 persetujuan)
- [ ] Bayu dan Syafira berstatus Write di Settings → Collaborators
- [ ] Semua anggota sudah menjalankan `docs/SETUP-LARAVEL.md` sampai halaman beranda tampil

## Tahap 1 – Dasar bersama (Bayu dan Syafira)

- [ ] `public/css/variables.css` dan `public/css/common.css` (Bayu)
- [ ] `resources/views/layouts/app.blade.php` sudah sesuai Figma (Bayu)
- [ ] `resources/views/komponen/_demo.blade.php` berisi semua komponen (Bayu)
- [ ] Aset dari Figma di `public/images/` (Syafira)

## Tahap 2 – Slicing per role (Bayu)

| Branch | View | Status |
|---|---|---|
| `slicing/pengunjung` | pengunjung/index, galeri, detail-proyek, profil-siswa, auth/login-siswa, auth/login-admin | [ ] |
| `slicing/siswa` | siswa/dashboard, upload-proyek, edit-proyek, profil-saya | [ ] |
| `slicing/admin` | admin/dashboard, verifikasi-proyek, moderasi-komentar, moderasi-testimoni, kelola-kategori, kelola-teknologi | [ ] |
| `slicing/halaman-umum` | errors/404, errors/403 (dibantu Syafira) | [ ] |

## Tahap 3 – Pemeriksaan visual (Syafira)

- [ ] Setiap PR Bayu dibandingkan dengan Figma (warna, jarak, ukuran teks)
- [ ] Setiap PR dicek di lebar desktop dan ponsel (sekitar 375 px)
- [ ] Temuan ditulis sebagai komentar di PR

## Tahap 4 – Logika dan database (Aura)

- [ ] Migrasi dijalankan tanpa error di semua komputer
- [ ] Guard `siswa` dan `admin` aktif di `config/auth.php`
- [ ] Login siswa dan admin berfungsi, termasuk logout
- [ ] Akses per role: siswa tidak bisa buka halaman admin (403)
- [ ] Galeri dan detail proyek dari database
- [ ] Dashboard siswa: statistik dan CRUD proyek (dengan pemeriksaan pemilik)
- [ ] Upload gambar: validasi tipe dan ukuran 2 MB, simpan di `storage/app/public`
- [ ] Verifikasi proyek oleh admin (approve dan reject)
- [ ] Moderasi komentar dan testimoni
- [ ] Pencarian dan filter galeri
- [ ] Pagination galeri (9 per halaman)
- [ ] Seeder data contoh untuk akun uji coba

## Tahap 5 – Dokumentasi dan pengujian (Syafira dan Aura)

- [ ] Syafira menyusun daftar uji (checklist per role) di `docs/PENGUJIAN.md`
- [ ] Setiap fitur diuji oleh orang yang tidak mengerjakannya

## Aturan singkat

1. Setiap PR hanya satu role atau satu fitur.
2. Jangan mengubah file milik orang lain tanpa menulis di grup dahulu.
3. Pull dari `main` sebelum membuat branch baru.
4. Jangan commit `.env`, folder `vendor/`, atau berkas SQL yang kosong.
5. Perubahan struktur database hanya lewat migrasi baru, bukan mengedit migrasi lama yang sudah dipakai tim.
