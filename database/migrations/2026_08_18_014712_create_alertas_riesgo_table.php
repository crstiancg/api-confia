<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('alertas_riesgo')) {
            return;
        }

        Schema::create('alertas_riesgo', function (Blueprint $table) {
            $table->id();
            $table->string('correo', 191);
            $table->string('grado', 100)->default('No especificado');
            $table->text('extracto');
            $table->boolean('atendido')->default(false);
            $table->timestamp('fecha')->useCurrent();
            $table->index('correo', 'idx_alertas_correo');
            $table->index('fecha', 'idx_alertas_fecha');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alertas_riesgo');
    }
};
