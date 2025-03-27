<nav class="w-full fixed top-0 z-50 backdrop-blur-xl bg-white/70 shadow-lg border-b border-gray-200">
    <div class="max-w-screen-xl mx-auto px-6 py-4 flex items-center justify-between">

        {{-- Logo & Name --}}
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-purple-500 rounded-full shadow-lg transform hover:scale-110 transition-all duration-300"></div>
            <span class="text-2xl font-bold text-gray-900 tracking-tight">Habita<span class="text-indigo-600">X</span></span>
        </div>

        {{-- Main Navigation Links --}}
        <div class="hidden md:flex items-center space-x-10">
            <a href="/" class="relative group text-gray-700 font-medium text-lg transition-all duration-300">
                Home
                <span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-indigo-500 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="#" class="relative group text-gray-700 font-medium text-lg transition-all duration-300">
                Sobre Nós
                <span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-indigo-500 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="{{ url('/contact') }}" class="relative group text-gray-700 font-medium text-lg transition-all duration-300">
                Contactos
                <span class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-indigo-500 group-hover:w-full transition-all duration-300"></span>
            </a>
        </div>

        {{-- CTA / Auth --}}
        <div class="hidden md:flex items-center space-x-5">
            @guest
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 text-md font-medium transition-all duration-300">
                    Iniciar Sessão
                </a>
            @else
                {{-- Authenticated Dropdown --}}
                <div id="profileDropdownWrapper" class="relative">
                    <button id="profileBtn" class="flex items-center space-x-2 focus:outline-none">
                        <img src="https://i.pravatar.cc/40?u={{ auth()->user()->id }}" class="w-8 h-8 rounded-full" alt="User Avatar">
                        <span class="text-gray-800 font-semibold">{{ auth()->user()->name }}</span>
                    </button>

                    <div id="profileMenu" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 invisible transition-all duration-300">
                        <a href="{{ route('account') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Perfil</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Adicionar propriedade</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Terminar Sessão →
                            </button>
                        </form>
                    </div>
                </div>
            @endguest

            {{-- CTA Button --}}
            <a href="{{ route('announcements.create') }}"
               class="relative inline-flex items-center justify-center px-6 py-2 bg-indigo-600 text-white font-semibold rounded-xl shadow-md transition-all duration-300 hover:bg-indigo-700 hover:scale-105 active:scale-95">
                <span class="z-10">Publicar Anúncio</span>
                <span class="absolute inset-0 bg-indigo-400 blur-xl opacity-30 rounded-xl"></span>
            </a>

            {{-- Mobile Burger Menu --}}
            <div class="md:hidden flex items-center">
                <button id="mobileMenuBtn" class="text-gray-700 focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="md:hidden px-6 pb-4 hidden flex-col gap-4 bg-white shadow-md">
            <a href="/" class="text-gray-700 hover:text-indigo-600 transition">Home</a>
            <a href="#" class="text-gray-700 hover:text-indigo-600 transition">Sobre Nós</a>
            <a href="{{ url('/contact') }}" class="text-gray-700 hover:text-indigo-600 transition">Contactos</a>
            @guest
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600">Iniciar Sessão</a>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 text-left">Terminar Sessão</button>
                </form>
            @endguest
            <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-center">Publicar Anúncio</a>
        </div>
</nav>

{{-- Spacer --}}
<div class="h-[80px]"></div>

{{-- Scripts --}}
<script>
    // Burger Menu Logic
    const btn = document.getElementById('mobileMenuBtn');
    const menu = document.getElementById('mobileMenu');
    btn?.addEventListener('click', () => {
        menu?.classList.toggle('hidden');
        menu?.classList.toggle('flex');
    });

    // Profile Dropdown Logic
    const profileBtn = document.getElementById('profileBtn');
    const profileMenu = document.getElementById('profileMenu');
    const wrapper = document.getElementById('profileDropdownWrapper');
    let hideTimeout;

    if (profileBtn && profileMenu && wrapper) {
        profileBtn.addEventListener('mouseenter', () => {
            clearTimeout(hideTimeout);
            profileMenu.classList.remove('opacity-0', 'invisible');
        });

        wrapper.addEventListener('mouseleave', () => {
            hideTimeout = setTimeout(() => {
                profileMenu.classList.add('opacity-0', 'invisible');
            }, 500);
        });

        profileMenu.addEventListener('mouseenter', () => {
            clearTimeout(hideTimeout);
        });

        profileMenu.addEventListener('mouseleave', () => {
            hideTimeout = setTimeout(() => {
                profileMenu.classList.add('opacity-0', 'invisible');
            }, 500);
        });
    }
</script>
