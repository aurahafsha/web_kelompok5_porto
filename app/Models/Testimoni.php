<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'tb_testimoni';
    protected $primaryKey = 'id_testimoni';

    const CREATED_AT = 'tanggal';
    const UPDATED_AT = null;

    protected $fillable = ['id_siswa', 'nama', 'isi_testimoni', 'rating', 'status'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
