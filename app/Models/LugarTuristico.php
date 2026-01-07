<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugarTuristico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'horario',
        'tarifa',
        'foto'
    ];
    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }
    public function resenas()
    {
        return $this->hasMany(Resena::class);
    }

    public function promedioCalificacion()
    {
        return $this->resenas()->avg('calificacion');
    }


}
