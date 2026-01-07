<?php

namespace App\Http\Controllers;

use App\Models\Transporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransporteController extends Controller
{
    public function index()
    {
        $transportes = Transporte::all();
        return view('transportes.index', compact('transportes'));
    }

    public function create()
    {
        return view('transportes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'tipo' => 'nullable',
            'tarifa' => 'nullable',
            'contacto' => 'nullable',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('transportes', 'public');
        }

        Transporte::create($data);

        return redirect()->route('transportes.index');
    }

    public function edit(Transporte $transporte)
    {
        return view('transportes.edit', compact('transporte'));
    }

    public function update(Request $request, Transporte $transporte)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'tipo' => 'nullable',
            'tarifa' => 'nullable',
            'contacto' => 'nullable',
            'foto' => 'nullable|image'
        ]);

        if ($request->hasFile('foto')) {
            if ($transporte->foto) {
                Storage::disk('public')->delete($transporte->foto);
            }
            $data['foto'] = $request->file('foto')->store('transportes', 'public');
        }

        $transporte->update($data);

        return redirect()->route('transportes.index');
    }

    public function destroy(Transporte $transporte)
    {
        if ($transporte->foto) {
            Storage::disk('public')->delete($transporte->foto);
        }

        $transporte->delete();
        return back();
    }
}
