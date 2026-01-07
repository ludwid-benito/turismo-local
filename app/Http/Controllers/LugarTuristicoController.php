<?php

namespace App\Http\Controllers;

use App\Models\LugarTuristico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LugarTuristicoController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('buscar');

        $lugares = LugarTuristico::when($query, function ($q) use ($query) {
            $q->where('nombre', 'like', '%' . $query . '%');
        })->get();

        return view('lugares.index', compact('lugares', 'query'));
    }
    public function edit(LugarTuristico $lugar)
    {
        return view('lugares.edit', compact('lugar'));
    }

    public function update(Request $request, LugarTuristico $lugar)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            if ($lugar->foto) {
                Storage::disk('public')->delete($lugar->foto);
            }

            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('lugares', $filename, 'public');
            $data['foto'] = 'lugares/' . $filename;
        }

        $lugar->update($data);

        return redirect()->route('lugares.index')
            ->with('success', 'Lugar actualizado correctamente');
    }
    public function create()
    {
        return view('lugares.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'horario' => 'required|string',
            'tarifa' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('lugares', 'public');
        }


        LugarTuristico::create($data);

        return redirect()->route('lugares.index')
            ->with('success', 'Lugar turístico registrado correctamente');
    }
    public function destroy(LugarTuristico $lugar)
    {
        if ($lugar->foto) {
            Storage::disk('public')->delete($lugar->foto);
        }

        $lugar->delete();

        return redirect()->route('lugares.index')
            ->with('success', 'Lugar eliminado correctamente');
    }
  





}
