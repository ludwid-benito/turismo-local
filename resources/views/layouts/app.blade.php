<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- SEO y Metadatos para App de Turismo (Mejora RNF5) -->
        <title>{{ config('app.name', 'App Turismo Local') }} - Explora Puno</title>
        <meta name="description" content="Información confiable sobre atractivos turísticos, gastronomía y cultura local.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Iconos (Necesarios para RF7, RF13 y una interfaz intuitiva RNF5) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-[#f8fafc] selection:bg-blue-600 selection:text-white">
        <div class="min-h-screen flex flex-col">
            <!-- Navegación con Efecto Glassmorphism (RNF5) -->
            <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
                @include('layouts.navigation')
            </nav>

            <!-- Page Heading & Search Bar (Integración RF6 y RNF5) -->
            @isset($header)
                <header class="bg-white shadow-sm overflow-hidden">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="space-y-1">
                                <div class="text-blue-600 font-bold text-sm uppercase tracking-widest">Explora</div>
                                <div class="text-3xl font-extrabold text-gray-900 tracking-tight">
                                    {{ $header }}
                                </div>
                            </div>
                            
                            <!-- Buscador Rápido (RF6) -->
                            <div class="relative w-full md:w-96">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" placeholder="¿A dónde quieres ir hoy?" class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-xl leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm transition-all shadow-inner">
                            </div>

                            <!-- Selector de Idioma Elegante (RNF1) -->
                            <div class="flex items-center bg-gray-100 p-1 rounded-lg">
                                <button class="px-3 py-1 text-xs font-bold rounded-md bg-white shadow-sm text-blue-600">ES</button>
                                <button class="px-3 py-1 text-xs font-medium text-gray-500 hover:text-gray-700">EN</button>
                            </div>
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>

            <!-- Footer Moderno (RF13 y RNF9) -->
            <footer class="bg-gray-900 text-gray-300 mt-12">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                        <!-- Branding -->
                        <div class="col-span-1 md:col-span-1">
                            <span class="text-2xl font-bold text-white tracking-tighter italic">Turismo<span class="text-blue-500">Local</span></span>
                            <p class="mt-4 text-sm leading-relaxed">
                                Tu guía definitiva para descubrir los tesoros ocultos de Puno y el Perú.
                            </p>
                        </div>

                        <!-- Emergencias (RF13) -->
                        <div>
                            <h3 class="text-white text-sm font-bold uppercase tracking-wider mb-4">Ayuda 24/7</h3>
                            <div class="space-y-3">
                                <div class="flex items-center text-red-400 font-semibold group cursor-pointer">
                                    <div class="bg-red-400/10 p-2 rounded-lg mr-3 group-hover:bg-red-400/20 transition">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <span>Emergencias: 105</span>
                                </div>
                                <p class="text-xs text-gray-500 italic">Asistencia médica y policial inmediata.</p>
                            </div>
                        </div>

                        <!-- Enlaces Legales (RNF9) -->
                        <div>
                            <h3 class="text-white text-sm font-bold uppercase tracking-wider mb-4">Información</h3>
                            <ul class="text-sm space-y-2">
                                <li><a href="#" class="hover:text-blue-400 transition">Privacidad (Ley N.º 29733)</a></li>
                                <li><a href="#" class="hover:text-blue-400 transition">Términos del Servicio</a></li>
                                <li><a href="#" class="hover:text-blue-400 transition">Cookies</a></li>
                            </ul>
                        </div>

                        <!-- Redes Sociales (RF14) -->
                        <div class="text-right md:text-left">
                            <h3 class="text-white text-sm font-bold uppercase tracking-wider mb-4">Síguenos</h3>
                            <div class="flex space-x-4">
                                <a href="#" class="bg-gray-800 p-2 rounded-full hover:bg-blue-600 transition text-white"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="bg-gray-800 p-2 rounded-full hover:bg-sky-400 transition text-white"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="bg-gray-800 p-2 rounded-full hover:bg-pink-600 transition text-white"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center text-xs">
                        <p>&copy; {{ date('Y') }} {{ config('app.name') }} - Facultad de Estadística e Informática (UNA Puno)</p>
                        <p class="mt-2 md:mt-0 text-gray-500">Desarrollado por Pari Benito, Luis Diego</p>
                    </div>
                </div>
            </footer>

            <!-- Botón de Mapa Flotante Estilizado (RF7) -->
            <div class="fixed bottom-8 right-8 z-40 group">
                <div class="absolute -top-12 right-0 bg-gray-900 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                    Explorar Mapa
                </div>
                <button title="Mapa Interactivo" class="bg-blue-600 hover:bg-blue-700 text-white h-16 w-16 rounded-2xl shadow-[0_10px_25px_-5px_rgba(37,99,235,0.4)] transition-all hover:scale-110 active:scale-95 flex items-center justify-center border-b-4 border-blue-800">
                    <i class="fas fa-map-marked-alt text-2xl"></i>
                </button>
            </div>
        </div>
    </body>
</html>