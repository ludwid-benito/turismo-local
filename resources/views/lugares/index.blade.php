@extends('layouts.app')

@section('content')

<div class="space-y-12">
<!-- Hero / Header Section -->
<div class="relative py-12 px-6 overflow-hidden rounded-[3rem] bg-slate-900 text-white shadow-2xl">
<!-- Decoración de fondo -->
<div class="absolute top-0 right-0 -mt-20 -mr-20 h-96 w-96 rounded-full bg-blue-500/20 blur-3xl"></div>
<div class="absolute bottom-0 left-0 -mb-20 -ml-20 h-64 w-64 rounded-full bg-indigo-500/20 blur-3xl"></div>

    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
        <div class="max-w-xl">
            <nav class="flex mb-4 text-blue-400 text-xs font-bold uppercase tracking-widest">
                <span>Perú</span>
                <span class="mx-2 text-slate-600">/</span>
                <span class="text-white">Explorar Destinos</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                Descubre <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">Lugares Mágicos</span>
            </h1>
            <p class="text-slate-400 text-lg">Explora la riqueza cultural, natural y gastronómica de nuestra región con guías actualizadas.</p>
        </div>

        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('lugares.create') }}"
                   class="group inline-flex items-center px-8 py-4 bg-white text-slate-900 font-bold rounded-2xl shadow-xl hover:bg-blue-50 transition-all transform hover:-translate-y-1 active:scale-95">
                    <i class="fas fa-plus-circle mr-3 text-blue-600 group-hover:rotate-90 transition-transform"></i> 
                    Publicar Nuevo Destino
                </a>
            @endif
        @endauth
    </div>
</div>

<!-- Buscador Flotante (RF6) -->
<div class="max-w-4xl mx-auto -mt-16 relative z-20 px-4">
    <div class="bg-white p-2 rounded-[2rem] shadow-2xl shadow-slate-200 border border-slate-100">
        <form method="GET" action="{{ route('lugares.index') }}" class="flex flex-col md:flex-row gap-2">
            <div class="relative flex-grow">
                <span class="absolute inset-y-0 left-0 pl-5 flex items-center text-slate-400">
                    <i class="fas fa-search"></i>
                </span>
                <input 
                    type="text" 
                    name="buscar" 
                    value="{{ $query ?? '' }}"
                    placeholder="Busca por nombre, categoría o clima..." 
                    class="block w-full pl-12 pr-4 py-4 border-none bg-slate-50/50 rounded-2xl focus:ring-0 text-slate-700 placeholder-slate-400 transition-all shadow-inner"
                >
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-[1.5rem] font-bold transition-all shadow-lg shadow-blue-200 active:scale-95">
                Buscar Ahora
            </button>
        </form>
    </div>
</div>

