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
                                <h3 class="text-lg font-medium text-gray-900">{{ auth()->user()->name }}</h3>
                                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    <nav class="px-4 pb-4">
                        <div class="space-y-1">
                            <a href="{{ route('profile.edit') }}" 
                               class="flex items-center px-4 py-2 text-sm font-medium text-gray-900 rounded-md hover:bg-gray-50 group {{ request()->routeIs('profile.edit') ? 'bg-gray-50' : '' }}">
                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Perfil
                            </a>

                            <a href="{{ route('favorites') }}" 
                               class="flex items-center px-4 py-2 text-sm font-medium text-gray-900 rounded-md hover:bg-gray-50 group {{ request()->routeIs('favorites') ? 'bg-gray-50' : '' }}">
                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                Favoritos
                            </a>

                            <a href="{{ route('my-properties') }}" 
                               class="flex items-center px-4 py-2 text-sm font-medium text-gray-900 rounded-md hover:bg-gray-50 group {{ request()->routeIs('my-properties') ? 'bg-gray-50' : '' }}">
                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Minhas Propriedades
                            </a>

                            <a href="{{ route('settings') }}" 
                               class="flex items-center px-4 py-2 text-sm font-medium text-gray-900 rounded-md hover:bg-gray-50 group {{ request()->routeIs('settings') ? 'bg-gray-50' : '' }}">
                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
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
