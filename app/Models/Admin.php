<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = ['username', 'password', 'nama_lengkap', 'email', 'foto'];

    protected $hidden = ['password'];
}
