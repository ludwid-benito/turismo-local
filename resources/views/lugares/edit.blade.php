@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-4xl">
    <h1 class="text-2xl font-bold mb-4">Editar Lugar Turístico</h1>

    <form action="{{ route('lugares.update', $lugar) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded shadow">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium mb-1">Nombre</label>
            <input type="text"
                   name="nombre"
                   value="{{ old('nombre', $lugar->nombre) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Descripción</label>
            <textarea name="descripcion"
                      class="w-full border rounded px-3 py-2"
                      rows="4">{{ old('descripcion', $lugar->descripcion) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Imagen actual</label>
            @if($lugar->foto)
                <img src="{{ asset('storage/' . $lugar->foto) }}"
                     class="w-48 rounded mb-2">
            @else
                <p class="text-gray-500">No hay imagen</p>
            @endif
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Nueva imagen (opcional)</label>
            <input type="file" name="foto">
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                Actualizar
            </button>

            <a href="{{ route('lugares.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
