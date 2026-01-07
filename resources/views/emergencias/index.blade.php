@extends('layouts.app')

@section('content')

<div class="space-y-10">
<!-- Hero / Header Section de Emergencias -->
<div class="relative py-12 px-8 overflow-hidden rounded-[3rem] bg-slate-900 text-white shadow-2xl">
<!-- Decoración de fondo con tonos de advertencia sutiles -->
<div class="absolute top-0 right-0 -mt-20 -mr-20 h-96 w-96 rounded-full bg-red-600/10 blur-3xl"></div>
<div class="absolute bottom-0 left-0 -mb-20 -ml-20 h-64 w-64 rounded-full bg-blue-600/10 blur-3xl"></div>

    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
        <div class="max-w-xl">
            <nav class="flex mb-4 text-red-400 text-xs font-bold uppercase tracking-widest">
                <span>Seguridad</span>
                <span class="mx-2 text-slate-600">/</span>
                <span class="text-white tracking-normal">Asistencia 24/7</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                Central de <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-orange-400">Emergencias</span>
            </h1>
            <p class="text-slate-400 text-lg leading-relaxed">Números de contacto, centros de salud y servicios de seguridad cercanos para tu tranquilidad durante tu estancia.</p>
        </div>

        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('emergencias.create') }}"
                   class="group inline-flex items-center px-8 py-4 bg-red-600 text-white font-bold rounded-2xl shadow-xl shadow-red-900/20 hover:bg-red-500 transition-all transform hover:-translate-y-1 active:scale-95">
                    <i class="fas fa-plus-circle mr-3 group-hover:rotate-90 transition-transform"></i> 
                    Nueva Emergencia
                </a>
            @endif
        @endauth
    </div>
</div>

<!-- Lista de Contactos de Emergencia (RF13) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($emergencias as $e)
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500 flex flex-col">
            <div class="p-8 flex-grow">
                <!-- Tipo y Estado -->
                <div class="flex items-center justify-between mb-6">
                    <div class="px-4 py-1.5 rounded-full bg-slate-50 border border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        {{ $e->tipo }}
                    </div>
                    <div class="h-10 w-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center shadow-sm">
                        @php
                            $icon = 'fa-phone-flip';
                            if(str_contains(strtolower($e->tipo), 'policía')) $icon = 'fa-shield-halved';
                            if(str_contains(strtolower($e->tipo), 'salud') || str_contains(strtolower($e->tipo), 'hospital')) $icon = 'fa-rated-hospital';
                            if(str_contains(strtolower($e->tipo), 'bomberos')) $icon = 'fa-fire-extinguisher';
                        @endphp
                        <i class="fas {{ $icon }} text-lg"></i>
                    </div>
                </div>

                <!-- Información Principal -->
                <h2 class="text-2xl font-black text-slate-800 mb-2 leading-tight group-hover:text-red-600 transition-colors">
                    {{ $e->nombre }}
                </h2>
                
                <p class="text-slate-500 text-sm mb-6 leading-relaxed">
                    {{ $e->descripcion }}
                </p>

                <!-- Teléfono Resaltado -->
                <div class="bg-slate-900 rounded-2xl p-6 text-center shadow-inner relative overflow-hidden group/phone">
                    <div class="absolute top-0 right-0 p-2 opacity-10 text-white transform group-hover/phone:scale-150 transition-transform">
                        <i class="fas fa-phone text-4xl"></i>
                    </div>
                    <span class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-1">Marcar Ahora</span>
                    <a href="tel:{{ $e->telefono }}" class="text-3xl font-black text-white tracking-tighter hover:text-red-400 transition-colors">
                        {{ $e->telefono }}
                    </a>
                </div>

                <!-- Ubicación -->
                <div class="mt-6 flex items-start text-slate-500">
                    <div class="mt-1 mr-3 text-red-500">
                        <i class="fas fa-location-dot"></i>
                    </div>
                    <div class="text-sm">
                        <span class="block font-bold text-slate-700">Ubicación</span>
                        <span class="italic">{{ $e->ubicacion }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer de la Tarjeta (Solo Admin) -->
            @auth
                @if(auth()->user()->isAdmin())
                    <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 rounded-b-[2.5rem] flex items-center justify-between">
                        <a href="{{ route('emergencias.edit', $e) }}" class="text-blue-600 font-bold text-xs uppercase tracking-widest hover:text-blue-800 transition">
                            <i class="fas fa-edit mr-1"></i> Editar Registro
                        </a>
                        <i class="fas fa-lock text-slate-300 text-xs"></i>
                    </div>
                @endif
            @endauth
        </div>
    @endforeach
</div>

<!-- Aviso de Disponibilidad (RNF7) -->
<div class="bg-blue-50 border border-blue-100 rounded-[2rem] p-8 flex flex-col md:flex-row items-center gap-6">
    <div class="h-16 w-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-blue-200">
        <i class="fas fa-info-circle"></i>
    </div>
    <div>
        <h4 class="text-blue-900 font-bold text-lg leading-none mb-2 text-center md:text-left">Información del Sistema</h4>
        <p class="text-blue-700 text-sm leading-relaxed text-center md:text-left">
            Esta lista se actualiza periódicamente para garantizar la disponibilidad de los servicios (95% garantizado). Si detecta un número incorrecto, por favor informe a las autoridades locales.
        </p>
    </div>
</div>


</div>
@endsection