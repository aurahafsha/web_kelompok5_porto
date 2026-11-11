<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'tb_kategori';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;

    protected $fillable = ['nama_kategori', 'deskripsi', 'icon'];

    public function proyek()
    {
        return $this->hasMany(Proyek::class, 'id_kategori', 'id_kategori');
    }
}
