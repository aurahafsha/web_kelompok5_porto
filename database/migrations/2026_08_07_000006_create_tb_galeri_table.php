<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_galeri', function (Blueprint $table) {
            $table->id('id_galeri');
            $table->foreignId('id_proyek')->constrained('tb_proyek', 'id_proyek')->cascadeOnDelete();
            $table->string('nama_file');
            $table->unsignedInteger('urutan')->default(0);
            $table->string('keterangan', 150)->nullable();
            $table->dateTime('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_galeri');
    }
};
