<div id="mobileMenu" class="hidden bg-white shadow-lg py-4 px-6 md:hidden">
    {{-- Mobile Navigation --}}
    <div class="flex flex-col space-y-4">
        <a href="{{ route('home') }}" class="text-gray font-medium text-lg py-2 border-b border-gray">Início</a>
        <a href="{{ route('advertisements.index') }}" class="text-gray font-medium text-lg py-2 border-b border-gray">Anúncios</a>
        <a href="{{ route('about') }}" class="text-gray font-medium text-lg py-2 border-b border-gray">Sobre Nós</a>
        <a href="{{ route('contact') }}" class="text-gray font-medium text-lg py-2 border-b border-gray">Contactos</a>
    </div>

    {{-- Mobile Auth/CTA --}}
    <div class="mt-6 flex flex-col space-y-4">
        @guest
            <a href="{{ route('login') }}" class="text-gray hover:text-indigo-600 text-md font-medium transition-all duration-300 py-2">
                Iniciar Sessão
            </a>
        @else
            <div class="flex items-center space-x-2 py-2">
                <img src="{{ auth()->user()->getProfilePictureURL() }}"
                     class="w-8 h-8 rounded-full ring-2 ring-gray-200"
                     alt="User Avatar">
                <span class="text-gray-secondary font-semibold">{{ auth()->user()->name }}</span>
            </div>
            <div class="flex flex-col space-y-2 pl-2">
                <a href="{{ route('profile.edit') }}" class="flex items-center py-2 text-sm text-gray-secondary">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Perfil
                </a>
                <a href="{{ route('advertisements.favorites') }}" class="flex items-center py-2 text-sm text-gray-secondary">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4 4 0 000 6.364L12 20.364l7.682-7.682a4 4 0 00-6.364-6.364L12 7.636l-1.318-1.318a4 4 0 00-6.364 0z" />
                    </svg>
                    Favoritos
                </a>
                <a href="{{ route('settings') }}" class="flex items-center py-2 text-sm text-gray-secondary">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Configurações
                </a>
                <form method="POST" action="{{ route('logout') }}" class="py-2">
                    @csrf
                    <button type="submit" class="flex w-full items-center text-sm text-red">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Terminar Sessão
                    </button>
                </form>
            </div>
        @endguest

        {{-- Mobile CTA Button --}}
        <a href="{{ auth()->check() ? route('properties.create') : route('advertisements.help') }}" class="relative px-6 py-2 btn-primary">
            Publicar Anúncio
        </a>
    </div>
</div>
