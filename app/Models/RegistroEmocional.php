<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroEmocional extends Model
{
    protected $table = 'registros_emocionales';

    public $timestamps = false;

    protected $fillable = [
        'correo',
        'grado',
        'emocion',
        'intensidad',
        'factores',
        'comentario',
    ];

    protected $casts = [
        'factores' => 'array',
        'fecha' => 'datetime',
    ];
}
