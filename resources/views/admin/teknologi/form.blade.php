{{-- SEMENTARA: form CRUD fungsional. Diganti versi Figma setelah slicing admin di-merge. --}}
@extends('layouts.app')
@section('judul', $teknologi->exists ? 'Ubah Teknologi' : 'Tambah Teknologi')
@section('konten')
<main>
    <h1>{{ $teknologi->exists ? 'Ubah Teknologi' : 'Tambah Teknologi' }}</h1>

    <form method="POST"
          action="{{ $teknologi->exists ? route('admin.teknologi.update', $teknologi) : route('admin.teknologi.store') }}">
        @csrf
        @if ($teknologi->exists) @method('PUT') @endif

        <p>
            <label>Nama teknologi<br>
                <input type="text" name="nama_teknologi" value="{{ old('nama_teknologi', $teknologi->nama_teknologi) }}">
            </label>
            @error('nama_teknologi') <br><span style="color:red">{{ $message }}</span> @enderror
        </p>

        <button type="submit">Simpan</button>
        <a href="{{ route('admin.teknologi.index') }}">Batal</a>
    </form>
</main>
@endsection
