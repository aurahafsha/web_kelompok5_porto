<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Proyek;
use App\Models\Siswa;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admin = auth('admin')->user();
        $tahun = now()->year;

        $statistik = [
            'total_pengguna' => Siswa::count(),
            'total_karya' => Proyek::count(),
            'perlu_review' => Proyek::where('status_proyek', 'pending')->count(),
            'sudah_diproses' => Proyek::whereIn('status_proyek', ['disetujui', 'ditolak'])->count(),
        ];

        $perBulan = Proyek::selectRaw('MONTH(tanggal_upload) as bulan, COUNT(*) as jumlah')
            ->whereYear('tanggal_upload', $tahun)
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan');

        $grafikBulanan = collect(range(1, 12))
            ->map(fn ($bulan) => $perBulan[$bulan] ?? 0)
            ->values();

        $kategori = Kategori::withCount('proyek')->get();

        $proyekTerbaru = Proyek::with(['siswa', 'kategori'])
            ->latest('tanggal_upload')
            ->paginate(5);

        return view('admin.dashboard', compact(
            'admin', 'tahun', 'statistik', 'grafikBulanan', 'kategori', 'proyekTerbaru'
        ));
    }

    public function verifikasi()
    {
        return view('admin.verifikasi-proyek');
    }

    public function approve(Proyek $proyek)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function reject(Request $request, Proyek $proyek)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function komentar()
    {
        return view('admin.moderasi-komentar');
    }

    public function moderasiKomentar(Request $request, Komentar $komentar)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function testimoni()
    {
        return view('admin.moderasi-testimoni');
    }

    public function moderasiTestimoni(Request $request, Testimoni $testimoni)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }
}