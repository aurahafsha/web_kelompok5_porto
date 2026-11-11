<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_komentar', function (Blueprint $table) {
            $table->id('id_komentar');
            $table->foreignId('id_proyek')->constrained('tb_proyek', 'id_proyek')->cascadeOnDelete();
            $table->foreignId('id_siswa')->nullable()->constrained('tb_siswa', 'id_siswa')->nullOnDelete();
            $table->string('nama_pengunjung', 100)->nullable();
            $table->string('email_pengunjung', 100)->nullable();
            $table->text('isi_komentar');
            $table->enum('status', ['pending', 'tampil', 'ditolak'])->default('pending');
            $table->dateTime('tanggal_komentar')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_komentar');
    }
};
