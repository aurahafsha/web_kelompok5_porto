<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_proyek', function (Blueprint $table) {
            $table->id('id_proyek');
            $table->foreignId('id_siswa')->constrained('tb_siswa', 'id_siswa')->cascadeOnDelete();
            $table->foreignId('id_kategori')->constrained('tb_kategori', 'id_kategori');
            $table->foreignId('id_admin_verifikator')->nullable()
                  ->constrained('tb_admin', 'id_admin')->nullOnDelete();
            $table->string('judul_proyek', 150);
            $table->text('deskripsi')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('link_demo')->nullable();
            $table->string('link_source_code')->nullable();
            $table->enum('status_proyek', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->string('catatan_verifikasi')->nullable();
            $table->unsignedInteger('jumlah_view')->default(0);
            $table->dateTime('tanggal_upload')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_proyek');
    }
};
