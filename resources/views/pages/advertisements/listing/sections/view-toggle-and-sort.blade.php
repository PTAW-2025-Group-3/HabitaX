<div class="flex justify-between items-center mb-6">
    <!-- Botões de visualização -->
    <div class="flex space-x-2">
        <button @click="view = 'grid'"
                :class="view === 'grid' ? 'bg-gray-200' : 'hover:bg-gray-200'"
                class="h-10 w-10 rounded-md transition-colors">
            <i class="bi bi-view-list text-xl"
            :class="view === 'grid' ? 'text-gray-700' : 'text-gray-400'"></i>
        </button>
        <button @click="view = 'list'"
                :class="view === 'list' ? 'bg-gray-200' : 'hover:bg-gray-200'"
                class="h-10 w-10 rounded-md transition-colors">
            <i class="bi bi-list text-2xl"
               :class="view === 'list' ? 'text-gray-700' : 'text-gray-400'"></i>
        </button>
    </div>

    <!-- Select -->
    <div class="flex items-center">
        <label for="sort" class="text-sm text-gray-600 mr-2">Ordenar Por:</label>
        <div class="relative dropdown-wrapper">
            <select id="sort"
                    class="w-full pl-4 pr-10 py-2 dropdown-select">
                <option>Mais Recentes</option>
                <option>Preço: Mais baixo</option>
                <option>Preço: Mais alto</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
            </div>
        </div>
    </div>
</div>
