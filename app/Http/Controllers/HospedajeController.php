<?php

namespace App\Http\Controllers;

use App\Models\Hospedaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HospedajeController extends Controller
{
    public function index()
    {
        $hospedajes = Hospedaje::all();
        return view('hospedajes.index', compact('hospedajes'));
    }

    public function create()
    {
        return view('hospedajes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'tipo' => 'nullable',
            'precio' => 'nullable',
            'ubicacion' => 'nullable',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('hospedajes', 'public');
        }

        Hospedaje::create($data);

        return redirect()->route('hospedajes.index');
    }

    public function edit(Hospedaje $hospedaje)
    {
        return view('hospedajes.edit', compact('hospedaje'));
    }

    public function update(Request $request, Hospedaje $hospedaje)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'tipo' => 'nullable',
            'precio' => 'nullable',
            'ubicacion' => 'nullable',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            if ($hospedaje->foto) {
                Storage::disk('public')->delete($hospedaje->foto);
            }
            $data['foto'] = $request->file('foto')->store('hospedajes', 'public');
        }

        $hospedaje->update($data);

        return redirect()->route('hospedajes.index');
    }

    public function destroy(Hospedaje $hospedaje)
    {
        if ($hospedaje->foto) {
            Storage::disk('public')->delete($hospedaje->foto);
        }

        $hospedaje->delete();
        return back();
    }
}
