@extends('layout.app')

@section('title', 'Minha Conta')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row gap-8">
                {{-- Sidebar --}}
                <div class="w-full md:w-64 flex-shrink-0">
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center space-x-4">
                                <img src="https://i.pravatar.cc/40?u={{ auth()->user()->id }}"
                                     alt="Profile"
                                     class="w-12 h-12 rounded-full">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-secondary">{{ auth()->user()->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>

                        <nav class="px-4 pb-4">
                            <div class="space-y-1">
                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center px-4 py-2 text-sm font-medium text-gray-secondary  rounded-md hover:bg-gray-50 group {{ request()->routeIs('profile.edit') ? 'bg-gray-50' : '' }}">
                                    <i class="bi bi-person-fill me-3 text-gray-400 group-hover:text-gray"></i>
                                    Perfil
                                </a>

                                <a href="{{ route('advertisements.favorites') }}"
                                   class="flex items-center px-4 py-2 text-sm font-medium text-gray-secondary  rounded-md hover:bg-gray-50 group {{ request()->routeIs('advertisements.favorites') ? 'bg-gray-50' : '' }}">
                                    <i class="bi bi-heart-fill me-3 text-gray-400 group-hover:text-gray"></i>
                                    Favoritos
                                </a>

                                <a href="{{ route('advertiser-verification') }}"
                                   class="flex items-center px-4 py-2 text-sm font-medium text-gray-secondary  rounded-md hover:bg-gray-50 group {{ request()->routeIs('advertiser-verification') ? 'bg-gray-50' : '' }}">
                                    <i class="bi bi-shield-check me-3 text-gray-400 group-hover:text-gray"></i>
                                    Verificação de Anunciante
                                </a>


                                <a href="{{ route('properties.my') }}"
                                   class="flex items-center px-4 py-2 text-sm font-medium text-gray-secondary  rounded-md hover:bg-gray-50 group {{ request()->routeIs('properties.my') ? 'bg-gray-50' : '' }}">
                                    <i class="bi bi-house-door-fill me-3 text-gray-400 group-hover:text-gray"></i>
                                    Minhas Propriedades
                                </a>

                                <a href="{{ route('advertisements.my') }}"
                                   class="flex items-center px-4 py-2 text-sm font-medium text-gray-secondary  rounded-md hover:bg-gray-50 group {{ request()->routeIs('advertisements.my') ? 'bg-gray-50' : '' }}">
                                    <i class="bi bi-megaphone-fill me-3 text-gray-400 group-hover:text-gray"></i>
                                    Meus Anúncios
                                </a>

                                <a href="{{ route('contact-requests') }}"
                                   class="flex items-center px-4 py-2 text-sm font-medium text-gray-secondary  rounded-md hover:bg-gray-50 group {{ request()->routeIs('contact-requests') ? 'bg-gray-50' : '' }}">
                                    <i class="bi bi-envelope-fill me-3 text-gray-400 group-hover:text-gray"></i>
                                    Pedidos de Contacto
                                </a>

                                <a href="{{ route('settings') }}"
                                   class="flex items-center px-4 py-2 text-sm font-medium text-gray-secondary rounded-md hover:bg-gray-50 group {{ request()->routeIs('settings') ? 'bg-gray-50' : '' }}">
                                    <i class="bi bi-gear-fill me-3 text-gray-400 group-hover:text-gray"></i>
                                    Configurações
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="flex-1">
                    @yield('account-content')
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
@endsection
