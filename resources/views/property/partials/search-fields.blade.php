<div class="flex flex-col md:flex-row md:space-x-6 space-y-4 md:space-y-0">
    <!-- Tipo de Imóvel -->
    <div class="w-full md:w-1/2">
        <label for="property-type" class="block text-gray-800 font-semibold mb-2">Tipo de Imóvel</label>
        <div class="relative">
            <select id="property-type"
                    class="w-full p-3 pl-4 pr-10 bg-white border border-gray-300 rounded-xl shadow-sm appearance-none text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                <option selected>Moradias</option>
                <option>Apartamentos</option>
                <option>Terrenos</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-gray-500">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Local -->
    <div class="w-full md:w-1/2">
        <label for="location" class="block text-gray-800 font-semibold mb-2">Local</label>
        <input
            type="text"
            id="location"
            value="Aveiro"
            class="w-full px-5 py-3 text-gray-800 bg-white border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
        />
    </div>
</div>

<!-- Botão de Pesquisa (separado) -->
<div class="mt-5 flex justify-center">
    <button
        type="button"
        class="px-6 py-3 bg-blue-900 text-white hover:bg-blue-800 rounded-full shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-2"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <span>Pesquisar</span>
    </button>
</div>
