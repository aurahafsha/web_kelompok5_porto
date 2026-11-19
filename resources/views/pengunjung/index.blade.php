@extends('layouts.app')

@section('judul', 'Beranda')

@section('konten')
<header class="navbar-landing">
    <a href="{{ route('beranda') }}" class="logo-landing">
        <img src="{{ asset('images/logo.png') }}" alt="Portofolio Siswa RPL">
    </a>

    <nav class="menu-landing">
        <a href="{{ route('beranda') }}" class="aktif">Beranda</a>
        <a href="#kategori">Kategori</a>
        <a href="{{ route('galeri') }}">Galeri</a>
        <a href="#tentang">Tentang</a>
        <a href="#ulasan">Ulasan</a>
    </nav>

    <div class="aksi-landing">
        <a href="#" class="tombol-putih">Daftar</a>
        <a href="{{ route('login') }}" class="tombol-utama">Masuk</a>
    </div>
</header>

<section class="hero" id="beranda">
    <div class="hero-kiri">
        <h1>Mulai Tunjukkan Karya, Buka Jalan Karier</h1>
        <p>Eksplorasi ribuan karya inovatif siswa. Bangun reputasi kreatif yang terhubung dengan industri, dan kelola portofolio dalam satu ruang terpadu.</p>

        <form class="form-cari" method="GET" action="{{ route('galeri') }}">
            <input type="text" name="q" placeholder="Cari inspirasi karya..." value="{{ request('q') }}">
            <button type="submit" class="tombol-utama">Jelajahi Karya</button>
        </form>
    </div>

    <div class="hero-kanan">
        <img class="ilustrasi-hero" src="{{ asset('images/hero-ilustrasi.png') }}" alt="">

        {{-- DATA CONTOH: nanti diganti data dari database --}}
        <div class="kartu-stat kartu-atas">
            <strong>#1</strong>
            <span>Dipercaya oleh Ratusan Siswa</span>
        </div>
        <div class="kartu-stat kartu-bawah">
            <strong>500+</strong>
            <span>Pengguna Aktif</span>
        </div>
    </div>
</section>

{{-- Bagian berikut mengikuti urutan Figma, belum dikerjakan --}}
<section id="kategori"></section>
<section id="galeri"></section>
<section id="tentang"></section>
<section id="ulasan"></section>
@endsection
