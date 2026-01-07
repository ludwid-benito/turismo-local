@extends('layouts.app')

@section('content')

<div class="space-y-10">
<!-- Hero Section / Bienvenida -->
<div class="relative overflow-hidden rounded-3xl bg-blue-600 p-8 md:p-12 shadow-2xl shadow-blue-200">
<div class="absolute top-0 right-0 -mt-10 -mr-10 h-64 w-64 rounded-full bg-blue-500 opacity-20"></div>
<div class="absolute bottom-0 left-0 -mb-10 -ml-10 h-40 w-40 rounded-full bg-blue-700 opacity-20"></div>

    <div class="relative z-10 max-w-2xl">
        <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight mb-4">
            ¡Hola, {{ Auth::user()->name }}! 🏔️
        </h1>
        <p class="text-blue-100 text-lg leading-relaxed">
            Bienvenido a tu Panel de Control. Desde aquí puedes gestionar toda la información turística y planificar la mejor experiencia en la región.
        </p>
    </div>
</div>

<!-- Grid de Gestión (RF3, RF4, RF5, RF11, RF12, RF13) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    <!-- Lugares Turísticos (RF3) -->
    <a href="{{ route('lugares.index') }}"
       class="group relative p-8 bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <div class="h-14 w-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
            <i class="fas fa-mountain-sun text-2xl"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-900 mb-2">Lugares Turísticos</h2>
        <p class="text-gray-500 text-sm leading-relaxed">Gestiona atractivos, fotos, horarios y tarifas detalladas.</p>
        <div class="mt-4 text-blue-600 text-xs font-bold uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">
            Administrar <i class="fas fa-chevron-right ml-1"></i>
        </div>
    </a>

    <!-- Restaurantes (RF4) -->
    <a href="{{ route('restaurantes.index') }}"
       class="group relative p-8 bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <div class="h-14 w-14 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
            <i class="fas fa-utensils text-2xl"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-900 mb-2">Restaurantes</h2>
        <p class="text-gray-500 text-sm leading-relaxed">Configura menús típicos, ubicaciones y rangos de precios.</p>
        <div class="mt-4 text-orange-600 text-xs font-bold uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">
            Administrar <i class="fas fa-chevron-right ml-1"></i>
        </div>
    </a>

    <!-- Hospedajes (RF11) -->
    <a href="{{ route('hospedajes.index') }}"
       class="group relative p-8 bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <div class="h-14 w-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
            <i class="fas fa-hotel text-2xl"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-900 mb-2">Hospedajes</h2>
        <p class="text-gray-500 text-sm leading-relaxed">Controla la oferta de hoteles, hostales y contactos directos.</p>
        <div class="mt-4 text-indigo-600 text-xs font-bold uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">
            Administrar <i class="fas fa-chevron-right ml-1"></i>
        </div>
    </a>

    <!-- Transporte (RF12) -->
    <a href="{{ route('transportes.index') }}"
       class="group relative p-8 bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <div class="h-14 w-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
            <i class="fas fa-bus text-2xl"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-900 mb-2">Transporte</h2>
        <p class="text-gray-500 text-sm leading-relaxed">Terminales, agencias y horarios de rutas locales.</p>
        <div class="mt-4 text-emerald-600 text-xs font-bold uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">
            Administrar <i class="fas fa-chevron-right ml-1"></i>
        </div>
    </a>

    <!-- Eventos y Festividades (RF5) -->
    <a href="{{ route('eventos.index') }}"
       class="group relative p-8 bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
        <div class="h-14 w-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
            <i class="fas fa-calendar-star text-2xl"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-900 mb-2">Eventos</h2>
        <p class="text-gray-500 text-sm leading-relaxed">Programa festividades, ferias y eventos culturales.</p>
        <div class="mt-4 text-purple-600 text-xs font-bold uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">
            Administrar <i class="fas fa-chevron-right ml-1"></i>
        </div>
    </a>

    <!-- Emergencias (RF13) -->
    <a href="{{ route('emergencias.index') }}"
       class="group relative p-8 bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border-l-4 border-l-red-500">
        <div class="h-14 w-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:text-white transition-colors duration-300">
            <i class="fas fa-heartbeat text-2xl"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-900 mb-2">Emergencias</h2>
        <p class="text-gray-500 text-sm leading-relaxed">Información médica y números de seguridad crítica.</p>
        <div class="mt-4 text-red-600 text-xs font-bold uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">
            Administrar <i class="fas fa-chevron-right ml-1"></i>
        </div>
    </a>
</div>

<!-- Favoritos y Personalización (RF8) -->
<div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-[2.5rem] p-8 md:p-12 text-white shadow-2xl relative overflow-hidden">
    <div class="absolute right-0 bottom-0 opacity-10">
        <i class="fas fa-heart text-[12rem] -mb-10 -mr-10"></i>
    </div>
    
    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="max-w-xl text-center md:text-left">
            <h2 class="text-2xl font-bold mb-4 flex items-center justify-center md:justify-start">
                <i class="fas fa-heart text-red-500 mr-3 animate-pulse"></i>
                Tus Favoritos
            </h2>
            <p class="text-gray-400 leading-relaxed">
                Accede rápidamente a los lugares que más te han gustado. Revisa tu lista personalizada y comparte tus experiencias con otros viajeros.
            </p>
        </div>
        <a href="{{ route('favoritos.index') }}"
           class="whitespace-nowrap bg-white text-gray-900 px-8 py-4 rounded-2xl font-bold hover:bg-blue-50 transition-colors shadow-lg shadow-black/20 active:scale-95 transition-transform">
            Ver mis favoritos <i class="fas fa-arrow-right ml-2 text-blue-600"></i>
        </a>
    </div>
</div>


</div>
@endsection