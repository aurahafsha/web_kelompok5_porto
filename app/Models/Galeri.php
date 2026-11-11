<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'tb_galeri';
    protected $primaryKey = 'id_galeri';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected $fillable = ['id_proyek', 'nama_file', 'urutan', 'keterangan'];
}
