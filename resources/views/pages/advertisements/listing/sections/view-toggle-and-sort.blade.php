<div class="flex justify-between items-center mb-6">
    <!-- Botões de visualização -->
    <div class="flex space-x-2">
        <button @click="view = 'grid'"
                :class="view === 'grid' ? 'bg-gray-200' : 'hover:bg-gray-200'"
                class="p-2 rounded-md transition-colors">
            <svg class="h-5 w-5"
                 :class="view === 'grid' ? 'text-gray-700' : 'text-gray-400'"
                 xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <button @click="view = 'list'"
                :class="view === 'list' ? 'bg-gray-200' : 'hover:bg-gray-200'"
                class="p-2 rounded-md transition-colors">
            <svg class="h-5 w-5"
                 :class="view === 'list' ? 'text-gray-700' : 'text-gray-400'"
                 xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 10h16M4 14h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Select mais bonito -->
    <div class="flex items-center">
        <label for="sort" class="text-sm text-gray-600 mr-2">Ordenar Por:</label>
        <div class="relative">
            <select id="sort"
                    class="appearance-none w-full pl-4 pr-10 py-2 border border-gray-300 text-sm text-gray-800 bg-white rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-900 transition">
                <option>Mais Recentes</option>
                <option>Preço: Mais baixo</option>
                <option>Preço: Mais alto</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
    </div>
</div>
