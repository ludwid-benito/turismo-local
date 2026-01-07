<?php

namespace App\Http\Controllers;

use App\Models\Emergencia;
use Illuminate\Http\Request;

class EmergenciaController extends Controller
{
    public function index()
    {
        $emergencias = Emergencia::all();
        return view('emergencias.index', compact('emergencias'));
    }

    public function create()
    {
        return view('emergencias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'tipo' => 'required',
            'telefono' => 'required',
            'ubicacion' => 'nullable',
            'descripcion' => 'nullable'
        ]);

        Emergencia::create($data);

        return redirect()->route('emergencias.index');
    }

    public function edit(Emergencia $emergencia)
    {
        return view('emergencias.edit', compact('emergencia'));
    }

    public function update(Request $request, Emergencia $emergencia)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'tipo' => 'required',
            'telefono' => 'required',
            'ubicacion' => 'nullable',
            'descripcion' => 'nullable'
        ]);

        $emergencia->update($data);

        return redirect()->route('emergencias.index');
    }

    public function destroy(Emergencia $emergencia)
    {
        $emergencia->delete();
        return back();
    }
}
