{{-- Div para sobrepor a searchbar e o nome por trás --}}
<div class="w-full flex flex-col items-center justify-start bg-back">
    {{-- Container Principal - Hidden on mobile --}}
    <div class="text-[280px] md:text-[200px] lg:text-[280px] font-extrabold text-black opacity-90 relative z-10 select-none hidden md:block">HabitaX</div>

    {{-- Versão mobile: título menor e visível - Reposicionado acima do menu --}}
    <div class="text-5xl font-extrabold text-black opacity-90 relative z-20 select-none block md:hidden mt-6 mb-4">HabitaX</div>

    <div class="relative md:absolute z-20 w-full max-w-5xl mx-auto bg-blue-800 bg-opacity-50 backdrop-blur-md rounded-2xl px-4 sm:px-6 py-6 sm:py-8 mt-0 md:mt-36 shadow-[0_20px_40px_rgba(0,0,0,0.3)] transition-all duration-500">
        <h2 class="text-center text-white text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold mb-4 sm:mb-6">
            O teu Espaço, <span class="text-gray-300 font-light">a tua Escolha</span>
        </h2>

        <form action="{{ route('advertisements.index') }}" method="GET" class="flex flex-col sm:flex-row flex-wrap justify-center gap-3 md:gap-2 lg:gap-4 items-center">
            {{-- Property Type Toggle --}}
            <div class="flex gap-0.5 w-full sm:w-auto">
                <button type="button" id="buyBtn"
                        class="property-toggle bg-primary text-white font-semibold px-3 sm:px-5 py-2 rounded-l-md shadow-md transition-all duration-300 flex-1 sm:flex-none">
                    Comprar
                </button>
                <button type="button" id="rentBtn"
                        class="property-toggle bg-gray-100 text-gray-800 font-semibold px-3 sm:px-5 py-2 rounded-r-md shadow-md transition-all duration-300 flex-1 sm:flex-none">
                    Arrendar
                </button>
            </div>

            {{-- Property Category --}}
            <div class="relative dropdown-wrapper w-full sm:w-auto">
                <select
                    class="py-2 pl-4 pr-10 w-full h-10 dropdown-select">
                    <option>Moradias</option>
                    <option>Apartamentos</option>
                    <option>Terrenos</option>
                    <option>Comércio</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>

            {{-- Location Field --}}
            <input type="text" placeholder="Localização, Cidade, Zona"
                   class="w-full sm:w-56 md:w-72 px-5 py-2 rounded-md bg-back text-gray-secondary shadow focus:outline-none focus:ring-2 focus:ring-indigo-400 transition-all" />

            {{-- Search Button --}}
            <button type="submit" class="px-3 py-3 btn-primary h-12 w-full sm:w-12">
                <i class="bi bi-search text-lg"></i>
                <span class="sm:hidden ml-2">Pesquisar</span>
            </button>
        </form>
    </div>
</div>

{{-- Espaçador para versão mobile para evitar sobreposição --}}
<div class="h-16 block md:hidden"></div>

{{-- JavaScript for toggle effect --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buyBtn = document.getElementById('buyBtn');
        const rentBtn = document.getElementById('rentBtn');

        buyBtn.addEventListener('click', () => {
            buyBtn.classList.add('bg-primary', 'text-white');
            buyBtn.classList.remove('bg-gray-100', 'text-gray-800');

            rentBtn.classList.remove('bg-blue-900', 'text-white');
            rentBtn.classList.add('bg-gray-100', 'text-gray-800');
        });

        rentBtn.addEventListener('click', () => {
            rentBtn.classList.add('bg-blue-900', 'text-white');
            rentBtn.classList.remove('bg-gray-100', 'text-gray-800');

            buyBtn.classList.remove('bg-primary', 'text-white');
            buyBtn.classList.add('bg-gray-100', 'text-gray-800');
        });
    });
</script>
