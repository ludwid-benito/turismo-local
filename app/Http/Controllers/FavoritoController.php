<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\LugarTuristico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    // Listar favoritos del usuario
    public function index()
    {
        $favoritos = Favorito::where('user_id', Auth::id())
            ->with('lugar')
            ->get();

        return view('favoritos.index', compact('favoritos'));
    }

    // Agregar a favoritos
    public function store($lugar_id)
    {
        $existe = Favorito::where('user_id', Auth::id())
            ->where('lugar_turistico_id', $lugar_id)
            ->exists();

        if (!$existe) {
            Favorito::create([
                'user_id' => Auth::id(),
                'lugar_turistico_id' => $lugar_id,
            ]);
        }

        return back()->with('success', 'Lugar agregado a favoritos');
    }

    // Quitar de favoritos
    public function destroy($lugar_id)
    {
        Favorito::where('user_id', Auth::id())
            ->where('lugar_turistico_id', $lugar_id)
            ->delete();

        return back()->with('success', 'Lugar eliminado de favoritos');
    }
}
