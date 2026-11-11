<?php

namespace App\Http\Controllers;

use App\Models\Teknologi;
use Illuminate\Http\Request;

class TeknologiController extends Controller
{
    public function index()
    {
        return view('admin.kelola-teknologi', ['teknologi' => Teknologi::all()]);
    }

    public function create()
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function store(Request $request)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function edit(Teknologi $teknologi)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function update(Request $request, Teknologi $teknologi)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }

    public function destroy(Teknologi $teknologi)
    {
        abort(501, 'Belum diimplementasikan (Tahap 4)');
    }
}
