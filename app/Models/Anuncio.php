<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $table = 'anuncios';

    public $timestamps = false;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'titulo',
        'mensaje',
        'grado',
        'autor',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];
}
