<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestauranteController extends Controller
{
    public function index()
    {
        $restaurantes = Restaurante::all();
        return view('restaurantes.index', compact('restaurantes'));
    }

    public function create()
    {
        return view('restaurantes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'menu' => 'nullable',
            'precios' => 'nullable',
            'ubicacion' => 'nullable',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('restaurantes', 'public');
        }

        Restaurante::create($data);

        return redirect()->route('restaurantes.index');
    }

    public function edit(Restaurante $restaurante)
    {
        return view('restaurantes.edit', compact('restaurante'));
    }

    public function update(Request $request, Restaurante $restaurante)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'menu' => 'nullable',
            'precios' => 'nullable',
            'ubicacion' => 'nullable',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            if ($restaurante->foto) {
                Storage::disk('public')->delete($restaurante->foto);
            }
            $data['foto'] = $request->file('foto')->store('restaurantes', 'public');
        }

        $restaurante->update($data);

        return redirect()->route('restaurantes.index');
    }

    public function destroy(Restaurante $restaurante)
    {
        if ($restaurante->foto) {
            Storage::disk('public')->delete($restaurante->foto);
        }

        $restaurante->delete();
        return back();
    }
}
