<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('eventos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'lugar' => 'nullable',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('eventos', 'public');
        }

        Evento::create($data);

        return redirect()->route('eventos.index');
    }

    public function edit(Evento $evento)
    {
        return view('eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha' => 'required|date',
            'lugar' => 'nullable',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            if ($evento->foto) {
                Storage::disk('public')->delete($evento->foto);
            }
            $data['foto'] = $request->file('foto')->store('eventos', 'public');
        }

        $evento->update($data);

        return redirect()->route('eventos.index');
    }

    public function destroy(Evento $evento)
    {
        if ($evento->foto) {
            Storage::disk('public')->delete($evento->foto);
        }

        $evento->delete();
        return back();
    }
}
