<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lugar_turistico_id',
    ];

    // Un favorito pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un favorito pertenece a un lugar turístico
    public function lugar()
    {
        return $this->belongsTo(LugarTuristico::class, 'lugar_turistico_id');
    }
}
