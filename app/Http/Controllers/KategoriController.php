<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('admin.kelola-kategori', ['kategori' => Kategori::all()]);
    }

    public function create()
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function store(Request $request)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function edit(Kategori $kategori)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function update(Request $request, Kategori $kategori)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function destroy(Kategori $kategori)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }
}
