@extends('layouts.app')

@section('content')

<div class="space-y-12">
<!-- Hero / Header Section de Eventos -->
<div class="relative py-12 px-8 overflow-hidden rounded-[3rem] bg-slate-900 text-white shadow-2xl">
<!-- Decoración de fondo con tonos festivos -->
<div class="absolute top-0 right-0 -mt-20 -mr-20 h-96 w-96 rounded-full bg-purple-600/20 blur-3xl"></div>
<div class="absolute bottom-0 left-0 -mb-20 -ml-20 h-64 w-64 rounded-full bg-pink-600/10 blur-3xl"></div>

    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
        <div class="max-w-xl">
            <nav class="flex mb-4 text-purple-400 text-xs font-bold uppercase tracking-widest">
                <span>Cultura</span>
                <span class="mx-2 text-slate-600">/</span>
                <span class="text-white tracking-normal">Agenda Local</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                Eventos y <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">Festividades</span>
            </h1>
            <p class="text-slate-400 text-lg leading-relaxed">Sumérgete en la tradición y alegría de nuestra región. No te pierdas las celebraciones más importantes del año.</p>
        </div>

        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('eventos.create') }}"
                   class="group inline-flex items-center px-8 py-4 bg-purple-600 text-white font-bold rounded-2xl shadow-xl shadow-purple-900/20 hover:bg-purple-500 transition-all transform hover:-translate-y-1 active:scale-95">
                    <i class="fas fa-plus-circle mr-3 group-hover:rotate-90 transition-transform"></i> 
                    Nuevo Evento
                </a>
            @endif
        @endauth
    </div>
</div>

<!-- Grid de Eventos (RF5) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
    @foreach($eventos as $e)
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500 overflow-hidden flex flex-col">
            <!-- Media Section -->
            <div class="relative h-64 overflow-hidden">
                @if($e->foto)
                    <img src="{{ asset('storage/'.$e->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                        <i class="fas fa-calendar-alt text-5xl"></i>
                    </div>
                @endif
                
                <!-- Badge de Fecha Flotante -->
                <div class="absolute top-6 left-6 bg-white rounded-2xl p-2 shadow-xl border border-slate-100 flex flex-col items-center min-w-[60px]">
                    @php 
                        $fecha = \Carbon\Carbon::parse($e->fecha);
                    @endphp
                    <span class="text-[10px] font-black text-purple-600 uppercase tracking-tighter">{{ $fecha->translatedFormat('M') }}</span>
                    <span class="text-2xl font-black text-slate-900 leading-none">{{ $fecha->format('d') }}</span>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-8 flex-grow flex flex-col">
                <div class="flex-grow">
                    <h2 class="text-2xl font-black text-slate-800 mb-3 leading-tight group-hover:text-purple-600 transition-colors">
                        {{ $e->nombre }}
                    </h2>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3">
                        {{ $e->descripcion }}
                    </p>
                </div>

                <div class="space-y-4 pt-6 border-t border-slate-50">
                    <!-- Lugar -->
                    <div class="flex items-center text-slate-600">
                        <div class="h-8 w-8 bg-slate-100 rounded-lg flex items-center justify-center mr-3 text-purple-500">
                            <i class="fas fa-location-dot text-sm"></i>
                        </div>
                        <span class="text-sm font-bold truncate">{{ $e->lugar }}</span>
                    </div>

                    <!-- Acciones -->
                    <div class="flex items-center justify-between pt-2">
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            <i class="far fa-clock mr-1"></i> Confirmado
                        </div>
                        
                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('eventos.edit', $e) }}" class="text-blue-600 font-bold text-xs uppercase tracking-widest hover:text-blue-800 transition flex items-center">
                                    <i class="fas fa-edit mr-1"></i> Editar
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if($eventos->isEmpty())
    <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-slate-200">
        <i class="fas fa-calendar-day text-slate-100 text-[10rem] mb-6"></i>
        <h3 class="text-2xl font-bold text-slate-800">No hay eventos próximos</h3>
        <p class="text-slate-400 mt-2">Vuelve pronto para conocer las nuevas festividades programadas.</p>
    </div>
@endif


</div>
@endsection