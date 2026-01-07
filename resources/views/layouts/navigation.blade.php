<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo con estilo premium -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 group">
                        <div class="bg-blue-600 p-2 rounded-xl group-hover:rotate-6 transition-transform">
                            <i class="fas fa-mountain-sun text-white text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900 tracking-tighter">Turismo<span class="text-blue-600">Local</span></span>
                    </a>
                </div>

                <!-- Navigation Links (RF3, RF4, RF5) -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-sm font-semibold hover:text-blue-600 transition">
                        <i class="fas fa-th-large mr-2 opacity-50"></i> {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <!-- Enlace ejemplo para Catálogo (RF3) -->
                    <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-blue-600 hover:border-blue-300 focus:outline-none transition duration-150 ease-in-out">
                        <i class="fas fa-map-marked-alt mr-2 opacity-50"></i> Atractivos
                    </a>
                </div>
            </div>

            <!-- Right Side: Auth & Language -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                
                @auth
                    <!-- Settings Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-gray-200 text-sm leading-4 font-bold rounded-xl text-gray-700 bg-white hover:bg-gray-50 hover:border-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-100 transition ease-in-out duration-150 shadow-sm">
                                <div class="h-6 w-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-2">
                                    <i class="fas fa-user text-xs"></i>
                                </div>
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1 text-gray-400">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2 text-xs text-gray-400 font-bold uppercase tracking-widest border-b border-gray-100">Mi Cuenta</div>
                            
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                                <i class="fas fa-id-card mr-2 opacity-50"></i> {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        class="text-red-600 flex items-center"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt mr-2 opacity-50"></i> {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                @guest
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-blue-600 transition">
                            {{ __('Log in') }}
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 transition transform active:scale-95">
                            {{ __('Register') }}
                        </a>
                    </div>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100 bg-white">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-xl">
                <i class="fas fa-th-large mr-2"></i> {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition">
                <i class="fas fa-map-marked-alt mr-2"></i> Atractivos
            </a>
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-100">
                <div class="px-6 flex items-center">
                    <div class="h-10 w-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="ms-3">
                        <div class="font-bold text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1 px-4">
                    <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl">
                        <i class="fas fa-user-circle mr-2"></i> {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                class="text-red-600 rounded-xl"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth

        @guest
            <div class="pt-4 pb-6 border-t border-gray-100 px-6 space-y-3">
                <a href="{{ route('login') }}" class="block w-full text-center py-2 text-base font-bold text-gray-700 border border-gray-200 rounded-xl">
                    {{ __('Log in') }}
                </a>
                <a href="{{ route('register') }}" class="block w-full text-center py-2 text-base font-bold text-white bg-blue-600 rounded-xl shadow-lg shadow-blue-100">
                    {{ __('Register') }}
                </a>
            </div>
        @endguest
    </div>
</nav>