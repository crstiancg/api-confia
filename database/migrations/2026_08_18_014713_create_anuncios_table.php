<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('anuncios')) {
            return;
        }

        Schema::create('anuncios', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('titulo', 255);
            $table->text('mensaje');
            $table->string('grado', 100)->default('todos');
            $table->string('autor', 191)->default('Administración');
            $table->timestamp('fecha')->useCurrent();
            $table->index('grado', 'idx_anuncios_grado');
            $table->index('fecha', 'idx_anuncios_fecha');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anuncios');
    }
};
