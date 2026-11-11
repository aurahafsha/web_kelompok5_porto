<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_statistik_view', function (Blueprint $table) {
            $table->id('id_log');
            $table->foreignId('id_proyek')->constrained('tb_proyek', 'id_proyek')->cascadeOnDelete();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->dateTime('tanggal_akses')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_statistik_view');
    }
};
