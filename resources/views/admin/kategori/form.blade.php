{{-- SEMENTARA: form CRUD fungsional. Diganti versi Figma setelah slicing admin di-merge. --}}
@extends('layouts.app')
@section('judul', $kategori->exists ? 'Ubah Kategori' : 'Tambah Kategori')
@section('konten')
<main>
    <h1>{{ $kategori->exists ? 'Ubah Kategori' : 'Tambah Kategori' }}</h1>

    <form method="POST"
          action="{{ $kategori->exists ? route('admin.kategori.update', $kategori) : route('admin.kategori.store') }}">
        @csrf
        @if ($kategori->exists) @method('PUT') @endif

        <p>
            <label>Nama kategori<br>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
            </label>
            @error('nama_kategori') <br><span style="color:red">{{ $message }}</span> @enderror
        </p>

        <p>
            <label>Deskripsi<br>
                <textarea name="deskripsi" rows="4" cols="40">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
            </label>
            @error('deskripsi') <br><span style="color:red">{{ $message }}</span> @enderror
        </p>

        <button type="submit">Simpan</button>
        <a href="{{ route('admin.kategori.index') }}">Batal</a>
    </form>
</main>
@endsection
