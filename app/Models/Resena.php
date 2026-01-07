<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lugar_turistico_id',
        'calificacion',
        'comentario'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lugar()
    {
        return $this->belongsTo(LugarTuristico::class);
    }
}
