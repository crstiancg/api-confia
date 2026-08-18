<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('registros_emocionales')) {
            return;
        }

        Schema::create('registros_emocionales', function (Blueprint $table) {
            $table->id();
            $table->string('correo', 191);
            $table->string('grado', 100)->default('No especificado');
            $table->string('emocion', 50);
            $table->unsignedTinyInteger('intensidad')->default(5);
            $table->json('factores')->nullable();
            $table->text('comentario')->nullable();
            $table->timestamp('fecha')->useCurrent();
            $table->index('correo', 'idx_emociones_correo');
            $table->index('grado', 'idx_emociones_grado');
            $table->index('fecha', 'idx_emociones_fecha');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registros_emocionales');
    }
};
