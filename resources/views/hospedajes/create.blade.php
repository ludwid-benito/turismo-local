@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Registrar Hospedaje</h1>

    <form action="{{ route('hospedajes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="nombre" placeholder="Nombre" class="w-full border p-2 mb-2" required>
        <textarea name="descripcion" placeholder="Descripción" class="w-full border p-2 mb-2" required></textarea>
        <input type="text" name="tipo" placeholder="Tipo" class="w-full border p-2 mb-2">
        <input type="text" name="precio" placeholder="Precio" class="w-full border p-2 mb-2">
        <input type="text" name="ubicacion" placeholder="Ubicación" class="w-full border p-2 mb-2">
        <input type="file" name="foto" class="w-full border p-2 mb-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Guardar
        </button>
    </form>
</div>
@endsection
