<div class="mt-12 animate-fade-in">
    <h2 class="text-xl font-bold text-primary mb-4">Verificação de Anunciantes</h2>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 gap-4">
        <!-- Campo de pesquisa -->
        <div class="relative flex-grow md:max-w-xl">
            <div class="flex items-center bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <div class="pl-4 pr-2 text-gray-400">
                    <i class="bi bi-search"></i>
                </div>
                <input
                    type="text"
                    id="verificationSearchInput"
                    placeholder="Pesquisar por nome ou contacto"
                    class="w-full p-3 focus:outline-none focus:shadow-outline border-0"
                >
                <button id="clearVerificationSearch" class="px-4 py-3 text-gray-400 hover:text-gray-600 hidden">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div id="verificationSearchResults" class="mt-2 text-sm text-gray-500 hidden">
                <span id="verificationResultCount">0</span> resultados encontrados
            </div>
        </div>
    </div>

    <!-- Filtros de estado -->
    <div class="flex flex-wrap gap-2 mb-4">
        <button class="px-4 py-2 bg-blue-50 text-blue-600 border border-blue-200 rounded-lg text-sm font-medium">
            Todos
        </button>
        <button class="px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50">
            Por Aprovar
        </button>
        <button class="px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50">
            Aprovados
        </button>
        <button class="px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50">
            Rejeitados
        </button>
    </div>

    <!-- Tabela de verificações -->
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
                        Nome do Anunciante<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="contact">
                    <div class="flex items-center">
                        Contacto<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="date">
                    <div class="flex items-center">
                        Data de Pedido<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4">Documentos</th>
                <th class="p-4">Status</th>
                <th class="p-4">Ações</th>
            </tr>
            </thead>
            <tbody id="verificationTableBody">
            <tr class="border-t hover:bg-gray-50 transition verification-row"
                data-id="5644"
                data-name="joão silva"
                data-contact="+351 912 345 678"
                data-date="1710682500"
                data-state="pending">
                <td class="p-4">#5644</td>
                <td class="p-4 font-medium">João Silva</td>
                <td class="p-4 text-gray-600">+351 912 345 678</td>
                <td class="p-4 text-gray-500">15/03/2025 - 14:55</td>
                <td class="p-4">Sim</td>
                <td class="p-4"><span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-medium">Por Aprovar</span></td>
                <td class="p-4"><a href="{{ route('verification-advertiser.show', 5644) }}" class="btn-secondary px-3 py-1 text-xs">Ver Detalhes</a></td>
            </tr>
            <tr class="border-t hover:bg-gray-50 transition verification-row"
                data-id="6112"
                data-name="maria santos"
                data-contact="+351 963 123 456"
                data-date="1710760380"
                data-state="pending">
                <td class="p-4">#6112</td>
                <td class="p-4 font-medium">Maria Santos</td>
                <td class="p-4 text-gray-600">+351 963 123 456</td>
                <td class="p-4 text-gray-500">16/03/2025 - 12:33</td>
                <td class="p-4">Sim</td>
                <td class="p-4"><span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-medium">Por Aprovar</span></td>
                <td class="p-4"><a href="#" class="btn-secondary px-3 py-1 text-xs">Ver Detalhes</a></td>
            </tr>
            <tr class="border-t hover:bg-gray-50 transition verification-row"
                data-id="6141"
                data-name="ricardo lopes"
                data-contact="+351 917 654 321"
                data-date="1710786180"
                data-state="approved">
                <td class="p-4">#6141</td>
                <td class="p-4 font-medium">Ricardo Lopes</td>
                <td class="p-4 text-gray-600">+351 917 654 321</td>
                <td class="p-4 text-gray-500">17/03/2025 - 09:43</td>
                <td class="p-4">Sim</td>
                <td class="p-4"><span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-medium">Aprovado</span></td>
                <td class="p-4"><a href="#" class="btn-secondary px-3 py-1 text-xs">Ver Detalhes</a></td>
            </tr>
            <tr class="border-t hover:bg-gray-50 transition verification-row"
                data-id="6535"
                data-name="sofia almeida"
                data-contact="+351 918 222 333"
                data-date="1710859560"
                data-state="rejected">
                <td class="p-4">#6535</td>
                <td class="p-4 font-medium">Sofia Almeida</td>
                <td class="p-4 text-gray-600">+351 918 222 333</td>
                <td class="p-4 text-gray-500">18/03/2025 - 15:46</td>
                <td class="p-4">Sim</td>
                <td class="p-4"><span class="px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs font-medium">Rejeitado</span></td>
                <td class="p-4"><a href="#" class="btn-secondary px-3 py-1 text-xs">Ver Detalhes</a></td>
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
        const searchInput = document.getElementById('verificationSearchInput');
        const clearSearch = document.getElementById('clearVerificationSearch');
        const searchResults = document.getElementById('verificationSearchResults');
        const resultCount = document.getElementById('verificationResultCount');
        const verificationRows = document.querySelectorAll('.verification-row');

        // Search implementation
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            let matches = 0;

            if (searchTerm.length > 0) {
                clearSearch.classList.remove('hidden');

                verificationRows.forEach(row => {
                    const name = row.getAttribute('data-name').toLowerCase();
                    const contact = row.getAttribute('data-contact').toLowerCase();

                    if (name.includes(searchTerm) || contact.includes(searchTerm)) {
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

                verificationRows.forEach(row => {
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
