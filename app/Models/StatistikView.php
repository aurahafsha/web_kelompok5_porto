<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikView extends Model
{
    protected $table = 'tb_statistik_view';
    protected $primaryKey = 'id_log';

    const CREATED_AT = 'tanggal_akses';
    const UPDATED_AT = null;

    protected $fillable = ['id_proyek', 'ip_address', 'user_agent'];
}
