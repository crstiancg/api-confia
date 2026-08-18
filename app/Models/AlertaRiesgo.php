<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlertaRiesgo extends Model
{
    protected $table = 'alertas_riesgo';

    public $timestamps = false;

    protected $fillable = [
        'correo',
        'grado',
        'extracto',
        'atendido',
    ];

    protected $casts = [
        'atendido' => 'boolean',
        'fecha' => 'datetime',
    ];
}
