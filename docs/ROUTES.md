# Daftar Route – Kesepakatan Tim

Dokumen ini menggantikan kontrak API JSON sebelumnya. Aplikasi memakai halaman server-side (Blade), sehingga tidak ada endpoint JSON. Setiap perubahan route dicatat di sini lewat PR.

## Pengunjung (tanpa login)

| Metode | URL | Nama route | Controller@method | View |
|---|---|---|---|---|
| GET | `/` | beranda | PengunjungController@beranda | pengunjung/index |
| GET | `/galeri` | galeri | PengunjungController@galeri | pengunjung/galeri |
| GET | `/proyek/{proyek}` | proyek.detail | PengunjungController@detailProyek | pengunjung/detail-proyek |
| GET | `/profil/{siswa}` | profil.publik | PengunjungController@profilSiswa | pengunjung/profil-siswa |
| POST | `/proyek/{proyek}/komentar` | komentar.simpan | PengunjungController@simpanKomentar | – |

## Login dan logout

| Metode | URL | Nama route | Keterangan |
|---|---|---|---|
| GET | `/login` | login | Form login siswa |
| POST | `/login` | login.siswa.proses | Guard `siswa` |
| GET | `/login/admin` | login.admin | Form login admin |
| POST | `/login/admin` | login.admin.proses | Guard `admin` |
| POST | `/logout` | logout | Keluar dari kedua guard |

## Siswa (middleware `auth:siswa`, prefix `/siswa`, nama `siswa.*`)

| Metode | URL | Nama route |
|---|---|---|
| GET | `/siswa/dashboard` | siswa.dashboard |
| GET | `/siswa/proyek/baru` | siswa.proyek.create |
| POST | `/siswa/proyek` | siswa.proyek.store |
| GET | `/siswa/proyek/{proyek}/edit` | siswa.proyek.edit |
| PUT | `/siswa/proyek/{proyek}` | siswa.proyek.update |
| DELETE | `/siswa/proyek/{proyek}` | siswa.proyek.destroy |
| GET | `/siswa/profil` | siswa.profil |
| PUT | `/siswa/profil` | siswa.profil.update |
| POST | `/siswa/testimoni` | siswa.testimoni.simpan |

## Admin (middleware `auth:admin`, prefix `/admin`, nama `admin.*`)

| Metode | URL | Nama route |
|---|---|---|
| GET | `/admin/dashboard` | admin.dashboard |
| GET | `/admin/verifikasi` | admin.verifikasi |
| PATCH | `/admin/proyek/{proyek}/approve` | admin.proyek.approve |
| PATCH | `/admin/proyek/{proyek}/reject` | admin.proyek.reject |
| GET | `/admin/komentar` | admin.komentar |
| PATCH | `/admin/komentar/{komentar}` | admin.komentar.moderasi |
| GET | `/admin/testimoni` | admin.testimoni |
| PATCH | `/admin/testimoni/{testimoni}` | admin.testimoni.moderasi |
| resource | `/admin/kategori` | admin.kategori.* (kecuali show) |
| resource | `/admin/teknologi` | admin.teknologi.* (kecuali show) |

## Aturan

1. Siswa hanya boleh mengedit atau menghapus proyek miliknya. Pemeriksaan ini dibuat di controller (Tahap 4), dengan `abort(403)` jika bukan pemilik.
2. Siswa yang belum login diarahkan ke `/login`. Admin yang belum login diarahkan ke `/login/admin`.
3. Siswa yang mencoba membuka halaman admin akan menerima 403 (halaman `errors/403`), karena guard berbeda.
