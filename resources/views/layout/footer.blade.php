<footer class="bg-gray-900 text-gray-300 pt-14 pb-10 px-6 lg:px-20 mt-20">
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">

        {{--About Section --}}
        <div>
            <div class="flex items-center mb-4 space-x-3">
                <div class="w-10 h-10 bg-indigo-600 rounded-full shadow-xl"></div>
                <span class="text-2xl font-bold text-white tracking-tight">Habita<span class="text-indigo-400">X</span></span>
            </div>
            <p class="text-gray-400 leading-relaxed text-sm">
                A tua plataforma de confiança para explorar, publicar e gerir propriedades reais por Portugal inteiro!
            </p>
        </div>

        {{--Quick Links --}}
        <div>
            <h3 class="text-white font-semibold mb-4 text-lg">Links: </h3>
            <ul class="space-y-2 text-sm">
                <li><a href="/" class="hover:text-indigo-400 transition">Home</a></li>
                <li><a href="#" class="hover:text-indigo-400 transition">Sobre Nós</a></li>
                <li><a href="#" class="hover:text-indigo-400 transition">Contacte-nos</a></li>
                <li><a href="#" class="hover:text-indigo-400 transition">Iniciar Sessão</a></li>
                <li><a href="#" class="hover:text-indigo-400 transition">Publicar Anúncio</a></li>
            </ul>
        </div>

        {{--Newsletter --}}
        <div>
            <h3 class="text-white font-semibold mb-4 text-lg">Subscribe</h3>
            <p class="text-gray-400 text-sm mb-4">
                Subscreve a nossa newsletter para receber as mais recentes ofertas e insights sobre propriedades.
            </p>
            <form class="flex flex-col sm:flex-row gap-3">
                <input type="email" placeholder="exemplo@email.com"
                       class="w-full px-4 py-2 rounded-lg text-sm bg-gray-800 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                <button type="submit"
                        class="px-5 py-2 rounded-lg text-sm bg-indigo-600 hover:bg-indigo-700 text-white transition-all shadow-md">
                    Subscreve!
                </button>
            </form>
        </div>
    </div>

    {{--Divider Line --}}
    <div class="border-t border-gray-700 mt-12 pt-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} HabitaX. Todos os direitos reservados.
    </div>
</footer>
