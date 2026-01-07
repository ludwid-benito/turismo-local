@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Registrar Restaurante</h1>

    <form action="{{ route('restaurantes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="block font-medium">Nombre</label>
            <input type="text" name="nombre" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-3">
            <label class="block font-medium">Descripción</label>
            <textarea name="descripcion" class="w-full border rounded p-2" required></textarea>
        </div>

        <div class="mb-3">
            <label class="block font-medium">Menú</label>
            <input type="text" name="menu" class="w-full border rounded p-2">
        </div>

        <div class="mb-3">
            <label class="block font-medium">Precios</label>
            <input type="text" name="precios" class="w-full border rounded p-2">
        </div>

        <div class="mb-3">
            <label class="block font-medium">Ubicación</label>
            <input type="text" name="ubicacion" class="w-full border rounded p-2">
        </div>

        <div class="mb-3">
            <label class="block font-medium">Foto</label>
            <input type="file" name="foto" class="w-full border rounded p-2">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Guardar
        </button>

        <a href="{{ route('restaurantes.index') }}" class="ml-3 text-gray-600">
            Cancelar
        </a>
    </form>
</div>
@endsection
