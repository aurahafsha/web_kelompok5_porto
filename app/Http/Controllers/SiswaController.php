<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function dashboard()
    {
        return view('siswa.dashboard');
    }

    public function create()
    {
        return view('siswa.upload-proyek');
    }

    public function store(Request $request)
    {
        // TODO Tahap 4: validasi, upload thumbnail dan galeri, set status 'pending'
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function edit(Proyek $proyek)
    {
        // TODO Tahap 4: pastikan proyek milik siswa yang login ($this->authorize)
        return view('siswa.edit-proyek', compact('proyek'));
    }

    public function update(Request $request, Proyek $proyek)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function destroy(Proyek $proyek)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function profil()
    {
        return view('siswa.profil-saya');
    }

    public function updateProfil(Request $request)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function simpanTestimoni(Request $request)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }
}
