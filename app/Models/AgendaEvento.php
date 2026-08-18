<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaEvento extends Model
{
    protected $table = 'agenda_eventos';

    public $timestamps = false;

    protected $fillable = [
        'correo',
        'fecha_evento',
        'titulo',
    ];

    protected $casts = [
        'fecha_evento' => 'date',
        'fecha_creacion' => 'datetime',
    ];
}
