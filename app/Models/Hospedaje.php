<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Hospedaje extends Model
{
    
    public function favoritos(): MorphMany
    {
        return $this->morphMany(Favorito::class, 'favorable');
    }
    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'precio',
        'ubicacion',
        'foto'
    ];
    //
}
