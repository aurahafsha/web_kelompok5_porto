{{-- SEMENTARA: daftar CRUD fungsional. Diganti versi Figma setelah slicing admin di-merge. --}}
@extends('layouts.app')
@section('judul', 'Kelola Kategori')
@section('konten')
<main>
    <h1>Kelola Kategori</h1>

    @if (session('success')) <p><strong>{{ session('success') }}</strong></p> @endif
    @if (session('error')) <p style="color:red"><strong>{{ session('error') }}</strong></p> @endif

    <p><a href="{{ route('admin.kategori.create') }}">+ Tambah kategori</a></p>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr><th>No</th><th>Nama</th><th>Deskripsi</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        @forelse ($kategori as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_kategori }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>
                    <a href="{{ route('admin.kategori.edit', $item) }}">Ubah</a>
                    <form method="POST" action="{{ route('admin.kategori.destroy', $item) }}" style="display:inline"
                          onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Belum ada kategori.</td></tr>
        @endforelse
        </tbody>
    </table>
</main>
@endsection
