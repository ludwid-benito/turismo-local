@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Editar Restaurante</h1>

    <form action="{{ route('restaurantes.update', $restaurante) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block font-semibold">Nombre</label>
            <input type="text"
                   name="nombre"
                   value="{{ old('nombre', $restaurante->nombre) }}"
                   class="border rounded w-full px-3 py-2">
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Descripción</label>
            <textarea name="descripcion"
                      class="border rounded w-full px-3 py-2">{{ old('descripcion', $restaurante->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Menú</label>
            <input type="text"
                   name="menu"
                   value="{{ old('menu', $restaurante->menu) }}"
                   class="border rounded w-full px-3 py-2">
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Precios</label>
            <input type="text"
                   name="precios"
                   value="{{ old('precios', $restaurante->precios) }}"
                   class="border rounded w-full px-3 py-2">
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Ubicación</label>
            <input type="text"
                   name="ubicacion"
                   value="{{ old('ubicacion', $restaurante->ubicacion) }}"
                   class="border rounded w-full px-3 py-2">
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Foto</label>
            <input type="file" name="foto" class="border rounded w-full">
        </div>

        @if($restaurante->foto)
            <img src="{{ asset('storage/' . $restaurante->foto) }}"
                 class="w-48 mb-3 rounded">
        @endif

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Actualizar
        </button>

        <a href="{{ route('restaurantes.index') }}"
           class="ml-3 text-gray-600 hover:underline">
            Cancelar
        </a>
    </form>
</div>
@endsection
