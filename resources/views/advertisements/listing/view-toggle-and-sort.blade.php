<div class="flex justify-between items-center mb-6">
    <!-- Botões de visualização -->
    <div class="flex space-x-2">
        <button @click="view = 'grid'; $event.preventDefault()"
                :class="view === 'grid' ? 'bg-gray-200' : 'hover:bg-gray-200'"
                class="h-10 w-10 rounded-md transition-colors">
            <i class="bi bi-grid text-xl"
               :class="view === 'grid' ? 'text-gray-700' : 'text-gray-400'"></i>
        </button>
        <button @click="view = 'list'; $event.preventDefault()"
                :class="view === 'list' ? 'bg-gray-200' : 'hover:bg-gray-200'"
                class="h-10 w-10 rounded-md transition-colors">
            <i class="bi bi-list text-2xl"
               :class="view === 'list' ? 'text-gray-700' : 'text-gray-400'"></i>
        </button>
    </div>

    <!-- Select de ordenação -->
    <div class="flex items-center">
        <label for="sort" class="text-sm text-gray-600 mr-2">Ordenar Por:</label>
        <div class="relative dropdown-wrapper">
            <select id="sort"
                    class="w-full pl-4 pr-10 py-2 dropdown-select"
                    x-on:change="updateSort($event)">
                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Mais Recentes</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Preço: Mais baixo</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Preço: Mais alto</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
            </div>
        </div>
    </div>
</div>

<script>
    // Função para atualizar a ordenação mantendo os filtros
    function updateSort(event) {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', event.target.value);
        url.searchParams.delete('page'); // Resetar para primeira página

        window.location.href = url.toString();
    }

    // Inicialização do Alpine.js (se necessário)
    document.addEventListener('alpine:init', () => {
        Alpine.data('page', () => ({
            view: 'grid',
            init() {
                // Restaurar view preference se existir
                const savedView = localStorage.getItem('adsView');
                if (savedView) this.view = savedView;
            },
            updateView(newView) {
                this.view = newView;
                localStorage.setItem('adsView', newView);
            }
        }));
    });
</script>
