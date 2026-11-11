<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_proyek_teknologi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proyek')->constrained('tb_proyek', 'id_proyek')->cascadeOnDelete();
            $table->foreignId('id_teknologi')->constrained('tb_teknologi', 'id_teknologi')->cascadeOnDelete();
            $table->unique(['id_proyek', 'id_teknologi']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_proyek_teknologi');
    }
};
