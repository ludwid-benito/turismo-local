@extends('layouts.app')

@section('content')

<div class="space-y-12">
<!-- Hero / Header Section de Transporte -->
<div class="relative py-12 px-8 overflow-hidden rounded-[3rem] bg-slate-900 text-white shadow-2xl">
<!-- Decoración de fondo temática (Movimiento y Rutas) -->
<div class="absolute top-0 right-0 -mt-20 -mr-20 h-96 w-96 rounded-full bg-emerald-600/10 blur-3xl"></div>
<div class="absolute bottom-0 left-0 -mb-20 -ml-20 h-64 w-64 rounded-full bg-cyan-600/10 blur-3xl"></div>

    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
        <div class="max-w-xl">
            <nav class="flex mb-4 text-emerald-400 text-xs font-bold uppercase tracking-widest">
                <span>Movilidad</span>
                <span class="mx-2 text-slate-600">/</span>
                <span class="text-white tracking-normal text-xs font-medium">Rutas y Agencias</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                Transporte <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400">Turístico</span>
            </h1>
            <p class="text-slate-400 text-lg leading-relaxed">
                Planifica tus desplazamientos con seguridad. Encuentra agencias confiables, horarios de terminales y las mejores rutas para explorar cada rincón.
            </p>
        </div>

        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('transportes.create') }}"
                   class="group inline-flex items-center px-8 py-4 bg-emerald-600 text-white font-bold rounded-2xl shadow-xl shadow-emerald-900/20 hover:bg-emerald-500 transition-all transform hover:-translate-y-1 active:scale-95">
                    <i class="fas fa-plus-circle mr-3 group-hover:rotate-90 transition-transform"></i> 
                    Nuevo Transporte
                </a>
            @endif
        @endauth
    </div>
</div>

<!-- Grid de Transportes (RF12) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
    @foreach($transportes as $t)
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500 overflow-hidden flex flex-col">
            <!-- Media Section -->
            <div class="relative h-64 overflow-hidden">
                @if($t->foto)
                    <img src="{{ asset('storage/'.$t->foto) }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                        <i class="fas fa-bus-simple text-5xl"></i>
                    </div>
                @endif
                
                <!-- Badge de Tarifa -->
                <div class="absolute top-6 left-6 bg-white/90 backdrop-blur-md px-4 py-2 rounded-xl shadow-lg border border-white/20">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block leading-none mb-1 text-center">Tarifa</span>
                    <span class="text-emerald-600 font-extrabold text-lg leading-none">S/ {{ $t->tarifa }}</span>
                </div>

                <!-- Tipo de Vehículo Badge -->
                <div class="absolute bottom-4 right-6 bg-slate-900/80 backdrop-blur text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">
                    <i class="fas fa-van-shuttle mr-1 text-emerald-400"></i> {{ $t->tipo }}
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8 flex-grow flex flex-col">
                <div class="flex-grow">
                    <h2 class="text-2xl font-black text-slate-800 mb-3 leading-tight group-hover:text-emerald-600 transition-colors">
                        {{ $t->nombre }}
                    </h2>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-2 italic">
                        {{ $t->descripcion }}
                    </p>
                </div>

                <div class="space-y-4 pt-6 border-t border-slate-50">
                    <!-- Contacto Directo -->
                    <div class="flex items-start text-slate-600">
                        <div class="h-9 w-9 bg-emerald-50 rounded-xl flex items-center justify-center mr-3 text-emerald-600 flex-shrink-0 shadow-sm">
                            <i class="fas fa-phone-volume text-sm"></i>
                        </div>
                        <div class="text-sm">
                            <span class="block font-black text-slate-400 uppercase tracking-tighter text-[9px]">Contacto / Reservas</span>
                            <span class="font-bold text-slate-700 leading-tight">{{ $t->contacto }}</span>
                        </div>
                    </div>

                    <!-- Acciones (Solo Admin) -->
                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="flex justify-between items-center pt-2">
                                <span class="text-[9px] font-bold text-slate-300 uppercase tracking-widest">ID: #{{ $t->id }}</span>
                                <a href="{{ route('transportes.edit', $t) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-emerald-600 hover:text-white text-emerald-600 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm">
                                    <i class="fas fa-route mr-2"></i> Editar Ruta
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    @endforeach
</div>

@if($transportes->isEmpty())
    <!-- Estado Vacío -->
    <div class="text-center py-24 bg-white rounded-[3.5rem] border border-dashed border-slate-200">
        <div class="relative inline-block mb-6">
            <i class="fas fa-road-barrier text-slate-100 text-[10rem]"></i>
            <i class="fas fa-location-arrow text-emerald-400 text-4xl absolute bottom-4 right-4"></i>
        </div>
        <h3 class="text-2xl font-bold text-slate-800 tracking-tight">Próximas rutas en camino</h3>
        <p class="text-slate-400 mt-2 max-w-sm mx-auto">Estamos coordinando con las agencias locales para brindarte la información de transporte más actualizada.</p>
    </div>
@endif


</div>
@endsection