<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Kategori;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['username' => 'admin1'],
            [
                'password' => Hash::make('admin123'),
                'nama_lengkap' => 'Administrator',
                'email' => 'admin1@sekolah.sch.id',
            ]
        );

        $siswa = [
            ['nis' => '1001', 'nama_lengkap' => 'Aura Hafsha Trisna Anggira', 'email' => 'aura@sekolah.sch.id'],
            ['nis' => '1002', 'nama_lengkap' => 'Muhammad Surya Bayu Saputra', 'email' => 'surya@sekolah.sch.id'],
            ['nis' => '1003', 'nama_lengkap' => 'Syafira Eka Wijayanti', 'email' => 'syafira@sekolah.sch.id'],
            ['nis' => '1004', 'nama_lengkap' => 'Vincent', 'email' => 'vincent@sekolah.sch.id'],
            ['nis' => '1005', 'nama_lengkap' => 'Dinda', 'email' => 'dinda@sekolah.sch.id'],
        ];

        foreach ($siswa as $data) {
            Siswa::updateOrCreate(
                ['email' => $data['email']],
                $data + [
                    'password' => Hash::make('siswa123'),
                    'kelas' => 'XII RPL',
                    'jurusan' => 'Rekayasa Perangkat Lunak',
                    'status_akun' => 'aktif',
                ]
            );
        }

        foreach (['Aplikasi Web', 'Game', 'Aplikasi Mobile'] as $nama) {
            Kategori::updateOrCreate(['nama_kategori' => $nama], ['deskripsi' => null]);
        }
    }
}
