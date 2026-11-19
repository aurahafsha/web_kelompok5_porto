<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index()
    {
        // Sementara memakai view daftar sendiri. Setelah slicing admin di-merge,
        // ganti ke 'admin.kelola-kategori' dan pakai variabel $kategori yang sama.
        return view('admin.kategori.index', ['kategori' => Kategori::orderBy('nama_kategori')->get()]);
    }

    public function create()
    {
        return view('admin.kategori.form', ['kategori' => new Kategori()]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);

        Kategori::create($data);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.form', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $data = $this->validasi($request, $kategori);

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        // Kategori yang masih dipakai proyek tidak boleh dihapus,
        // karena tb_proyek.id_kategori tidak punya aturan ON DELETE.
        if ($kategori->proyek()->exists()) {
            return redirect()->route('admin.kategori.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih dipakai proyek.');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    private function validasi(Request $request, ?Kategori $kategori = null): array
    {
        return $request->validate([
            'nama_kategori' => [
                'required', 'string', 'max:50',
                Rule::unique('tb_kategori', 'nama_kategori')
                    ->ignore($kategori?->id_kategori, 'id_kategori'),
            ],
            'deskripsi' => ['nullable', 'string'],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
            'nama_kategori.max' => 'Nama kategori maksimal 50 karakter.',
        ]);
    }
}
