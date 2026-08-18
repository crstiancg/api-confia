<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    public $timestamps = false;

    protected $fillable = [
        'correo',
        'grado',
        'rol',
    ];

    protected $casts = [
        'fecha_registro' => 'datetime',
    ];
}