<!-- Listado de Destinos (RF3) -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
    @forelse($lugares as $lugar)
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500">
            <!-- Media Section -->
            <div class="relative h-80 overflow-hidden">
                @if($lugar->foto)
                    <img src="{{ asset('storage/' . $lugar->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                        <i class="fas fa-mountain text-6xl text-slate-200"></i>
                    </div>
                @endif
                
                <!-- Gradiente de Imagen -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                <!-- Badges sobre imagen -->
                <div class="absolute top-6 left-6 flex flex-col gap-2">
                    <div class="bg-white/90 backdrop-blur-md px-4 py-2 rounded-xl shadow-lg border border-white/20 text-center">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block leading-none mb-1">Entrada</span>
                        <span class="text-blue-600 font-extrabold text-lg leading-none">S/ {{ $lugar->tarifa }}</span>
                    </div>
                </div>

                <!-- Botón Favorito (RF8) -->
                @auth
                    <div class="absolute top-6 right-6">
                        @php
                            $esFavorito = $lugar->favoritos()->where('user_id', auth()->id())->exists();
                        @endphp

                        @if($esFavorito)
                            <form action="{{ route('favoritos.destroy', $lugar->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="h-12 w-12 bg-red-500 text-white rounded-full shadow-xl flex items-center justify-center hover:scale-110 transition active:scale-95">
                                    <i class="fas fa-heart text-xl"></i>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('favoritos.store', $lugar->id) }}" method="POST">
                                @csrf
                                <button class="h-12 w-12 bg-white/20 backdrop-blur-md text-white border border-white/30 rounded-full shadow-xl flex items-center justify-center hover:bg-white hover:text-red-500 transition hover:scale-110 active:scale-95">
                                    <i class="far fa-heart text-xl"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                @endauth

                <!-- Nombre y Rating sobre imagen -->
                <div class="absolute bottom-6 left-8 right-8 text-white">
                    <div class="flex items-end justify-between gap-4">
                        <div>
                            <h2 class="text-3xl font-black tracking-tight leading-tight">{{ $lugar->nombre }}</h2>
                        </div>
                        @if($lugar->resenas->count())
                            <div class="flex items-center bg-white/20 backdrop-blur-md px-3 py-1.5 rounded-lg border border-white/20">
                                <i class="fas fa-star text-yellow-400 mr-2"></i>
                                <span class="font-bold">{{ number_format($lugar->promedioCalificacion(), 1) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="p-8 md:p-10">
                <div class="space-y-6">
                    <p class="text-slate-500 leading-relaxed line-clamp-3 italic text-lg">
                        "{{ $lugar->descripcion }}"
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <div class="flex items-center text-slate-500 bg-slate-50 px-4 py-3 rounded-2xl border border-slate-100">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-clock text-blue-600 text-sm"></i>
                            </div>
                            <div class="text-xs">
                                <span class="block font-black text-slate-400 uppercase tracking-tighter">Horario</span>
                                <span class="font-bold text-slate-700">{{ $lugar->horario }}</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center text-slate-500 bg-emerald-50 px-4 py-3 rounded-2xl border border-emerald-100">
                            <div class="bg-emerald-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-leaf text-emerald-600 text-sm"></i>
                            </div>
                            <div class="text-xs">
                                <span class="block font-black text-emerald-400 uppercase tracking-tighter">Entorno</span>
                                <span class="font-bold text-emerald-700 italic">Naturaleza</span>
                            </div>
                        </div>
                    </div>

                    <!-- Gestión Administrativa (Solo Admin) -->
                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="flex items-center justify-between border-t border-slate-100 pt-6 mt-6">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('lugares.edit', $lugar) }}" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('lugares.destroy', $lugar) }}" method="POST" onsubmit="return confirm('¿Eliminar este destino definitivamente?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Panel Administrativo</span>
                            </div>
                        @endif
                    @endauth
                </div>

                <!-- Sección de Reseñas Colapsable -->
                <div class="mt-8 pt-6 border-t border-slate-50" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between group">
                        <span class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center">
                            <i class="fas fa-comment-dots text-blue-500 mr-3 text-lg"></i> Experiencias
                            <span class="ml-2 bg-slate-100 px-2 py-0.5 rounded-md text-[10px] text-slate-400">{{ $lugar->resenas->count() }}</span>
                        </span>
                        <div class="h-8 w-8 rounded-full border border-slate-100 flex items-center justify-center group-hover:bg-blue-50 transition-colors">
                            <i class="fas fa-chevron-down text-slate-300 text-xs transition-transform" :class="open ? 'rotate-180 text-blue-500' : ''"></i>
                        </div>
                    </button>

                    <div x-show="open" x-collapse class="mt-6 space-y-4">
                        @forelse($lugar->resenas->take(3) as $resena)
                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 relative overflow-hidden">
                                <div class="flex items-center mb-2">
                                    <div class="h-6 w-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-[10px] font-bold mr-2 uppercase">
                                        {{ substr($resena->user->name, 0, 1) }}
                                    </div>
                                    <span class="font-bold text-slate-800 text-sm">{{ $resena->user->name }}</span>
                                    <div class="ml-auto flex text-yellow-400 text-[10px]">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="{{ $i <= $resena->calificacion ? 'fas' : 'far' }} fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-slate-600 text-sm leading-relaxed">"{{ $resena->comentario }}"</p>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <p class="text-slate-400 text-xs italic">Aún no hay historias compartidas sobre este lugar.</p>
                            </div>
                        @endforelse

                        @auth
                            <div class="pt-4">
                                <div class="mt-4 border-t pt-4">
                                    <h3 class="font-bold text-slate-800 mb-3 text-sm uppercase tracking-wider">Dejar reseña</h3>
                                    <form action="{{ route('resenas.store', $lugar->id) }}" method="POST" class="space-y-3">
                                        @csrf
                                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                                            <select name="calificacion" required class="col-span-1 border-slate-200 rounded-xl bg-white text-sm focus:ring-blue-500">
                                                <option value="">Calificación</option>
                                                @for($i = 5; $i >= 1; $i--)
                                                    <option value="{{ $i }}">{{ $i }} ⭐</option>
                                                @endfor
                                            </select>
                                            <textarea name="comentario" required rows="1" class="col-span-3 border-slate-200 rounded-xl bg-white text-sm focus:ring-blue-500" placeholder="¿Cómo fue tu visita?"></textarea>
                                        </div>
                                        <button class="w-full py-3 bg-slate-900 text-white rounded-xl font-bold text-xs shadow-lg hover:bg-slate-800 transition-all active:scale-[0.98] uppercase tracking-widest">
                                            Publicar Experiencia <i class="fas fa-paper-plane ml-2 text-blue-400"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-24 bg-white rounded-[3.5rem] border border-dashed border-slate-200">
            <div class="mb-6 relative inline-block">
                <i class="fas fa-map-marked-alt text-slate-100 text-[10rem]"></i>
                <i class="fas fa-search text-blue-500 text-4xl absolute bottom-4 right-4"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-800">Sin resultados</h3>
            <p class="text-slate-400 mt-2 max-w-sm mx-auto">No pudimos encontrar el destino que buscas.</p>
            <a href="{{ route('lugares.index') }}" class="mt-8 inline-block text-blue-600 font-black uppercase tracking-widest text-xs border-b-2 border-blue-600 pb-1">Reiniciar Exploración</a>
        </div>
    @endforelse
</div>

<!-- Paginación -->
@if(method_exists($lugares, 'hasPages') && $lugares->hasPages())
    <div class="mt-12 flex justify-center">
        {{ $lugares->links() }}
    </div>
@endif


</div>
@endsection