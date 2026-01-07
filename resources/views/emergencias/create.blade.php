@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Registrar Emergencia</h1>

    <form action="{{ route('emergencias.store') }}" method="POST">
        @csrf

        <input type="text" name="nombre" placeholder="Nombre" class="w-full border p-2 mb-2" required>
        <input type="text" name="tipo" placeholder="Tipo (Policía, Hospital)" class="w-full border p-2 mb-2" required>
        <input type="text" name="telefono" placeholder="Teléfono" class="w-full border p-2 mb-2" required>
        <input type="text" name="ubicacion" placeholder="Ubicación" class="w-full border p-2 mb-2">
        <textarea name="descripcion" placeholder="Descripción" class="w-full border p-2 mb-2"></textarea>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Guardar
        </button>
    </form>
</div>
@endsection
