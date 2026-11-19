<?php

namespace App\Http\Controllers;

use App\Models\Teknologi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeknologiController extends Controller
{
    public function index()
    {
        // Sementara memakai view daftar sendiri. Setelah slicing admin di-merge,
        // ganti ke 'admin.kelola-teknologi' dan pakai variabel $teknologi yang sama.
        return view('admin.teknologi.index', ['teknologi' => Teknologi::orderBy('nama_teknologi')->get()]);
    }

    public function create()
    {
        return view('admin.teknologi.form', ['teknologi' => new Teknologi()]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);

        Teknologi::create($data);

        return redirect()->route('admin.teknologi.index')
            ->with('success', 'Teknologi berhasil ditambahkan.');
    }

    public function edit(Teknologi $teknologi)
    {
        return view('admin.teknologi.form', compact('teknologi'));
    }

    public function update(Request $request, Teknologi $teknologi)
    {
        $data = $this->validasi($request, $teknologi);

        $teknologi->update($data);

        return redirect()->route('admin.teknologi.index')
            ->with('success', 'Teknologi berhasil diperbarui.');
    }

    public function destroy(Teknologi $teknologi)
    {
        // Relasi ke tb_proyek_teknologi memakai cascadeOnDelete,
        // sehingga penghapusan aman dan hanya menghapus relasinya.
        $teknologi->delete();

        return redirect()->route('admin.teknologi.index')
            ->with('success', 'Teknologi berhasil dihapus.');
    }

    private function validasi(Request $request, ?Teknologi $teknologi = null): array
    {
        return $request->validate([
            'nama_teknologi' => [
                'required', 'string', 'max:50',
                Rule::unique('tb_teknologi', 'nama_teknologi')
                    ->ignore($teknologi?->id_teknologi, 'id_teknologi'),
            ],
        ], [
            'nama_teknologi.required' => 'Nama teknologi wajib diisi.',
            'nama_teknologi.unique' => 'Nama teknologi sudah ada.',
            'nama_teknologi.max' => 'Nama teknologi maksimal 50 karakter.',
        ]);
    }
}
