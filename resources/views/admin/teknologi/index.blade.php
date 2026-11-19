{{-- SEMENTARA: daftar CRUD fungsional. Diganti versi Figma setelah slicing admin di-merge. --}}
@extends('layouts.app')
@section('judul', 'Kelola Teknologi')
@section('konten')
<main>
    <h1>Kelola Teknologi</h1>

    @if (session('success')) <p><strong>{{ session('success') }}</strong></p> @endif

    <p><a href="{{ route('admin.teknologi.create') }}">+ Tambah teknologi</a></p>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr><th>No</th><th>Nama</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        @forelse ($teknologi as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_teknologi }}</td>
                <td>
                    <a href="{{ route('admin.teknologi.edit', $item) }}">Ubah</a>
                    <form method="POST" action="{{ route('admin.teknologi.destroy', $item) }}" style="display:inline"
                          onsubmit="return confirm('Hapus teknologi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">Belum ada teknologi.</td></tr>
        @endforelse
        </tbody>
    </table>
</main>
@endsection
