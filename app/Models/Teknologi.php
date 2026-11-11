<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teknologi extends Model
{
    protected $table = 'tb_teknologi';
    protected $primaryKey = 'id_teknologi';
    public $timestamps = false;

    protected $fillable = ['nama_teknologi', 'icon'];

    public function proyek()
    {
        return $this->belongsToMany(Proyek::class, 'tb_proyek_teknologi', 'id_teknologi', 'id_proyek');
    }
}
