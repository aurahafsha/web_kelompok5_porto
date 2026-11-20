@extends('layouts.app')

@section('judul', 'Dashboard Admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('konten')
@php
    $warna = ['#ec4899', '#a855f7', '#3b82f6', '#22c55e', '#f59e0b'];
@endphp

<div class="admin-wrap">
    <aside class="admin-sidebar">
        <div class="admin-logo">Projects Studio</div>

        <nav class="admin-menu">
            <a href="{{ route('admin.dashboard') }}" class="aktif">Dasbor</a>
            <a href="{{ route('admin.verifikasi') }}">Karya Siswa</a>
            <a href="{{ route('admin.kategori.index') }}">Kategori</a>
            <a href="{{ route('admin.komentar') }}">Komentar</a>
            <a href="#">Profil Siswa</a>
            <a href="#">Pengaturan</a>
        </nav>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="admin-keluar">Keluar</button>
        </form>
    </aside>

    <main class="admin-konten">
        <header class="admin-header">
            <div>
                <h1>Halo, {{ $admin->nama_lengkap }}!</h1>
                <p>Berikut adalah informasi mengenai semua karya siswa.</p>
            </div>
            <div class="admin-profil">Admin</div>
        </header>

        <section class="kartu-ringkasan">
            <div class="kartu-stat-admin">
                <span>Total Pengguna</span>
                <strong>{{ $statistik['total_pengguna'] }}</strong>
            </div>
            <div class="kartu-stat-admin">
                <span>Total Karya</span>
                <strong>{{ $statistik['total_karya'] }}</strong>
            </div>
            <div class="kartu-stat-admin">
                <span>Perlu Direview</span>
                <strong>{{ $statistik['perlu_review'] }}</strong>
            </div>
            <div class="kartu-stat-admin">
                <span>Sudah Diproses</span>
                <strong>{{ $statistik['sudah_diproses'] }}</strong>
            </div>
        </section>

        <section class="grid-grafik">
            <div class="kartu-besar">
                <div class="judul-kartu">
                    <div>
                        <h2>Aktivitas Karya</h2>
                        <p>Jumlah karya yang diunggah setiap bulan</p>
                    </div>
                    <span class="filter">{{ $tahun }}</span>
                </div>
                <canvas id="grafikAktivitas" height="120"></canvas>
            </div>

            <div class="kartu-besar">
                <div class="judul-kartu">
                    <div>
                        <h2>Kategori Karya</h2>
                        <p>Jumlah penggunaan kategori</p>
                    </div>
                </div>
                <canvas id="grafikKategori"></canvas>
                <ul class="legenda">
                    @foreach ($kategori as $item)
                        <li>
                            <span style="background: {{ $warna[$loop->index % count($warna)] }}"></span>
                            {{ $item->nama_kategori }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="kartu-besar">
            <div class="judul-kartu">
                <div>
                    <h2>Karya Terbaru</h2>
                </div>
            </div>

            <table class="tabel-admin">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Karya</th>
                        <th>Tanggal Unggah</th>
                        <th>Terakhir Diperbarui</th>
                        <th>Pemilik</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($proyekTerbaru as $proyek)
                    @php
                        [$labelStatus, $warnaStatus] = match ($proyek->status_proyek) {
                            'disetujui' => ['Publikasi', '#22c55e'],
                            'ditolak' => ['Ditolak', '#ef4444'],
                            default => ['Review', '#f59e0b'],
                        };
                    @endphp
                    <tr>
                        <td>{{ $proyekTerbaru->firstItem() + $loop->index }}</td>
                        <td>{{ $proyek->judul_proyek }}</td>
                        <td>{{ $proyek->tanggal_upload?->format('d M Y') }}</td>
                        <td>{{ $proyek->updated_at?->format('d M Y') }}</td>
                        <td>{{ $proyek->siswa->nama_lengkap ?? '-' }}</td>
                        <td>{{ $proyek->kategori->nama_kategori ?? '-' }}</td>
                        <td>
                            <span class="status" style="--warna-status: {{ $warnaStatus }}">{{ $labelStatus }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.verifikasi') }}" class="tombol-aksi">Periksa</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8">Belum ada karya.</td></tr>
                @endforelse
                </tbody>
            </table>

            <div class="paginasi">
                {{ $proyekTerbaru->links() }}
            </div>
        </section>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const warna = @json($warna);

    new Chart(document.getElementById('grafikAktivitas'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                data: @json($grafikBulanan),
                borderColor: warna[0],
                backgroundColor: 'rgba(236, 72, 153, 0.1)',
                tension: 0.4,
                fill: true,
            }],
        },
        options: { plugins: { legend: { display: false } } },
    });

    new Chart(document.getElementById('grafikKategori'), {
        type: 'doughnut',
        data: {
            labels: @json($kategori->pluck('nama_kategori')),
            datasets: [{
                data: @json($kategori->pluck('proyek_count')),
                backgroundColor: warna,
            }],
        },
        options: { cutout: '70%', plugins: { legend: { display: false } } },
    });
</script>
@endsection
