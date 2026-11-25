@extends('layouts.app')

@section('judul', 'Daftar')

@section('css')
<style>
    .daftar-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        background: var(--warna-latar, #fdf2f8);
        font-family: var(--font-utama, 'Inter', sans-serif);
    }

    .daftar-card {
        display: grid;
        grid-template-columns: 1fr 1fr;
        width: 100%;
        max-width: 960px;
        min-height: 600px;
        background: #fff;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.08);
    }

    /* ===== Panel kiri ===== */
    .daftar-kiri {
        position: relative;
        padding: 40px;
        display: flex;
        flex-direction: column;
        background-color: #d4c8c3;
        overflow: hidden;
    }

    .daftar-kiri::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: url("{{ asset('images/backgroundfill.jpg') }}");
        background-size: cover;
        background-position: center;
        opacity: 0.85;
        z-index: 0;
    }

    .daftar-kiri::after {
        content: "";
        position: absolute;
        inset: 0;
        background: #ffffff;
        opacity: 0.15;
        z-index: 0;
    }

    .daftar-kiri > * {
        position: relative;
        z-index: 1;
    }

    .daftar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--warna-utama, #ec4899);
        font-size: 15px;
        font-weight: 500;
    }

    .daftar-brand img {
        width: 75px;
        height: 75px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .daftar-kiri h2 {
        margin: 40px 0 10px;
        font-size: 22px;
        line-height: 1.25;
        font-weight: 600;
        color: var(--warna-teks, #4a0d2b);
    }

    .daftar-kiri p {
        margin: 0;
        font-size: 14px;
        line-height: 1.6;
        color: var(--warna-teks, #4a0d2b);
    }

    .daftar-ilustrasi {
        display: block;
        width: 250px;
        height: auto;
        margin: auto auto;
        position: relative;
        z-index: 1;
    }

    .daftar-geser {
        position: relative;
        z-index: 1;
        width: 100%;
        height: 145px;
        box-sizing: border-box;
        margin-top: auto;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 14px;
        padding: 28px 24px 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        text-align: center;
    }

    .daftar-geser p {
        margin: 0;
        font-size: 16px;
        line-height: 1.5;
        color: var(--warna-utama, #ec4899);
    }

    .daftar-dots {
        display: flex;
        justify-content: center;
        gap: 8px;
    }

    .daftar-dots span {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: rgba(236, 72, 153, 0.35);
    }

    .daftar-dots span.aktif {
        background: var(--warna-utama, #ec4899);
    }

    /* ===== Panel kanan ===== */
    .daftar-kanan {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 40px 48px;
    }

    .daftar-form-wrap {
        width: 100%;
        max-width: 320px;
        margin: 0 auto;
    }

    .daftar-kanan h1 {
        margin: 0 0 6px;
        font-size: 24px;
        font-weight: 600;
        color: #7a1a3a;
    }

    .daftar-sub {
        margin: 0 0 22px;
        font-size: 12px;
        color: var(--warna-teks-muted, #6b7280);
    }

    .daftar-form {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .daftar-form > label {
        display: flex;
        flex-direction: column;
        gap: 6px;
        font-size: 12px;
        font-weight: 500;
        color: var(--warna-teks, #4a0d2b);
    }

    .daftar-input {
        display: flex;
        align-items: center;
        gap: 10px;
        height: 40px;
        border: 1px solid #f5d5e6;
        border-radius: 10px;
        padding: 0 12px;
        background: #fff;
    }

    .daftar-input:focus-within {
        border-color: var(--warna-utama, #ec4899);
    }

    .daftar-input svg {
        flex-shrink: 0;
        color: #9ca3af;
    }

    .daftar-input input {
        flex: 1;
        height: 100%;
        border: none;
        outline: none;
        font-size: 12px;
        font-family: var(--font-utama, 'Inter', sans-serif);
        background: transparent;
    }

    .daftar-input input::placeholder {
        color: #9ca3af;
    }

    .daftar-setuju {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-top: 2px;
        font-size: 10px;
        color: var(--warna-utama, #ec4899);
        line-height: 1.4;
    }

    .daftar-setuju svg {
        flex-shrink: 0;
        margin-top: 1px;
    }

    .daftar-tombol {
        height: 40px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(90deg, #fce7f3 0%, #ec4899 100%);
        color: #fff;
        font-family: var(--font-utama, 'Inter', sans-serif);
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
    }

    .daftar-tombol:hover {
        opacity: 0.92;
    }

    .daftar-divider {
        text-align: center;
        margin: 20px 0 12px;
        font-size: 9px;
        letter-spacing: 0.06em;
        color: var(--warna-teks-muted, #6b7280);
    }

    .daftar-sosial {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .daftar-sosial button {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        height: 34px;
        border: 1px solid #f5d5e6;
        border-radius: 10px;
        background: #fff;
        font-family: var(--font-utama, 'Inter', sans-serif);
        font-size: 11px;
        color: var(--warna-teks, #4a0d2b);
        cursor: pointer;
    }

    .daftar-footer {
        margin-top: 16px;
        text-align: center;
        font-size: 10px;
        color: var(--warna-teks-muted, #6b7280);
    }

    .daftar-footer a {
        color: var(--warna-utama, #ec4899);
        text-decoration: none;
        font-weight: 600;
    }

    .daftar-alert {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        border-radius: 10px;
        font-size: 11px;
        color: #fff;
        background: var(--warna-error, #e53e3e);
        margin-bottom: 12px;
    }

    @media (max-width: 800px) {
        .daftar-card { grid-template-columns: 1fr; }
        .daftar-kiri { display: none; }
        .daftar-kanan { padding: 32px 24px; }
    }
</style>
@endsection

@section('konten')
<main class="daftar-page">
    <div class="daftar-card">

        {{-- Panel kiri --}}
        <section class="daftar-kiri">
            <div class="daftar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Projects Studio"
                     onerror="this.style.display='none'">
                Projects Studio
            </div>

            <h2>Bangun Karyamu,<br>Tunjukkan Kreativitasmu.</h2>
            <p>Bergabung dengan Projects Studio dan bagikan karya terbaikmu bersama komunitas siswa.</p>

            <img class="daftar-ilustrasi" src="{{ asset('images/login-ilustrasi.png') }}" alt=""
                 onerror="this.style.display='none'">

            <div class="daftar-geser">
                <p>Tempat terbaik untuk melihat karya-karya hebat siswa</p>
                <div class="daftar-dots">
                    <span class="aktif"></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </section>

        {{-- Panel kanan --}}
        <section class="daftar-kanan">
            <div class="daftar-form-wrap">
                <h1>Buat akun Anda!</h1>
                <p class="daftar-sub">Isi data di bawah ini untuk membuat akun Anda.</p>

                @if ($errors->any())
                    <div class="daftar-alert">
                        <span>✕</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form class="daftar-form" method="POST" onsubmit="event.preventDefault();">
                    @csrf

                    <label>
                        Nama Lengkap
                        <span class="daftar-input">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="8" r="4"/><path d="M4 21v-1a6 6 0 0 1 12 0v1"/>
                            </svg>
                            <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap">
                        </span>
                    </label>

                    <label>
                        Email
                        <span class="daftar-input">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>
                            </svg>
                            <input type="email" name="email" placeholder="Masukkan email Anda">
                        </span>
                    </label>

                    <label>
                        Kata Sandi
                        <span class="daftar-input">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/>
                            </svg>
                            <input type="password" name="password" placeholder="Masukkan kata sandi">
                        </span>
                    </label>

                    <label>
                        Konfirmasi Kata Sandi
                        <span class="daftar-input">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/>
                            </svg>
                            <input type="password" name="password_confirmation" placeholder="Masukkan kata sandi">
                        </span>
                    </label>

                    <div class="daftar-setuju">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="9"/><path d="M8.5 12.5l2.5 2.5 4.5-5"/>
                        </svg>
                        <span>Saya menyetujui <a href="#" style="color:inherit">Syarat &amp; Ketentuan</a> dan <a href="#" style="color:inherit">Kebijakan Privasi</a></span>
                    </div>

                    <button type="submit" class="daftar-tombol">Daftar Sekarang</button>
                </form>

                <div class="daftar-divider">ATAU MASUK DENGAN</div>

                <div class="daftar-sosial">
                    <button type="button">
                        <svg width="14" height="14" viewBox="0 0 48 48" aria-hidden="true">
                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                        </svg>
                        Google
                    </button>
                    <button type="button">
                        <svg width="14" height="14" viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="12" r="12" fill="#1877F2"/>
                            <path fill="#fff" d="M13.5 19.5v-6.2h2.1l.3-2.4h-2.4V9.4c0-.7.2-1.2 1.2-1.2h1.3V6.1c-.2 0-1-.1-1.9-.1-1.9 0-3.2 1.2-3.2 3.3v1.8H9.8v2.4h2.1v6.2h1.6z"/>
                        </svg>
                        Facebook
                    </button>
                </div>

                <p class="daftar-footer">
                    Belum punya akun? <a href="#">Daftar</a>
                </p>
            </div>
        </section>

    </div>
</main>
@endsection
