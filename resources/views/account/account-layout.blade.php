@extends('layout.app')

@section('title', 'Minha Conta')
@section('content')
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row gap-8">
                {{-- Sidebar --}}
                <div class="w-full md:w-72 flex-shrink-0">
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                        <div class="p-5 border-b border-gray-100">
                            <div class="flex flex-col items-center text-center">
                                <img src="{{ auth()->user()->getProfilePictureUrl() }}"
                                     alt="Foto de perfil"
                                     class="w-16 h-16 rounded-full object-cover border-2 border-primary/20 mb-3">
                                <div class="w-full">
                                    <h3 class="text-base font-semibold text-gray-800 mb-1 line-clamp-1">
                                        {{ auth()->user()->name }}
                                    </h3>
                                    <p class="text-sm text-gray-500 break-all line-clamp-1" title="{{ auth()->user()->email }}">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <nav class="p-3">
                            <div class="space-y-1">
                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center px-4 py-2.5 text-sm font-medium rounded-md transition-colors duration-150
                                   {{ request()->routeIs('profile.edit') ? 'bg-primary/5 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <i class="bi bi-person-fill me-3 {{ request()->routeIs('profile.edit') ? 'text-primary' : 'text-gray-500' }}"></i>
                                    <span class="truncate">Perfil</span>
                                </a>

                                <a href="{{ route('advertisements.favorites') }}"
                                   class="flex items-center px-4 py-2.5 text-sm font-medium rounded-md transition-colors duration-150
                                   {{ request()->routeIs('advertisements.favorites') || request()->routeIs('favorites.index') ? 'bg-primary/5 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <i class="bi bi-heart-fill me-3 {{ request()->routeIs('advertisements.favorites') || request()->routeIs('favorites.index') ? 'text-primary' : 'text-gray-500' }}"></i>
                                    <span class="truncate">Favoritos</span>
                                </a>
                                @if(!auth()->user()->is_advertiser)
                                    @php
                                        $verifications = auth()->user()->advertiserVerifications;
                                        $hasPendingVerification = $verifications->where('verification_advertiser_state', 0)->count() > 0;
                                        $hasRejectedVerification = $verifications->where('verification_advertiser_state', 2)->count() > 0;
                                        $hasAnyVerification = $verifications->count() > 0;
                                    @endphp

                                    <a href="{{ $hasAnyVerification ? route('advertiser-verifications.list') : route('advertiser-verifications.create') }}"
                                       class="flex items-center px-4 py-2.5 text-sm font-medium rounded-md transition-colors duration-150
                                        {{ request()->routeIs('advertiser-verifications.list', 'advertiser-verifications.create') ? 'bg-primary/5 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                                        <i class="bi bi-shield-check me-3 {{ request()->routeIs('advertiser-verifications.list', 'advertiser-verifications.create') ? 'text-primary' : 'text-gray-500' }}"></i>
                                        <span class="truncate">Verificação de Anunciante</span>
                                    </a>
                                @endif

                                @if(auth()->user()->is_advertiser)
                                    <a href="{{ route('properties.my') }}"
                                       class="flex items-center px-4 py-2.5 text-sm font-medium rounded-md transition-colors duration-150
                                       {{ request()->routeIs('properties.my') ? 'bg-primary/5 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                                        <i class="bi bi-house-door-fill me-3 {{ request()->routeIs('properties.my') ? 'text-primary' : 'text-gray-500' }}"></i>
                                        <span class="truncate">Minhas Propriedades</span>
                                    </a>

                                    <a href="{{ route('advertisements.my') }}"
                                       class="flex items-center px-4 py-2.5 text-sm font-medium rounded-md transition-colors duration-150
                                       {{ request()->routeIs('advertisements.my') ? 'bg-primary/5 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                                        <i class="bi bi-megaphone-fill me-3 {{ request()->routeIs('advertisements.my') ? 'text-primary' : 'text-gray-500' }}"></i>
                                        <span class="truncate">Meus Anúncios</span>
                                    </a>
                                @endif

                                <a href="{{ route('contact-requests.index') }}"
                                   class="flex items-center px-4 py-2.5 text-sm font-medium rounded-md transition-colors duration-150
                                   {{ request()->routeIs('contact-requests.index') ? 'bg-primary/5 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <i class="bi bi-envelope-fill me-3 {{ request()->routeIs('contact-requests.index') ? 'text-primary' : 'text-gray-500' }}"></i>
                                    <span class="truncate">Pedidos de Contacto</span>
                                </a>

                                <a href="{{ route('settings') }}"
                                   class="flex items-center px-4 py-2.5 text-sm font-medium rounded-md transition-colors duration-150
                                   {{ request()->routeIs('settings') ? 'bg-primary/5 text-primary' : 'text-gray-700 hover:bg-gray-50' }}">
                                    <i class="bi bi-gear-fill me-3 {{ request()->routeIs('settings') ? 'text-primary' : 'text-gray-500' }}"></i>
                                    <span class="truncate">Configurações</span>
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
@endsection
