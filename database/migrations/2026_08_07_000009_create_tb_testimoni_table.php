<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_testimoni', function (Blueprint $table) {
            $table->id('id_testimoni');
            $table->foreignId('id_siswa')->constrained('tb_siswa', 'id_siswa')->cascadeOnDelete();
            $table->string('nama', 100);
            $table->text('isi_testimoni');
            $table->unsignedTinyInteger('rating');
            $table->enum('status', ['pending', 'tampil', 'ditolak'])->default('pending');
            $table->dateTime('tanggal')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_testimoni');
    }
};
