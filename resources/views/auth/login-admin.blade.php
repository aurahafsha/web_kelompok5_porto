@extends('layouts.app')

@section('judul', 'Login Admin')

@section('css')
<style>
    .login-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        background: var(--warna-latar, #fdf2f8);
        font-family: var(--font-utama, 'Inter', sans-serif);
    }

.login-card {
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
.login-kiri {
    position: relative;
    padding: 40px;
    display: flex;
    flex-direction: column;
    background-color: #d4c8c3;
    overflow: hidden;
}

/* Lapisan 1: gambar latar, opacity 85% (sesuai Figma: Image 85%) */
.login-kiri::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: url("{{ asset('images/backgroundfill.jpg') }}");
    background-size: cover;
    background-position: center;
    opacity: 0.85;
    z-index: 0;
}

.login-kiri::after {
    content: "";
    position: absolute;
    inset: 0;
    background: #ffffff;
    opacity: 0.15;
    z-index: 0;
}

.login-kiri > * {
    position: relative;
    z-index: 1;
}

.login-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--warna-utama, #ec4899);
    font-size: 15px;
    font-weight: 500;
}

.login-brand img {
    width: 75px;
    height: 75px;
    object-fit: contain;
    flex-shrink: 0;
}

    .login-kiri h2 {
        margin: 60px 0 10px;
        font-size: 22px;
        font-weight: 600;
        color: var(--warna-teks, #4a0d2b);
    }

    .login-kiri p {
        margin: 0;
        font-size: 14px;
        line-height: 1.6;
        color: var(--warna-teks, #4a0d2b);
    }

.login-ilustrasi {
    display: block;
    width: 250px;
    height: auto;
    margin: auto auto;
    position: relative;
    z-index: 1;
}
.login-geser {
    position: relative;
    z-index: 1;
    width: 405px;
    max-width: 100%;
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

.login-geser p {
    margin: 0;
    font-size: 16px;
    line-height: 1.5;
    color: var(--warna-utama, #ec4899);
}

.login-dots {
    display: flex;
    justify-content: center;
    gap: 8px;
}

.login-dots span {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: rgba(236, 72, 153, 0.35);
}

.login-dots span.aktif {
    background: var(--warna-utama, #ec4899);
}

    /* ===== Panel kanan ===== */
    .login-kanan {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 48px 56px;
    }

    .login-kanan h1 {
        margin: 0 0 6px;
        font-size: 26px;
        font-weight: 600;
        color: var(--warna-teks, #4a0d2b);
    }

    .login-sub {
        margin: 0 0 24px;
        font-size: 13px;
        color: var(--warna-teks-muted, #6b7280);
    }

    .login-tab {
        display: flex;
        border-bottom: 1px solid #f5d5e6;
        margin-bottom: 24px;
    }

    .login-tab button {
        flex: 1;
        background: none;
        border: none;
        padding: 8px 0 10px;
        font-family: var(--font-utama, 'Inter', sans-serif);
        font-size: 13px;
        color: #8a4a66;
        cursor: pointer;
    }

    .login-tab button.aktif {
        color: var(--warna-teks, #4a0d2b);
        border-bottom: 2px solid var(--warna-teks, #4a0d2b);
        margin-bottom: -1px;
    }

    .login-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 13px;
        color: #fff;
        margin-bottom: 18px;
    }

    .login-alert.gagal { background: var(--warna-error, #e53e3e); }
    .login-alert.sukses { background: var(--warna-sukses, #16a34a); }

    .login-form {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .login-form > label {
        display: flex;
        flex-direction: column;
        gap: 8px;
        font-size: 13px;
        font-weight: 500;
        color: var(--warna-teks, #4a0d2b);
    }

    .login-input {
        display: flex;
        align-items: center;
        gap: 10px;
        height: 46px;
        border: 1px solid #f5d5e6;
        border-radius: 12px;
        padding: 0 14px;
        background: #fff;
    }

    .login-input:focus-within {
        border-color: var(--warna-utama, #ec4899);
    }

    .login-input svg {
        flex-shrink: 0;
        color: #9ca3af;
    }

    .login-input input {
        flex: 1;
        height: 100%;
        border: none;
        outline: none;
        font-size: 14px;
        font-family: var(--font-utama, 'Inter', sans-serif);
        background: transparent;
    }

    .login-input input::placeholder {
        color: #9ca3af;
    }

    .login-opsi {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        margin-top: -4px;
    }

    .login-opsi label {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--warna-utama, #ec4899);
    }

    .login-opsi a {
        color: var(--warna-teks, #4a0d2b);
        text-decoration: none;
    }

    .login-tombol {
        height: 46px;
        border: none;
        border-radius: 12px;
        background: linear-gradient(90deg, #fce7f3 0%, #ec4899 100%);
        color: #fff;
        font-family: var(--font-utama, 'Inter', sans-serif);
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
    }

    .login-tombol:hover {
        opacity: 0.92;
    }

    .login-divider {
        text-align: center;
        margin: 24px 0 16px;
        font-size: 11px;
        color: var(--warna-teks-muted, #6b7280);
        letter-spacing: 0.05em;
    }

    .login-sosial {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .login-sosial button {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 42px;
        border: 1px solid #f5d5e6;
        border-radius: 12px;
        background: #fff;
        font-family: var(--font-utama, 'Inter', sans-serif);
        font-size: 13px;
        color: var(--warna-teks, #4a0d2b);
        cursor: pointer;
    }

    .login-daftar {
        margin-top: 22px;
        text-align: center;
        font-size: 12px;
        color: var(--warna-teks-muted, #6b7280);
    }

    .login-daftar a {
        color: var(--warna-utama, #ec4899);
        text-decoration: none;
        font-weight: 500;
    }

    @media (max-width: 800px) {
        .login-card { grid-template-columns: 1fr; }
        .login-kiri { display: none; }
        .login-kanan { padding: 32px 24px; }
    }
</style>
@endsection

@section('konten')
<main class="login-page">
    <div class="login-card">

        {{-- Panel kiri --}}
        <section class="login-kiri">
            <div class="login-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Projects Studio" width="36" height="32"
                     onerror="this.style.display='none'">
                Projects Studio
            </div>

            <h2>Selamat datang kembali!</h2>
            <p>Masuk ke akun Anda untuk melanjutkan ke Projects Studio.</p>

            <img class="login-ilustrasi" src="{{ asset('images/login-ilustrasi.png') }}" alt=""
                 onerror="this.style.display='none'">

            <div class="login-geser">
                <p>Tempat terbaik untuk melihat karya-karya hebat siswa</p>
                <div class="login-dots">
                    <span class="aktif"></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </section>

        {{-- Panel kanan --}}
        <section class="login-kanan">
            <h1>Login ke Akun Anda</h1>
            <p class="login-sub">Masukkan email dan password untuk melanjutkan.</p>

            <div class="login-tab">
                <button type="button" class="aktif">Email</button>
                <button type="button">Nama Lengkap</button>
            </div>

            @if ($errors->any())
                <div class="login-alert gagal">
                    <span>✕</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if (session('success'))
                <div class="login-alert sukses">
                    <span>✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form class="login-form" method="POST" action="{{ route('login.admin.proses') }}">
                @csrf

                <label>
                    Email
                    <span class="login-input">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>
                        </svg>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="Masukkan email Anda" autofocus>
                    </span>
                </label>

                <label>
                    Kata Sandi
                    <span class="login-input">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/>
                        </svg>
                        <input type="password" name="password" placeholder="Masukkan kata sandi">
                    </span>
                </label>

                <div class="login-opsi">
                    <label>
                        <input type="checkbox" name="remember" value="1" style="accent-color: #ec4899;">
                        Ingat Saya
                    </label>
                    <a href="#">Lupa kata sandi?</a>
                </div>

                <button type="submit" class="login-tombol">Masuk</button>
            </form>

            <div class="login-divider">ATAU MASUK DENGAN</div>

            <div class="login-sosial">
                <button type="button">
                    <svg width="18" height="18" viewBox="0 0 48 48" aria-hidden="true">
                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                        <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                    </svg>
                    Google
                </button>
                <button type="button">
                    <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="12" cy="12" r="12" fill="#1877F2"/>
                        <path fill="#fff" d="M13.5 19.5v-6.2h2.1l.3-2.4h-2.4V9.4c0-.7.2-1.2 1.2-1.2h1.3V6.1c-.2 0-1-.1-1.9-.1-1.9 0-3.2 1.2-3.2 3.3v1.8H9.8v2.4h2.1v6.2h1.6z"/>
                    </svg>
                    Facebook
                </button>
            </div>

            <p class="login-daftar">
                Belum punya akun? <a href="#">Daftar</a>
            </p>
        </section>

    </div>
</main>
@endsection
