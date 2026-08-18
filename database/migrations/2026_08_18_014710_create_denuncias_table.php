<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('denuncias')) {
            return;
        }

        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->string('grado', 100);
            $table->string('tipo', 100);
            $table->text('descripcion');
            $table->enum('estado', ['pendiente', 'en_revision', 'atendida'])->default('pendiente');
            $table->timestamp('fecha')->useCurrent();
            $table->index('fecha', 'idx_denuncias_fecha');
            $table->index('grado', 'idx_denuncias_grado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('denuncias');
    }
};
