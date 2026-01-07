@extends('layouts.app')

@section('content')

<div class="space-y-12">
<!-- Hero / Header Section de Hospedajes -->
<div class="relative py-12 px-8 overflow-hidden rounded-[3rem] bg-slate-900 text-white shadow-2xl">
<!-- Decoración de fondo temática (Descanso y Confort) -->
<div class="absolute top-0 right-0 -mt-20 -mr-20 h-96 w-96 rounded-full bg-indigo-600/10 blur-3xl"></div>
<div class="absolute bottom-0 left-0 -mb-20 -ml-20 h-64 w-64 rounded-full bg-blue-600/10 blur-3xl"></div>

    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
        <div class="max-w-xl">
            <nav class="flex mb-4 text-indigo-400 text-xs font-bold uppercase tracking-widest">
                <span>Servicios</span>
                <span class="mx-2 text-slate-600">/</span>
                <span class="text-white tracking-normal text-xs font-medium">Hospedajes y Estancias</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                Tu Descanso <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-blue-400">Ideal</span>
            </h1>
            <p class="text-slate-400 text-lg leading-relaxed">
                Encuentra el lugar perfecto para recargar energías. Desde hoteles boutique hasta acogedores hostales con encanto local.
            </p>
        </div>

        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('hospedajes.create') }}"
                   class="group inline-flex items-center px-8 py-4 bg-indigo-600 text-white font-bold rounded-2xl shadow-xl shadow-indigo-900/20 hover:bg-indigo-500 transition-all transform hover:-translate-y-1 active:scale-95">
                    <i class="fas fa-plus-circle mr-3 group-hover:rotate-90 transition-transform"></i> 
                    Nuevo Hospedaje
                </a>
            @endif
        @endauth
    </div>
</div>

<!-- Grid de Hospedajes (RF11) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
    @foreach($hospedajes as $h)
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500 overflow-hidden flex flex-col">
            <!-- Media Section -->
            <div class="relative h-64 overflow-hidden">
                @if($h->foto)
                    <img src="{{ asset('storage/'.$h->foto) }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                        <i class="fas fa-hotel text-5xl"></i>
                    </div>
                @endif
                
                <!-- Badge de Precio / Tarifa -->
                <div class="absolute top-6 left-6 bg-white/90 backdrop-blur-md px-4 py-2 rounded-xl shadow-lg border border-white/20">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block leading-none mb-1">Desde</span>
                    <span class="text-indigo-600 font-extrabold text-lg leading-none">S/ {{ $h->precio }}</span>
                </div>

                <!-- Tipo de Hospedaje Badge -->
                <div class="absolute bottom-4 right-6 bg-indigo-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">
                    {{ $h->tipo }}
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8 flex-grow flex flex-col">
                <div class="flex-grow">
                    <h2 class="text-2xl font-black text-slate-800 mb-3 leading-tight group-hover:text-indigo-600 transition-colors">
                        {{ $h->nombre }}
                    </h2>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-2 italic">
                        {{ $h->descripcion }}
                    </p>
                </div>

                <div class="space-y-4 pt-6 border-t border-slate-50">
                    <!-- Ubicación -->
                    <div class="flex items-center text-slate-600">
                        <div class="h-8 w-8 bg-slate-100 rounded-lg flex items-center justify-center mr-3 text-indigo-500">
                            <i class="fas fa-map-pin text-sm"></i>
                        </div>
                        <span class="text-sm font-bold truncate">{{ $h->ubicacion }}</span>
                    </div>

                    <!-- Acciones y Detalles -->
                    <div class="flex items-center justify-between pt-2">
                        <div class="flex items-center text-yellow-400 text-xs">
                            <i class="fas fa-star mr-1"></i>
                            <span class="font-bold text-slate-700">Recomendado</span>
                        </div>
                        
                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('hospedajes.edit', $h) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-indigo-50 text-indigo-600 rounded-xl text-xs font-bold uppercase tracking-widest transition-colors">
                                    <i class="fas fa-edit mr-2"></i> Editar
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if($hospedajes->isEmpty())
    <!-- Estado Vacío -->
    <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-slate-200">
        <i class="fas fa-bed-pulse text-slate-100 text-[10rem] mb-6"></i>
        <h3 class="text-2xl font-bold text-slate-800">No hay hospedajes registrados</h3>
        <p class="text-slate-400 mt-2 max-w-sm mx-auto">Pronto tendremos nuevas opciones de alojamiento para que disfrutes de tu viaje.</p>
    </div>
@endif


</div>
@endsection