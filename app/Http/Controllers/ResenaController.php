<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResenaController extends Controller
{
    public function store(Request $request, $lugar_id)
    {
        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string'
        ]);

        $existe = Resena::where('user_id', auth()->id())
            ->where('lugar_turistico_id', $lugar_id)
            ->exists();

        if ($existe) {
            return back()->with('error', 'Ya dejaste una reseña para este lugar');
        }

        Resena::create([
            'user_id' => auth()->id(),
            'lugar_turistico_id' => $lugar_id,
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario,
        ]);

        return back()->with('success', 'Reseña registrada correctamente');
    }

}
