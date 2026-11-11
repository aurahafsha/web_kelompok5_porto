<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_siswa';
    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'nis', 'nama_lengkap', 'email', 'password', 'kelas', 'jurusan',
        'angkatan', 'no_hp', 'foto_profil', 'bio', 'status_akun',
    ];

    protected $hidden = ['password'];

    public function proyek()
    {
        return $this->hasMany(Proyek::class, 'id_siswa', 'id_siswa');
    }

    public function testimoni()
    {
        return $this->hasMany(Testimoni::class, 'id_siswa', 'id_siswa');
    }
}
