<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'tb_komentar';
    protected $primaryKey = 'id_komentar';

    const CREATED_AT = 'tanggal_komentar';
    const UPDATED_AT = null;

    protected $fillable = [
        'id_proyek', 'id_siswa', 'nama_pengunjung', 'email_pengunjung',
        'isi_komentar', 'status',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
