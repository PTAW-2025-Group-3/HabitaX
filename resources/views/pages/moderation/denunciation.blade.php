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
                    placeholder="Pesquisar por título ou motivo"
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
        <button class="px-4 py-2 bg-blue-50 text-blue-600 border border-blue-200 rounded-lg text-sm font-medium">
            Todos
        </button>
        <button class="px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50">
            Por Resolver
        </button>
        <button class="px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50">
            Aprovados
        </button>
        <button class="px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50">
            Rejeitados
        </button>
    </div>

    <!-- Tabela de denúncias -->
    <div class="overflow-x-auto rounded-xl shadow bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-blue-100 text-left">
            <tr>
                <th class="p-4 cursor-pointer sortable-column" data-sort="id">
                    <div class="flex items-center">
                        ID<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="title">
                    <div class="flex items-center">
                        Anúncio<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="reason">
                    <div class="flex items-center">
                        Motivo<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="reporter">
                    <div class="flex items-center">
                        Denunciante<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="date">
                    <div class="flex items-center">
                        Data<span class="sort-icon ml-1"></span>
                    </div>
                </th>
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
                    data-state="">
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
        <div class="p-4">
            {{ $denunciations->links() }}
        </div>
    </div>
</div>

<script>
    // Code for search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('denunciationSearchInput');
        const clearSearch = document.getElementById('clearSearch');
        const searchResults = document.getElementById('searchResults');
        const resultCount = document.getElementById('resultCount');
        const denunciationRows = document.querySelectorAll('.denunciation-row');

        // Search implementation
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            let matches = 0;

            if (searchTerm.length > 0) {
                clearSearch.classList.remove('hidden');

                denunciationRows.forEach(row => {
                    const title = row.getAttribute('data-title').toLowerCase();
                    const reason = row.getAttribute('data-reason').toLowerCase();

                    if (title.includes(searchTerm) || reason.includes(searchTerm)) {
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

                denunciationRows.forEach(row => {
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
