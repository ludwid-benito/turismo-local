@extends('layouts.app')

@section('content')

<div class="space-y-12">
<!-- Hero / Header Section de Favoritos -->
<div class="relative py-12 px-8 overflow-hidden rounded-[3rem] bg-slate-900 text-white shadow-2xl">
<!-- Decoración de fondo temática (Corazón sutil) -->
<div class="absolute top-0 right-0 -mt-20 -mr-20 h-96 w-96 rounded-full bg-red-600/10 blur-3xl"></div>
<div class="absolute bottom-0 left-0 -mb-20 -ml-20 h-64 w-64 rounded-full bg-blue-600/10 blur-3xl"></div>

    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
        <div class="max-w-xl">
            <nav class="flex mb-4 text-red-400 text-xs font-bold uppercase tracking-widest">
                <span>Mi Cuenta</span>
                <span class="mx-2 text-slate-600">/</span>
                <span class="text-white tracking-normal text-xs">Colección Personal</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                Mis <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-pink-400">Favoritos</span>
            </h1>
            <p class="text-slate-400 text-lg leading-relaxed">
                Tu lista personalizada de destinos soñados. Planifica tu próxima aventura con los lugares que más te inspiran.
            </p>
        </div>

        <div class="hidden lg:block">
            <div class="h-24 w-24 bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2rem] flex items-center justify-center text-4xl text-red-500 shadow-inner">
                <i class="fas fa-heart animate-pulse"></i>
            </div>
        </div>
    </div>
</div>

<!-- Grid de Favoritos (RF8) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
    @forelse($favoritos as $favorito)
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500 overflow-hidden flex flex-col">
            <!-- Media Section -->
            <div class="relative h-60 overflow-hidden">
                @if($favorito->lugar->foto)
                    <img src="{{ asset('storage/' . $favorito->lugar->foto) }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                        <i class="fas fa-map-pin text-5xl"></i>
                    </div>
                @endif
                
                <!-- Overlay de Gradiente -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
            </div>

            <!-- Content Section -->
            <div class="p-8 flex-grow flex flex-col">
                <div class="flex-grow">
                    <h2 class="text-2xl font-black text-slate-800 mb-3 leading-tight group-hover:text-red-600 transition-colors">
                        {{ $favorito->lugar->nombre }}
                    </h2>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-2 italic">
                        {{ $favorito->lugar->descripcion }}
                    </p>
                </div>

                <div class="pt-6 border-t border-slate-50 space-y-4">
                    <!-- Enlace para ver detalle -->
                    <a href="{{ route('lugares.index', ['buscar' => $favorito->lugar->nombre]) }}" 
                       class="flex items-center text-blue-600 font-bold text-sm hover:underline">
                        Ver información completa <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>

                    <!-- Acción de Eliminar (Estructura original preservada) -->
                    <form action="{{ route('favoritos.destroy', $favorito->lugar->id) }}" method="POST" onsubmit="return confirm('¿Quitar de tu lista de favoritos?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full py-3 border-2 border-red-50 hover:border-red-100 bg-red-50/30 text-red-600 rounded-2xl font-bold text-xs uppercase tracking-widest transition-all hover:bg-red-600 hover:text-white active:scale-95 flex items-center justify-center">
                            <i class="fas fa-trash-can mr-2"></i> Quitar de Favoritos
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <!-- Estado Vacío Estilizado -->
        <div class="col-span-full text-center py-24 bg-white rounded-[3.5rem] border border-dashed border-slate-200">
            <div class="mb-6 relative inline-block">
                <i class="fas fa-heart-crack text-slate-100 text-[10rem]"></i>
                <i class="fas fa-search-location text-blue-500 text-4xl absolute bottom-4 right-4"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-800">Tu lista está vacía</h3>
            <p class="text-slate-400 mt-2 max-w-sm mx-auto">Aún no tienes lugares favoritos. Comienza a explorar nuestro catálogo y guarda los destinos que más te gusten.</p>
            <a href="{{ route('lugares.index') }}" 
               class="mt-8 inline-block px-8 py-3 bg-blue-600 text-white font-black uppercase tracking-widest text-xs rounded-xl shadow-lg shadow-blue-100 hover:bg-blue-700 transition">
                Explorar Destinos
            </a>
        </div>
    @endforelse
</div>


</div>
@endsection