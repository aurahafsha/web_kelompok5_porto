<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    protected $table = 'tb_proyek';
    protected $primaryKey = 'id_proyek';

    protected $fillable = [
        'id_siswa', 'id_kategori', 'id_admin_verifikator', 'judul_proyek',
        'deskripsi', 'thumbnail', 'link_demo', 'link_source_code',
        'status_proyek', 'catatan_verifikasi', 'jumlah_view', 'tanggal_upload',
    ];

    protected $casts = ['tanggal_upload' => 'datetime'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function verifikator()
    {
        return $this->belongsTo(Admin::class, 'id_admin_verifikator', 'id_admin');
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class, 'id_proyek', 'id_proyek')->orderBy('urutan');
    }

    public function teknologi()
    {
        return $this->belongsToMany(Teknologi::class, 'tb_proyek_teknologi', 'id_proyek', 'id_teknologi');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'id_proyek', 'id_proyek');
    }

    public function statistik()
    {
        return $this->hasMany(StatistikView::class, 'id_proyek', 'id_proyek');
    }
}
