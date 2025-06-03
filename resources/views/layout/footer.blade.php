<footer class="bg-gray-900 text-gray-300 pt-14 pb-10 px-6 lg:px-20 mt-20">
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">

        {{--About Section --}}
        <div class="text-center md:text-left mx-auto md:mx-0 max-w-xs">
            <div class="flex items-center mb-4 justify-center md:justify-start space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-blue-900 rounded-full shadow-lg transform hover:scale-110 transition-all duration-300 overflow-hidden">
                    <img src="{{ asset('images/logos/habitaxLogo.png') }}" alt="HabitaXLogo" class="mt-1 object-cover">
                </div>
                <span class="text-2xl font-bold text-white tracking-tight">Habita<span class="text-indigo-400">X</span></span>
            </div>
            <p class="text-gray-400 leading-relaxed text-sm">
                A tua plataforma de confiança para explorar, publicar e gerir propriedades reais por Portugal inteiro!
            </p>
        </div>

        {{--Quick Links --}}
        <div class="grid grid-cols-2 gap-6 mx-auto w-full max-w-md">
            <div class="text-center md:text-left">
                <h3 class="text-white font-semibold mb-4 text-lg">Links: </h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/" class="hover:text-indigo-400 transition">Início</a></li>
                    <li><a href="/contact" class="hover:text-indigo-400 transition">Contactos</a></li>
                    <li><a href="/about" class="hover:text-indigo-400 transition">Sobre Nós</a></li>
                    <li><a href="/noticias" class="hover:text-indigo-400 transition">Notícias</a></li>
                    <li><a href="/login" class="hover:text-indigo-400 transition">Iniciar Sessão</a></li>
                    <li><a href="{{ auth()->check() && auth()->user()->is_advertiser ? route('advertisements.my') : route('advertisements.help') }}" class="hover:text-indigo-400 transition">Publicar Anúncio</a></li>
                </ul>
            </div>
            <div class="text-center md:text-left">
                <h3 class="text-white font-semibold mb-4 text-lg">Legal: </h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/politica-de-privacidade" class="hover:text-indigo-400 transition">Política de Privacidade</a></li>
                    <li><a href="/condicoes-gerais" class="hover:text-indigo-400 transition">Termos e Condições</a></li>
                </ul>
            </div>
        </div>

        {{-- Adiciona um terceiro bloco para balancear o layout --}}
        <div class="text-center md:text-right mx-auto md:mx-0 max-w-xs">
            <h3 class="text-white font-semibold mb-4 text-lg">Contacte-nos: </h3>
            <ul class="space-y-2 text-sm">
                <li class="flex items-center justify-center md:justify-end">
                    <i class="bi bi-envelope mr-2"></i>
                    <a href="mailto:info@habitax.pt" class="hover:text-indigo-400 transition">habitaxsupport@gmail.com</a>
                </li>
                <li class="flex items-center justify-center md:justify-end">
                    <i class="bi bi-geo-alt mr-2"></i>
                    <span>Águeda, Portugal</span>
                </li>
            </ul>
        </div>
    </div>

    {{--Divider Line --}}
    <div class="border-t border-gray-700 mt-12 pt-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} HabitaX. Todos os direitos reservados.
    </div>
</footer>
