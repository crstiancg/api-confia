<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('usuarios') && !Schema::hasColumn('usuarios', 'password')) {
            Schema::table('usuarios', function (Blueprint $table) {
                $table->string('password')->nullable()->after('correo');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('usuarios') && Schema::hasColumn('usuarios', 'password')) {
            Schema::table('usuarios', function (Blueprint $table) {
                $table->dropColumn('password');
            });
        }
    }
};
