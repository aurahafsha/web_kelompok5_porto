@extends('layouts.app')

@section('judul', 'Login Admin')

@section('css')
<style>
    .login-wrap {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--warna-utama-terang), #fdf2f8);
        padding: 24px;
    }

    .login-kartu {
        width: 100%;
        max-width: 380px;
        background: #fff;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
    }

    .login-logo {
        font-weight: 600;
        color: var(--warna-utama);
        margin-bottom: 20px;
    }

    .login-kartu h1 {
        font-size: 22px;
        margin: 0 0 6px;
        color: var(--warna-teks);
    }

    .login-sub {
        font-size: 13px;
        color: #6b7280;
        margin: 0 0 24px;
    }

    .login-kartu form {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .login-kartu label {
        display: flex;
        flex-direction: column;
        gap: 6px;
        font-size: 13px;
        color: var(--warna-teks);
    }

    .login-kartu input {
        padding: 10px 12px;
        border: 1px solid #f3d0e2;
        border-radius: var(--radius-kartu);
        font-size: 14px;
        outline: none;
    }

    .login-kartu input:focus {
        border-color: var(--warna-utama);
    }

    .login-kartu button {
        background: var(--warna-utama);
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 12px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
    }

    .login-error {
        background: #fef2f2;
        color: #b91c1c;
        border-radius: var(--radius-kartu);
        padding: 10px 12px;
        font-size: 13px;
        margin-bottom: 16px;
    }

    .login-alih {
        display: block;
        text-align: center;
        margin-top: 20px;
        font-size: 13px;
        color: var(--warna-utama);
        text-decoration: none;
    }
</style>
@endsection

@section('konten')
<main class="login-wrap">
    <div class="login-kartu">
        <div class="login-logo">Projects Studio</div>

        <h1>Masuk sebagai Admin</h1>
        <p class="login-sub">Kelola karya siswa dan verifikasi proyek.</p>

        @if ($errors->any())
            <div class="login-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login.admin.proses') }}">
            @csrf

            <label>
                Username
                <input type="text" name="username" value="{{ old('username') }}" autofocus>
            </label>

            <label>
                Kata sandi
                <input type="password" name="password">
            </label>

            <button type="submit">Masuk</button>
        </form>

        <a href="{{ route('login') }}" class="login-alih">Masuk sebagai siswa</a>
    </div>
</main>
@endsection
