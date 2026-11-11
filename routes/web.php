<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TeknologiController;

/*
|--------------------------------------------------------------------------
| PENGUNJUNG (tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', [PengunjungController::class, 'beranda'])->name('beranda');
Route::get('/galeri', [PengunjungController::class, 'galeri'])->name('galeri');
Route::get('/proyek/{proyek}', [PengunjungController::class, 'detailProyek'])->name('proyek.detail');
Route::get('/profil/{siswa}', [PengunjungController::class, 'profilSiswa'])->name('profil.publik');
Route::post('/proyek/{proyek}/komentar', [PengunjungController::class, 'simpanKomentar'])->name('komentar.simpan');

/*
|--------------------------------------------------------------------------
| LOGIN & LOGOUT
|--------------------------------------------------------------------------
*/
Route::middleware('guest:siswa')->group(function () {
    Route::get('/login', [AuthController::class, 'formLoginSiswa'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSiswa'])->name('login.siswa.proses');
});

Route::middleware('guest:admin')->group(function () {
    Route::get('/login/admin', [AuthController::class, 'formLoginAdmin'])->name('login.admin');
    Route::post('/login/admin', [AuthController::class, 'loginAdmin'])->name('login.admin.proses');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| SISWA (guard: siswa)
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')->name('siswa.')->middleware('auth:siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard');

    Route::get('/proyek/baru', [SiswaController::class, 'create'])->name('proyek.create');
    Route::post('/proyek', [SiswaController::class, 'store'])->name('proyek.store');
    Route::get('/proyek/{proyek}/edit', [SiswaController::class, 'edit'])->name('proyek.edit');
    Route::put('/proyek/{proyek}', [SiswaController::class, 'update'])->name('proyek.update');
    Route::delete('/proyek/{proyek}', [SiswaController::class, 'destroy'])->name('proyek.destroy');

    Route::get('/profil', [SiswaController::class, 'profil'])->name('profil');
    Route::put('/profil', [SiswaController::class, 'updateProfil'])->name('profil.update');

    Route::post('/testimoni', [SiswaController::class, 'simpanTestimoni'])->name('testimoni.simpan');
});

/*
|--------------------------------------------------------------------------
| ADMIN (guard: admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/verifikasi', [AdminController::class, 'verifikasi'])->name('verifikasi');
    Route::patch('/proyek/{proyek}/approve', [AdminController::class, 'approve'])->name('proyek.approve');
    Route::patch('/proyek/{proyek}/reject', [AdminController::class, 'reject'])->name('proyek.reject');

    Route::get('/komentar', [AdminController::class, 'komentar'])->name('komentar');
    Route::patch('/komentar/{komentar}', [AdminController::class, 'moderasiKomentar'])->name('komentar.moderasi');

    Route::get('/testimoni', [AdminController::class, 'testimoni'])->name('testimoni');
    Route::patch('/testimoni/{testimoni}', [AdminController::class, 'moderasiTestimoni'])->name('testimoni.moderasi');

    Route::resource('kategori', KategoriController::class)->except(['show'])->names('kategori');
    Route::resource('teknologi', TeknologiController::class)->except(['show'])->names('teknologi');
});
