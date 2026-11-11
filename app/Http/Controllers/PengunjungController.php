<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Proyek;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    public function beranda()
    {
        return view('pengunjung.index');
    }

    public function galeri(Request $request)
    {
        return view('pengunjung.galeri');
    }

    public function detailProyek(Proyek $proyek)
    {
        return view('pengunjung.detail-proyek', compact('proyek'));
    }

    public function profilSiswa(Siswa $siswa)
    {
        return view('pengunjung.profil-siswa', compact('siswa'));
    }

    public function simpanKomentar(Request $request, Proyek $proyek)
    {
        // TODO Tahap 4: validasi dan simpan komentar dengan status 'pending'
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }
}
