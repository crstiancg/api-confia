<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('agenda_eventos')) {
            return;
        }

        Schema::create('agenda_eventos', function (Blueprint $table) {
            $table->id();
            $table->string('correo', 191);
            $table->date('fecha_evento');
            $table->string('titulo', 255);
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->index(['correo', 'fecha_evento'], 'idx_agenda_correo_fecha');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda_eventos');
    }
};
