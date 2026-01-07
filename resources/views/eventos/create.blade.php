@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Registrar Evento</h1>

    <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="nombre" placeholder="Nombre del evento" class="w-full border p-2 mb-2" required>
        <textarea name="descripcion" placeholder="Descripción" class="w-full border p-2 mb-2" required></textarea>
        <input type="date" name="fecha" class="w-full border p-2 mb-2" required>
        <input type="text" name="lugar" placeholder="Lugar" class="w-full border p-2 mb-2">
        <input type="file" name="foto" class="w-full border p-2 mb-2">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Guardar
        </button>
    </form>
</div>
@endsection
