<div class="flex flex-col md:flex-row md:space-x-6 space-y-4 md:space-y-0">
    <!-- Tipo de Imóvel -->
    <div class="w-full md:w-1/2">
        <label for="property-type" class="block text-gray-800 font-semibold mb-2">Tipo de Imóvel</label>
        <div class="relative dropdown-wrapper">
            <select id="property-type"
                    class="p-3 pl-4 pr-10 w-full dropdown-select">
                <option selected>Moradias</option>
                <option>Apartamentos</option>
                <option>Terrenos</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-gray-500">
                <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
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

    <!-- Botão de Pesquisa (separado) -->
    <div class="w-full md:w-auto flex items-end">
        <button
            type="button"
            class="w-full md:w-auto px-5 py-3 btn-primary"
        >
            <i class="bi bi-search mr-2"></i>
            <span>Pesquisar</span>
        </button>
    </div>

</div>


