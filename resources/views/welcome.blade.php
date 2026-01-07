<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Turismo Local') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col font-sans">
        
        <!-- Header con Navegación (Funcionalidad Original Preservada) -->
        <header class="w-full lg:max-w-6xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-between">
                    <!-- Brand Logo Area -->
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                            <i class="fas fa-map-location-dot text-sm"></i>
                        </div>
                        <span class="font-bold text-lg tracking-tight dark:text-white">Turismo<span class="text-blue-600">Local</span></span>
                    </div>

                    <div class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="inline-block px-5 py-2 dark:text-[#EDEDEC] border-[#19140035] hover:border-blue-600 border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-white rounded-full text-sm font-medium transition-all"
                            >
                                Ir al Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="inline-block px-5 py-2 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:text-blue-600 rounded-full text-sm font-medium transition-all"
                            >
                                Iniciar Sesión
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="inline-block px-6 py-2 bg-blue-600 text-white hover:bg-blue-700 rounded-full text-sm font-bold shadow-lg shadow-blue-500/20 transition-all transform active:scale-95">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    </div>
                </nav>
            @endif
        </header>

        <!-- Main Content Section (Estructura de Laravel Preservada) -->
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-6xl lg:flex-row shadow-2xl rounded-3xl overflow-hidden border border-slate-100 dark:border-slate-800">
                
                <!-- Left Side: Welcome Text -->
                <div class="text-[13px] leading-[20px] flex-1 p-8 pb-12 lg:p-16 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] flex flex-col justify-center">
                    <nav class="flex mb-4 text-blue-600 text-[10px] font-black uppercase tracking-widest">
                        <span>Explora el Altiplano</span>
                        <span class="mx-2 text-slate-300">/</span>
                        <span class="text-slate-400">Puno - Perú</span>
                    </nav>

                    <h1 class="text-4xl lg:text-6xl font-extrabold mb-4 leading-tight tracking-tighter">
                        Descubre la magia del <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">Lago Titicaca</span>
                    </h1>
                    
                    <p class="text-lg mb-8 text-[#706f6c] dark:text-[#A1A09A] leading-relaxed">
                        Tu guía definitiva para explorar los atractivos más impresionantes, la mejor gastronomía típica y festividades únicas en la región más alta del mundo.
                    </p>

                    <!-- Feature List (Sustituye la lista original de Laravel por una Turística) -->
                    <ul class="flex flex-col gap-4 mb-10">
                        <li class="flex items-center gap-4 group">
                            <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/20 rounded-xl flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                                <i class="fas fa-mountain-sun"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 dark:text-white">Atractivos Naturales</h4>
                                <p class="text-xs text-slate-500">Islas de los Uros, Taquile y Amantaní.</p>
                            </div>
                        </li>
                        <li class="flex items-center gap-4 group">
                            <div class="w-10 h-10 bg-orange-50 dark:bg-orange-900/20 rounded-xl flex items-center justify-center text-orange-600 group-hover:scale-110 transition-transform">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 dark:text-white">Ruta Gastronómica</h4>
                                <p class="text-xs text-slate-500">Los mejores restaurantes y picanterías.</p>
                            </div>
                        </li>
                        <li class="flex items-center gap-4 group">
                            <div class="w-10 h-10 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 dark:text-white">Eventos y Cultura</h4>
                                <p class="text-xs text-slate-500">Agenda de la Candelaria y ferias locales.</p>
                            </div>
                        </li>
                    </ul>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-slate-900 dark:bg-white dark:text-slate-900 text-white rounded-2xl font-bold text-sm shadow-xl hover:shadow-slate-500/20 transition-all active:scale-95">
                            Comenzar mi Aventura
                        </a>
                        <a href="#info" class="px-8 py-4 bg-white border border-slate-200 dark:bg-transparent dark:border-slate-700 dark:text-white rounded-2xl font-bold text-sm hover:bg-slate-50 transition-all flex items-center gap-2">
                            Saber más <i class="fas fa-chevron-down text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <!-- Right Side: Visual Hero (Sustituye el SVG complejo por una sección de imagen/diseño) -->
                <div class="bg-blue-600 dark:bg-blue-900 relative lg:-ml-px -mb-px lg:mb-0 aspect-[335/376] lg:aspect-auto w-full lg:w-[480px] shrink-0 overflow-hidden flex items-center justify-center">
                    <!-- Overlay de Gradiente Decorativo -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-indigo-900 opacity-90"></div>
                    
                    <!-- Formas Geométricas de Fondo (Inspiración Textil Andina sutil) -->
                    <div class="absolute inset-0 opacity-10 pointer-events-none">
                        <svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <path d="M0 100 L50 0 L100 100 Z" fill="white"/>
                            <path d="M0 0 L50 100 L100 0 Z" fill="white" transform="translate(0, 50)"/>
                        </svg>
                    </div>

                    <!-- Contenido Central Visual -->
                    <div class="relative z-10 text-center p-12">
                        <div class="w-24 h-24 bg-white/10 backdrop-blur-xl border border-white/20 rounded-[2.5rem] mx-auto mb-8 flex items-center justify-center text-white text-4xl shadow-2xl animate-bounce duration-[3000ms]">
                            <i class="fas fa-camera-retro"></i>
                        </div>
                        <h3 class="text-white text-2xl font-black mb-4 uppercase tracking-tighter italic">Captura Momentos</h3>
                        <p class="text-blue-100 text-sm font-medium leading-relaxed">
                            "Puno no es solo un destino, es una experiencia que transforma el alma."
                        </p>
                        
                        <!-- Mini Cards Flotantes (UI/UX Impact) -->
                        <div class="absolute top-10 right-10 w-24 h-24 bg-white/5 border border-white/10 rounded-3xl backdrop-blur-md hidden lg:block rotate-12"></div>
                        <div class="absolute bottom-10 left-10 w-16 h-16 bg-blue-400/20 border border-white/10 rounded-2xl backdrop-blur-md hidden lg:block -rotate-12"></div>
                    </div>

                    <!-- Badge de Ubicación -->
                    <div class="absolute bottom-8 right-8 px-4 py-2 bg-white/95 backdrop-blur rounded-xl shadow-2xl flex items-center gap-2">
                        <i class="fas fa-location-dot text-red-500"></i>
                        <span class="text-[10px] font-bold text-slate-800 uppercase tracking-widest">Puno, 3827 msnm</span>
                    </div>
                </div>
            </main>
        </div>

        <!-- Footer sutil -->
        <footer class="mt-8 text-slate-400 text-[10px] uppercase tracking-[0.3em] font-bold text-center">
            UNAP • Ingeniería de Software II • 2025
        </footer>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>