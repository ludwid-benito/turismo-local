@extends('layouts.app')

@section('content')

<div class="space-y-12">
<!-- Hero / Header Section de Restaurantes -->
<div class="relative py-12 px-8 overflow-hidden rounded-[3rem] bg-slate-900 text-white shadow-2xl">
<!-- Decoración de fondo temática (Sabores y Calidez) -->
<div class="absolute top-0 right-0 -mt-20 -mr-20 h-96 w-96 rounded-full bg-orange-600/10 blur-3xl"></div>
<div class="absolute bottom-0 left-0 -mb-20 -ml-20 h-64 w-64 rounded-full bg-amber-600/10 blur-3xl"></div>

    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
        <div class="max-w-xl">
            <nav class="flex mb-4 text-orange-400 text-xs font-bold uppercase tracking-widest">
                <span>Gastronomía</span>
                <span class="mx-2 text-slate-600">/</span>
                <span class="text-white tracking-normal text-xs font-medium">Sabores de la Región</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                Restaurantes <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-400">Típicos</span>
            </h1>
            <p class="text-slate-400 text-lg leading-relaxed">
                Deleita tu paladar con la esencia de nuestra tierra. Descubre los mejores rincones gastronómicos, desde picanterías tradicionales hasta cocina de autor.
            </p>
        </div>

        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('restaurantes.create') }}"
                   class="group inline-flex items-center px-8 py-4 bg-orange-600 text-white font-bold rounded-2xl shadow-xl shadow-orange-900/20 hover:bg-orange-500 transition-all transform hover:-translate-y-1 active:scale-95">
                    <i class="fas fa-plus-circle mr-3 group-hover:rotate-90 transition-transform"></i> 
                    Nuevo Restaurante
                </a>
            @endif
        @endauth
    </div>
</div>

<!-- Grid de Restaurantes (RF4) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
    @foreach($restaurantes as $r)
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500 overflow-hidden flex flex-col">
            <!-- Media Section -->
            <div class="relative h-64 overflow-hidden">
                @if($r->foto)
                    <img src="{{ asset('storage/'.$r->foto) }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                        <i class="fas fa-plate-wheat text-5xl"></i>
                    </div>
                @endif
                
                <!-- Badge de Rango de Precios -->
                <div class="absolute top-6 left-6 bg-white/90 backdrop-blur-md px-4 py-2 rounded-xl shadow-lg border border-white/20">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block leading-none mb-1 text-center">Rango</span>
                    <span class="text-orange-600 font-extrabold text-sm leading-none italic">{{ $r->precios }}</span>
                </div>

                <!-- Overlay sutil -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>

            <!-- Content Section -->
            <div class="p-8 flex-grow flex flex-col">
                <div class="flex-grow">
                    <h2 class="text-2xl font-black text-slate-800 mb-3 leading-tight group-hover:text-orange-600 transition-colors">
                        {{ $r->nombre }}
                    </h2>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-2 italic">
                        {{ $r->descripcion }}
                    </p>
                </div>

                <div class="space-y-4 pt-6 border-t border-slate-50">
                    <!-- Menú Destacado -->
                    <div class="flex items-start text-slate-600">
                        <div class="h-9 w-9 bg-orange-50 rounded-xl flex items-center justify-center mr-3 text-orange-500 flex-shrink-0 shadow-sm">
                            <i class="fas fa-bowl-food text-sm"></i>
                        </div>
                        <div class="text-sm">
                            <span class="block font-black text-slate-400 uppercase tracking-tighter text-[9px]">Especialidad / Menú</span>
                            <span class="font-bold text-slate-700 leading-tight">{{ $r->menu }}</span>
                        </div>
                    </div>

                    <!-- Ubicación -->
                    <div class="flex items-start text-slate-600">
                        <div class="h-9 w-9 bg-slate-50 rounded-xl flex items-center justify-center mr-3 text-blue-500 flex-shrink-0 shadow-sm">
                            <i class="fas fa-map-location-dot text-sm"></i>
                        </div>
                        <div class="text-sm">
                            <span class="block font-black text-slate-400 uppercase tracking-tighter text-[9px]">Ubicación</span>
                            <span class="font-medium text-slate-600 italic leading-tight">{{ $r->ubicacion }}</span>
                        </div>
                    </div>

                    <!-- Acciones (Solo Admin) -->
                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="flex justify-end pt-2">
                                <a href="{{ route('restaurantes.edit', $r) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-slate-50 hover:bg-orange-600 hover:text-white text-orange-600 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm active:scale-95">
                                    <i class="fas fa-pen-to-square mr-2"></i> Editar Datos
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    @endforeach
</div>

@if($restaurantes->isEmpty())
    <!-- Estado Vacío -->
    <div class="text-center py-24 bg-white rounded-[3.5rem] border border-dashed border-slate-200">
        <div class="relative inline-block mb-6">
            <i class="fas fa-utensils text-slate-100 text-[10rem]"></i>
            <i class="fas fa-search text-orange-400 text-4xl absolute bottom-4 right-4"></i>
        </div>
        <h3 class="text-2xl font-bold text-slate-800 tracking-tight">¡Buen provecho pronto!</h3>
        <p class="text-slate-400 mt-2 max-w-sm mx-auto">Actualmente estamos actualizando nuestro menú de restaurantes típicos. Vuelve pronto para descubrir nuevos sabores.</p>
    </div>
@endif


</div>
@endsection