<div class="mt-12 animate-fade-in">
    <h2 class="text-xl font-bold text-primary mb-4">Gerir Denúncias</h2>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 gap-4">
        <!-- Campo de pesquisa -->
        <div class="relative flex-grow md:max-w-xl">
            <div class="flex items-center bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <div class="pl-4 pr-2 text-gray-400">
                    <i class="bi bi-search"></i>
                </div>
                <input
                    type="text"
                    id="denunciationSearchInput"
                    placeholder="Pesquisar por ID, título, motivo ou denunciante"
                    class="w-full p-3 focus:outline-none focus:shadow-outline border-0"
                >
                <button id="clearSearch" class="px-4 py-3 text-gray-400 hover:text-gray-600 hidden">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div id="searchResults" class="mt-2 text-sm text-gray-500 hidden">
                <span id="resultCount">0</span> resultados encontrados
            </div>
        </div>
    </div>

    <!-- Filtros de estado -->
    <div class="flex flex-wrap gap-2 mb-4">
        <button id="filter-all" data-filter="all" class="filter-button px-4 py-2 bg-blue-50 text-blue-600 border border-gray-200 rounded-lg text-sm font-medium">
            Todos
        </button>
        <button id="filter-pending" data-filter="pending" class="filter-button px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50">
            Por Resolver
        </button>
        <button id="filter-approved" data-filter="approved" class="filter-button px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50">
            Aprovados
        </button>
        <button id="filter-rejected" data-filter="rejected" class="filter-button px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50">
            Rejeitados
        </button>
    </div>

    <!-- Tabela de denúncias -->
    <div class="overflow-x-auto rounded-xl shadow bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-blue-100 text-left">
            <tr>
                <th class="p-4">ID</th>
                <th class="p-4">Anúncio</th>
                <th class="p-4">Motivo</th>
                <th class="p-4">Denunciante</th>
                <th class="p-4">Data</th>
                <th class="p-4">Estado</th>
                <th class="p-4">Ações</th>
            </tr>
            </thead>
            <tbody id="denunciationTableBody">
            @forelse ($denunciationData['presented'] as $presenter)
                <tr class="border-t hover:bg-gray-50 transition denunciation-row"
                    data-id="{{ $presenter->id() }}"
                    data-title="{{ strtolower($presenter->title()) }}"
                    data-reason="{{ strtolower($presenter->reason()) }}"
                    data-reporter="{{ strtolower($presenter->creator()) }}"
                    data-date="{{ strtotime($presenter->submittedAt()) }}"
                    data-state="{{ strtolower($presenter->state()) }}">

                    <td class="p-4">#{{ $presenter->id() }}</td>
                    <td class="p-4 font-medium">{{ $presenter->title() }}</td>
                    <td class="p-4 text-gray-600">{{ $presenter->reason() }}</td>
                    <td class="p-4 text-gray-600">{{ $presenter->creator() }}</td>
                    <td class="p-4 text-gray-500">{{ $presenter->submittedAt() }}</td>
                    <td class="p-4">{!! $presenter->stateBadge() !!}</td>
                    <td class="p-4">{!! $presenter->actionButton() !!}</td>
                </tr>
            @empty
                <tr class="border-t">
                    <td colspan="7" class="p-4 text-center text-gray-500">Nenhuma denúncia encontrada</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="p-4 pagination-container">
            {{ $denunciations->links() }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('denunciationSearchInput');
        const clearSearch = document.getElementById('clearSearch');
        const searchResults = document.getElementById('searchResults');
        const resultCount = document.getElementById('resultCount');
        const filterButtons = document.querySelectorAll('.filter-button');
        let currentPage = 1;
        let currentFilter = 'all';
        let currentSearch = '';

        function loadDenunciations() {
            const tableBody = document.getElementById('denunciationTableBody');
            tableBody.innerHTML = '<tr><td colspan="7" class="p-4 text-center">Carregando...</td></tr>';

            const url = new URL('/moderation/denunciations/ajax', window.location.origin);
            url.searchParams.append('page', currentPage);
            url.searchParams.append('filter', currentFilter);
            url.searchParams.append('search', currentSearch);

            fetch(url.toString())
                .then(response => response.json())
                .then(data => {
                    // Atualizar tabela com resultados
                    updateTable(data.denunciations);
                    // Atualizar paginação
                    updatePagination(data.pagination);
                    // Atualizar contador de resultados
                    if (currentSearch) {
                        searchResults.classList.remove('hidden');
                        resultCount.textContent = data.total;
                    } else {
                        searchResults.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar denúncias:', error);
                    tableBody.innerHTML = '<tr><td colspan="7" class="p-4 text-center text-red-500">Erro ao carregar dados. Tente novamente.</td></tr>';
                });
        }

        // Função para atualizar a tabela com os dados recebidos
        function updateTable(denunciations) {
            const tableBody = document.getElementById('denunciationTableBody');

            if (denunciations.length === 0) {
                tableBody.innerHTML = '<tr class="border-t"><td colspan="7" class="p-4 text-center text-gray-500">Nenhuma denúncia encontrada</td></tr>';
                return;
            }

            tableBody.innerHTML = '';
            denunciations.forEach(item => {
                const row = document.createElement('tr');
                row.className = 'border-t hover:bg-gray-50 transition denunciation-row';
                row.setAttribute('data-id', item.id);
                row.setAttribute('data-title', item.title.toLowerCase());
                row.setAttribute('data-reason', item.reason.toLowerCase());
                row.setAttribute('data-reporter', item.reporter.toLowerCase());
                row.setAttribute('data-date', item.date_timestamp);
                row.setAttribute('data-state', item.state.toLowerCase());

                row.innerHTML = `
                <td class="p-4">#${item.id}</td>
                <td class="p-4 font-medium">${item.title}</td>
                <td class="p-4 text-gray-600">${item.reason}</td>
                <td class="p-4 text-gray-600">${item.reporter}</td>
                <td class="p-4 text-gray-500">${item.date}</td>
                <td class="p-4">${item.state_badge}</td>
                <td class="p-4">${item.action_button}</td>
            `;

                tableBody.appendChild(row);
            });
        }

        // Função para atualizar a paginação
        function updatePagination(paginationHtml) {
            // Use o seletor específico para o contêiner de paginação
            const paginationContainer = document.querySelector('.pagination-container');
            paginationContainer.innerHTML = paginationHtml;

            // Adicionar eventos de clique nos links de paginação
            const paginationLinks = paginationContainer.querySelectorAll('a[href]');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const href = this.getAttribute('href');
                    const url = new URL(href, window.location.origin);
                    currentPage = url.searchParams.get('page') || 1;
                    loadDenunciations();
                });
            });
        }

        // Evento para os botões de filtro
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remover classe ativa de todos os botões
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-blue-50', 'text-blue-600');
                    btn.classList.add('bg-white', 'text-gray-600');
                });

                // Adicionar classe ativa ao botão clicado
                this.classList.remove('bg-white', 'text-gray-600');
                this.classList.add('bg-blue-50', 'text-blue-600');

                // Atualizar filtro atual e carregar denúncias
                currentFilter = this.getAttribute('data-filter');
                currentPage = 1;
                loadDenunciations();
            });
        });

        let searchTimeout;
        searchInput.addEventListener('input', function() {
            currentSearch = this.value.trim();

            if (currentSearch.length > 0) {
                clearSearch.classList.remove('hidden');
            } else {
                clearSearch.classList.add('hidden');
            }

            // Utilizar debounce para não fazer muitas requisições
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                currentPage = 1;
                loadDenunciations();
            }, 300); // 300ms de debounce
        });

        // Adicionar evento para a tecla Enter
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                clearTimeout(searchTimeout);
                currentPage = 1;
                currentSearch = this.value.trim();
                loadDenunciations();
            }
        });

        // Evento para limpar pesquisa
        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            currentSearch = '';
            this.classList.add('hidden');
            searchResults.classList.add('hidden');
            currentPage = 1;
            loadDenunciations();
        });

        // Carregar denúncias ao iniciar a página
        loadDenunciations();
    });
</script>
