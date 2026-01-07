@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-xl font-bold mb-4">Editar Transporte</h1>

    <form action="{{ route('transportes.update', $transporte) }}" 
          method="POST" 
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">Nombre</label>
            <input type="text" name="nombre"
                   value="{{ old('nombre', $transporte->nombre) }}"
                   class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Descripción</label>
            <textarea name="descripcion"
                      class="w-full border rounded p-2"
                      required>{{ old('descripcion', $transporte->descripcion) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Tipo</label>
            <input type="text" name="tipo"
                   value="{{ old('tipo', $transporte->tipo) }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Tarifa</label>
            <input type="number" step="0.01" name="tarifa"
                   value="{{ old('tarifa', $transporte->tarifa) }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Contacto</label>
            <input type="text" name="contacto"
                   value="{{ old('contacto', $transporte->contacto) }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Foto</label>
            <input type="file" name="foto" class="w-full border rounded p-2">
        </div>

        @if($transporte->foto)
            <img src="{{ asset('storage/'.$transporte->foto) }}"
                 class="w-full h-40 object-cover mb-4 rounded">
        @endif

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Actualizar
        </button>
    </form>
</div>
@endsection
