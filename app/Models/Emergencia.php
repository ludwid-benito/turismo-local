<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emergencia extends Model
{
    protected $fillable = [
        'nombre',
        'tipo',
        'telefono',
        'ubicacion',
        'descripcion'
    ];
//
}
