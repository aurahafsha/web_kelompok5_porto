<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Proyek;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
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
