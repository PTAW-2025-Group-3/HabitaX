{{-- Navbar --}}
<nav class="w-full fixed top-0 z-50 backdrop-blur-xl bg-white/70 shadow-lg border-b border-gray-200">
    <div class="max-w-screen-xl mx-auto px-6 py-4 flex items-center justify-between">
        {{-- Logo & Name --}}
        <a href="/" class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-blue-900 rounded-full shadow-lg transform hover:scale-110 transition-all duration-300 overflow-hidden">
                <img src="{{ asset('images/logos/habitaxLogo.png') }}" alt="HabitaXLogo" class="mt-1 object-cover">
            </div>
            <span class="text-2xl font-bold text-gray-secondary tracking-tight">Habita<span class="text-secondary">X</span></span>
        </a>

        {{-- Mobile Menu Button --}}
        <div class="md:hidden">
            <button id="mobileMenuButton" class="text-gray-secondary focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path id="menuIcon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path id="closeIcon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- Main Navigation Links (Desktop) --}}
        <div class="hidden md:flex items-center space-x-10">
            <a href="/" class="relative group text-gray-secondary font-medium text-lg transition-all duration-300">
                Home
                <span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-secondary group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="{{ route('advertisements.index') }}" class="relative group text-gray-secondary font-medium text-lg transition-all duration-300">
                Anúncios
                <span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-secondary group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="{{ route('about') }}" class="relative group text-gray-secondary font-medium text-lg transition-all duration-300">
                Sobre Nós
                <span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-secondary group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="{{ route('contact') }}" class="relative group text-gray-secondary font-medium text-lg transition-all duration-300">
                Contactos
                <span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-secondary group-hover:w-full transition-all duration-300"></span>
            </a>
        </div>

        {{-- CTA / Auth (Desktop) --}}
        <div class="hidden md:flex items-center space-x-5">
            @guest
                <a href="{{ route('login') }}" class="text-gray hover:text-indigo-600 text-md font-medium transition-all duration-300">
                    Iniciar Sessão
                </a>
            @else
                {{-- Authenticated Dropdown --}}
                <div class="relative" id="userDropdown">
                    <button id="dropdownButton" class="flex items-center space-x-2 focus:outline-none">
                        <img src="https://i.pravatar.cc/40?u={{ auth()->user()->id }}"
                             class="w-8 h-8 rounded-full ring-2 ring-gray-200 hover:ring-indigo-500 transition-all duration-300"
                             alt="User Avatar">
                        <span class="text-gray-secondary font-semibold">{{ auth()->user()->name }}</span>
                    </button>

                    <div
                        id="dropdownMenu"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-1 hidden">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <img src="https://i.pravatar.cc/40?u={{ auth()->user()->id }}"
                                     class="w-10 h-10 rounded-full"
                                     alt="User Avatar">
                                <div>
                                    <p class="text-sm font-semibold text-gray-secondary">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center px-4 py-2 text-sm text-gray-secondary hover:bg-gray-100">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Perfil
                        </a>
                        <a href="{{ route('advertisements.favorites') }}"
                           class="flex items-center px-4 py-2 text-sm text-gray-secondary hover:bg-gray-100">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4 4 0 000 6.364L12 20.364l7.682-7.682a4 4 0 00-6.364-6.364L12 7.636l-1.318-1.318a4 4 0 00-6.364 0z" />
                            </svg>
                            Favoritos
                        </a>
                        {{--   estas opções serão visiveis apos verificação de anunciante   --}}
                        @if(auth()->user()->advertiser_number)
                            <a href="{{ route('contact-requests.index') }}"
                               class="flex items-center px-4 py-2 text-sm text-gray-secondary hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Pedidos de Contacto
                            </a>
                            <a href="{{ route('properties.my') }}"
                               class="flex items-center px-4 py-2 text-sm text-gray-secondary hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Minhas Propriedades
                            </a>
                            <a href="{{ route('advertisements.my') }}"
                               class="flex items-center px-4 py-2 text-sm text-gray-secondary hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                                Meus Anúncios
                            </a>
                        @endif
                        {{-- Apenas visivel para moderadores --}}
                        @if(auth()->user()->isModerator())
                            <a href="{{ route('moderation') }}"
                               class="flex items-center px-4 py-2 text-sm text-gray-secondary hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 0v4m0-4h4m-4 0H8m8 8H4a2 2 0 01-2-2V6a2 2 0 012-2h16a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                </svg>
                                Painel de Moderação
                            </a>
                        @endif
                        {{-- Apenas visivel para administradores --}}
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.index') }}"
                               class="flex items-center px-4 py-2 text-sm text-gray-secondary hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 0v4m0-4h4m-4 0H8m8 8H4a2 2 0 01-2-2V6a2 2 0 012-2h16a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                </svg>
                                Painel de Administração
                            </a>
                        @endif
                        <a href="{{ route('settings') }}"
                           class="flex items-center px-4 py-2 text-sm text-gray-secondary hover:bg-gray-100">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Configurações
                        </a>
                        <div class="border-t border-gray-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="flex w-full items-center px-4 py-2 text-sm text-red hover:bg-gray-100">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Terminar Sessão
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
            {{-- Criar anuncio Button --}}
            <a href="{{ auth()->check() ? route('properties.create') : route('advertisements.help') }}"
               class="relative px-6 py-2 btn-primary">
                <span class="z-10">Publicar Anúncio</span>
            </a>
        </div>
    </div>

    {{-- Mobile Menu --}}
    @include('layout.header_mobile')
</nav>

{{-- JavaScript for menu functionality --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Desktop dropdown menu
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        if (dropdownButton && dropdownMenu) {
            // Toggle dropdown when button is clicked
            dropdownButton.addEventListener('click', function(event) {
                dropdownMenu.classList.toggle('hidden');
                event.stopPropagation();
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInside = dropdownButton.contains(event.target) ||
                    dropdownMenu.contains(event.target);

                if (!isClickInside) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }

        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuIcon = document.getElementById('menuIcon');
        const closeIcon = document.getElementById('closeIcon');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        }
    });
</script>
