<div class="mt-12 animate-fade-in">
    <h2 class="text-xl font-bold text-primary mb-4">Utilizadores Suspensos</h2>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 gap-4">
        <!-- Campo de pesquisa -->
        <div class="relative flex-grow md:max-w-xl">
            <div class="flex items-center bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <div class="pl-4 pr-2 text-gray-400">
                    <i class="bi bi-search"></i>
                </div>
                <input
                    type="text"
                    id="suspendedSearchInput"
                    placeholder="Pesquisar por nome ou motivo"
                    class="w-full p-3 focus:outline-none focus:shadow-outline border-0"
                >
                <button id="clearSuspendedSearch" class="px-4 py-3 text-gray-400 hover:text-gray-600 hidden">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div id="suspendedSearchResults" class="mt-2 text-sm text-gray-500 hidden">
                <span id="suspendedResultCount">0</span> resultados encontrados
            </div>
        </div>
    </div>

    <!-- Filtros de duração -->
    <div class="flex flex-wrap gap-2 mb-4">
        <button class="px-4 py-2 bg-blue-50 text-blue-600 border border-blue-200 rounded-lg text-sm font-medium">
            Todos
        </button>
        <button class="px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50">
            Menos de 1 mês
        </button>
        <button class="px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50">
            1-6 meses
        </button>
        <button class="px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50">
            Mais de 6 meses
        </button>
    </div>

    <!-- Tabela de utilizadores suspensos -->
    <div class="overflow-x-auto rounded-xl shadow bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-blue-100 text-left">
            <tr>
                <th class="p-4 cursor-pointer sortable-column" data-sort="id">
                    <div class="flex items-center">
                        ID<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="name">
                    <div class="flex items-center">
                        Nome do Utilizador<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="reason">
                    <div class="flex items-center">
                        Motivo da Suspensão<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="date">
                    <div class="flex items-center">
                        Data da Suspensão<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="duration">
                    <div class="flex items-center">
                        Duração<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4">Ações</th>
            </tr>
            </thead>
            <tbody id="suspendedTableBody">
            <tr class="border-t hover:bg-gray-50 transition suspended-row"
                data-id="5644"
                data-name="cristiano ronaldo"
                data-reason="má conduta"
                data-date="1710598500"
                data-duration="1 mês">
                <td class="p-4">#5644</td>
                <td class="p-4 font-medium">Cristiano Ronaldo</td>
                <td class="p-4 text-gray-600">Má Conduta</td>
                <td class="p-4 text-gray-500">12/03/2025 - 14:55</td>
                <td class="p-4">1 mês</td>
                <td class="p-4">
                    <div class="flex gap-2">
                        <button class="btn-success px-3 py-1 text-xs" onclick="openModal('reativarModal')">Reativar</button>
                        <button class="btn-warning px-3 py-1 text-xs" onclick="openModal('prolongarModal')">Prolongar</button>
                    </div>
                </td>
            </tr>
            <tr class="border-t hover:bg-gray-50 transition suspended-row"
                data-id="6112"
                data-name="maria da silva"
                data-reason="spam"
                data-date="1710512100"
                data-duration="2 meses">
                <td class="p-4">#6112</td>
                <td class="p-4 font-medium">Maria da Silva</td>
                <td class="p-4 text-gray-600">Spam</td>
                <td class="p-4 text-gray-500">11/03/2025 - 12:33</td>
                <td class="p-4">2 meses</td>
                <td class="p-4">
                    <div class="flex gap-2">
                        <button class="btn-success px-3 py-1 text-xs" onclick="openModal('reativarModal')">Reativar</button>
                        <button class="btn-warning px-3 py-1 text-xs" onclick="openModal('prolongarModal')">Prolongar</button>
                    </div>
                </td>
            </tr>
            <tr class="border-t hover:bg-gray-50 transition suspended-row"
                data-id="6141"
                data-name="aurélio da silva"
                data-reason="fraude"
                data-date="1710338100"
                data-duration="1 ano">
                <td class="p-4">#6141</td>
                <td class="p-4 font-medium">Aurélio da Silva</td>
                <td class="p-4 text-gray-600">Fraude</td>
                <td class="p-4 text-gray-500">09/03/2025 - 19:43</td>
                <td class="p-4">1 ano</td>
                <td class="p-4">
                    <div class="flex gap-2">
                        <button class="btn-success px-3 py-1 text-xs" onclick="openModal('reativarModal')">Reativar</button>
                        <button class="btn-warning px-3 py-1 text-xs" onclick="openModal('prolongarModal')">Prolongar</button>
                    </div>
                </td>
            </tr>
            <tr class="border-t hover:bg-gray-50 transition suspended-row"
                data-id="6535"
                data-name="luís assis"
                data-reason="fraude"
                data-date="1710165300"
                data-duration="2 anos">
                <td class="p-4">#6535</td>
                <td class="p-4 font-medium">Luís Assis</td>
                <td class="p-4 text-gray-600">Fraude</td>
                <td class="p-4 text-gray-500">07/03/2025 - 15:46</td>
                <td class="p-4">2 anos</td>
                <td class="p-4">
                    <div class="flex gap-2">
                        <button class="btn-success px-3 py-1 text-xs" onclick="openModal('reativarModal')">Reativar</button>
                        <button class="btn-warning px-3 py-1 text-xs" onclick="openModal('prolongarModal')">Prolongar</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="p-4 border-t border-gray-100 flex justify-between items-center">
            <p class="text-sm text-gray-500">Exibindo <span class="font-medium">4</span> de <span class="font-medium">28</span> resultados</p>
            <div class="flex items-center space-x-2">
                <button class="px-3 py-1 border border-gray-200 rounded bg-white text-gray-secondary hover:bg-gray-50">Anterior</button>
                <button class="px-3 py-1 border border-secondary rounded bg-blue-50 text-secondary">1</button>
                <button class="px-3 py-1 border border-gray-200 rounded bg-white text-gray-secondary hover:bg-gray-50">2</button>
                <button class="px-3 py-1 border border-gray-200 rounded bg-white text-gray-secondary hover:bg-gray-50">3</button>
                <button class="px-3 py-1 border border-gray-200 rounded bg-white text-gray-secondary hover:bg-gray-50">Próxima</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Code for search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('suspendedSearchInput');
        const clearSearch = document.getElementById('clearSuspendedSearch');
        const searchResults = document.getElementById('suspendedSearchResults');
        const resultCount = document.getElementById('suspendedResultCount');
        const suspendedRows = document.querySelectorAll('.suspended-row');

        // Search implementation
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            let matches = 0;

            if (searchTerm.length > 0) {
                clearSearch.classList.remove('hidden');

                suspendedRows.forEach(row => {
                    const name = row.getAttribute('data-name').toLowerCase();
                    const reason = row.getAttribute('data-reason').toLowerCase();

                    if (name.includes(searchTerm) || reason.includes(searchTerm)) {
                        row.classList.remove('hidden');
                        matches++;
                    } else {
                        row.classList.add('hidden');
                    }
                });

                searchResults.classList.remove('hidden');
                resultCount.textContent = matches;
            } else {
                clearSearch.classList.add('hidden');
                searchResults.classList.add('hidden');

                suspendedRows.forEach(row => {
                    row.classList.remove('hidden');
                });
            }
        });

        // Clear search
        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
            this.classList.add('hidden');
        });
    });
</script>
