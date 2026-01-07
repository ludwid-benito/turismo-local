@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-xl font-bold mb-4">Registrar Lugar Turístico</h1>

    <form action="{{ route('lugares.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-4">
            <label class="block font-medium">Nombre</label>
            <input type="text" name="nombre" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Descripción</label>
            <textarea name="descripcion" class="w-full border rounded p-2" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Horario</label>
            <input type="text" name="horario" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Tarifa (S/)</label>
            <input type="number" step="0.01" name="tarifa" class="w-full border rounded p-2">
        </div>
        <div class="mb-4">
            <label class="block font-medium">Foto</label>
            <input type="file" name="foto" class="w-full border rounded p-2">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Guardar
        </button>
    </form>
</div>
@endsection
