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
                    placeholder="Pesquisar por nome ou email"
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

    <!-- Filtros de estados -->
    <div class="flex flex-wrap gap-2 mb-4">
        <button
            class="filter-btn px-4 py-2 bg-blue-50 text-blue-600 border border-blue-200 rounded-lg text-sm font-medium"
            data-filter="all">
            Todos
        </button>
        <button
            class="filter-btn px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50"
            data-filter="suspended">
            Suspensos
        </button>
        <button
            class="filter-btn px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50"
            data-filter="banned">
            Banidos
        </button>
        <button
            class="filter-btn px-4 py-2 bg-white text-gray-600 border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50"
            data-filter="archived">
            Arquivados
        </button>
    </div>

    <!-- Tabela de utilizadores com estados restritivos -->
    <div class="overflow-x-auto rounded-xl shadow bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-blue-100 text-left">
            <tr>
                <th class="p-4 cursor-pointer sortable-column" data-sort="id">
                    <div class="flex items-center">
                        ID<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4">
                    <div class="flex items-center">
                        Imagem de Perfil
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="name">
                    <div class="flex items-center">
                        Nome do Utilizador<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="email">
                    <div class="flex items-center">
                        Email<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="created_at">
                    <div class="flex items-center">
                        Data de Registo<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4 cursor-pointer sortable-column" data-sort="state">
                    <div class="flex items-center">
                        Estado<span class="sort-icon ml-1"></span>
                    </div>
                </th>
                <th class="p-4">Ações</th>
            </tr>
            </thead>
            <tbody id="suspendedTableBody">
            @forelse($users as $user)
                <tr class="border-t hover:bg-gray-50 transition suspended-row"
                    data-id="{{ $user->id }}"
                    data-name="{{ strtolower($user->name) }}"
                    data-email="{{ strtolower($user->email) }}"
                    data-state="{{ $user->state }}">
                    <td class="p-4">#{{ $user->id }}</td>
                    <td class="p-4">
                        <img src="{{ $user->getProfilePictureUrl() }}"
                             alt="{{ $user->name }}"
                             class="h-10 w-10 rounded-full object-cover">
                    </td>
                    <td class="p-4 font-medium">{{ $user->name }}</td>
                    <td class="p-4 text-gray-600">{{ $user->email }}</td>
                    <td class="p-4 text-gray-500">{{ $user->created_at->format('d/m/Y - H:i') }}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            @if($user->state === 'suspended') bg-yellow-100 text-yellow-700
                            @elseif($user->state === 'banned') bg-red-100 text-red-700
                            @elseif($user->state === 'archived') bg-gray-100 text-gray-700
                            @else bg-green-100 text-green-700 @endif">
                            @php
                                $states = [
                                    'active' => 'Ativo',
                                    'suspended' => 'Suspenso',
                                    'banned' => 'Banido',
                                    'archived' => 'Arquivado'
                                ];
                            @endphp
                            {{ $states[$user->state] ?? ucfirst($user->state) }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex gap-1">
                            <button
                                class="btn-secondary px-3 py-1 text-xs"
                                onclick="openSuspendUserModal(this)"
                                data-user-id="{{ $user->id }}"
                                data-user-name="{{ $user->name }}"
                                data-user-state="{{ $user->state }}">
                                Gerir Estado
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr class="border-t">
                    <td colspan="7" class="p-4 text-center text-gray-500">Não há utilizadores restritos para mostrar
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="p-4 pagination-container" id="pagination-container">
            {{ $users->links() }}
        </div>
    </div>
</div>

@include('pages.moderation.partials.modals.suspended-user-mod')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Variáveis globais
        const searchInput = document.getElementById('suspendedSearchInput');
        const clearSearch = document.getElementById('clearSuspendedSearch');
        const searchResults = document.getElementById('suspendedSearchResults');
        const resultCount = document.getElementById('suspendedResultCount');
        const filterButtons = document.querySelectorAll('.filter-btn');

        let currentPage = 1;
        let currentFilter = 'all';
        let searchTimeout;

        // Busca com AJAX
        function searchUsers(searchTerm = '') {
            // Mostrar indicador de carregamento
            document.getElementById('suspendedTableBody').innerHTML =
                '<tr><td colspan="7" class="p-4 text-center">Carregando...</td></tr>';

            // Construir URL com parâmetros
            const url = new URL('/moderation/suspended-users/ajax', window.location.origin);
            url.searchParams.append('page', currentPage);
            url.searchParams.append('filter', currentFilter);
            url.searchParams.append('search', searchTerm);

            // Fazer requisição AJAX
            fetch(url.toString())
                .then(response => response.json())
                .then(data => {
                    updateUsersTable(data.users);
                    updatePagination(data.pagination);

                    // Atualizar contador de resultados
                    if (searchTerm) {
                        searchResults.classList.remove('hidden');
                        resultCount.textContent = data.total;
                    } else {
                        searchResults.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar dados:', error);
                    document.getElementById('suspendedTableBody').innerHTML =
                        '<tr><td colspan="7" class="p-4 text-center text-red-500">Erro ao carregar dados</td></tr>';
                });
        }

        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.trim();

            // Mostrar ou ocultar botão de limpar
            if (searchTerm.length > 0) {
                clearSearch.classList.remove('hidden');
            } else {
                clearSearch.classList.add('hidden');
            }

            // Usar debounce para evitar muitas requisições
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                currentPage = 1; // Voltar para primeira página ao pesquisar
                searchUsers(searchTerm);
            }, 500);
        });

        clearSearch.addEventListener('click', function () {
            searchInput.value = '';
            this.classList.add('hidden');
            searchResults.classList.add('hidden');
            currentPage = 1;
            searchUsers('');
        });

        searchInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                clearTimeout(searchTimeout);
                currentPage = 1;
                searchUsers(this.value.trim());
            }
        });

        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Atualizar visual dos botões
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-blue-50', 'text-blue-600', 'border-blue-200');
                    btn.classList.add('bg-white', 'text-gray-600', 'border-gray-200');
                });
                this.classList.remove('bg-white', 'text-gray-600', 'border-gray-200');
                this.classList.add('bg-blue-50', 'text-blue-600', 'border-blue-200');

                // Aplicar filtro
                currentFilter = this.getAttribute('data-filter');
                currentPage = 1;
                searchUsers(searchInput.value.trim());
            });
        });

        function updateUsersTable(users) {
            const tableBody = document.getElementById('suspendedTableBody');
            tableBody.innerHTML = '';

            if (users.length === 0) {
                tableBody.innerHTML = '<tr class="border-t"><td colspan="7" class="p-4 text-center text-gray-500">Não há utilizadores para mostrar</td></tr>';
                return;
            }

            users.forEach(user => {
                // Definir classes para o badge de estado
                let stateBadgeClass = '';
                if (user.state === 'suspended') {
                    stateBadgeClass = 'bg-yellow-100 text-yellow-700';
                } else if (user.state === 'banned') {
                    stateBadgeClass = 'bg-red-100 text-red-700';
                } else if (user.state === 'archived') {
                    stateBadgeClass = 'bg-gray-100 text-gray-700';
                } else {
                    stateBadgeClass = 'bg-green-100 text-green-700';
                }

                // Traduzir estado
                const states = {
                    'active': 'Ativo',
                    'suspended': 'Suspenso',
                    'banned': 'Banido',
                    'archived': 'Arquivado'
                };
                const stateName = states[user.state] || user.state;

                // Formatar data de criação
                const createdAt = new Date(user.created_at);
                const formattedDate = `${createdAt.getDate().toString().padStart(2, '0')}/${(createdAt.getMonth() + 1).toString().padStart(2, '0')}/${createdAt.getFullYear()} - ${createdAt.getHours().toString().padStart(2, '0')}:${createdAt.getMinutes().toString().padStart(2, '0')}`;

                // Criar a linha da tabela
                const row = document.createElement('tr');
                row.className = 'border-t hover:bg-gray-50 transition suspended-row';
                row.setAttribute('data-id', user.id);
                row.setAttribute('data-name', user.name.toLowerCase());
                row.setAttribute('data-email', user.email.toLowerCase());
                row.setAttribute('data-state', user.state);

                row.innerHTML = `
                <td class="p-4">#${user.id}</td>
                <td class="p-4">
                    <img src="${user.profile_picture_url || '/images/default-profile.png'}"
                        alt="${user.name}"
                        class="h-10 w-10 rounded-full object-cover">
                </td>
                <td class="p-4 font-medium">${user.name}</td>
                <td class="p-4 text-gray-600">${user.email}</td>
                <td class="p-4 text-gray-500">${formattedDate}</td>
                <td class="p-4">
                    <span class="px-2 py-1 rounded-full text-xs font-medium ${stateBadgeClass}">
                        ${stateName}
                    </span>
                </td>
                <td class="p-4">
                    <div class="flex gap-1">
                        <button
                            class="btn-secondary px-3 py-1 text-xs"
                            onclick="openSuspendUserModal(this)"
                            data-user-id="${user.id}"
                            data-user-name="${user.name}"
                            data-user-state="${user.state}">
                            Gerir Estado
                        </button>
                    </div>
                </td>
            `;

                tableBody.appendChild(row);
            });
        }

        function updatePagination(paginationHtml) {
            const paginationContainer = document.getElementById('pagination-container');
            paginationContainer.innerHTML = paginationHtml;

            const paginationLinks = paginationContainer.querySelectorAll('a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const href = this.getAttribute('href');
                    const url = new URL(href, window.location.origin);
                    currentPage = url.searchParams.get('page') || 1;

                    document.getElementById('suspendedTableBody').innerHTML =
                        '<tr><td colspan="7" class="p-4 text-center">Carregando...</td></tr>';

                    const searchUrl = new URL('/moderation/suspended-users/ajax', window.location.origin);
                    searchUrl.searchParams.append('page', currentPage);
                    searchUrl.searchParams.append('filter', currentFilter);
                    searchUrl.searchParams.append('search', searchInput.value.trim());

                    fetch(searchUrl.toString())
                        .then(response => response.json())
                        .then(data => {
                            updateUsersTable(data.users);
                            updatePagination(data.pagination);
                        })
                        .catch(error => {
                            console.error('Erro ao buscar dados:', error);
                            document.getElementById('suspendedTableBody').innerHTML =
                                '<tr><td colspan="7" class="p-4 text-center text-red-500">Erro ao carregar dados</td></tr>';
                        });
                });
            });
        }

        searchUsers();
    });

    function openSuspendUserModal(element) {
        const userId = element.getAttribute('data-user-id');
        const userName = element.getAttribute('data-user-name');
        const userState = element.getAttribute('data-user-state');

        document.getElementById('suspendUserName').textContent = userName;
        document.getElementById('stateSelect').value = userState;

        document.getElementById('confirmSuspendBtn').setAttribute('data-user-id', userId);

        const modal = document.getElementById('suspendUserModal');
        if (modal) {
            modal.classList.remove('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('suspendUserModal');
        const overlay = document.getElementById('suspendUserModalOverlay');
        const closeBtn = document.getElementById('closeSuspendModal');
        const cancelBtn = document.getElementById('cancelSuspendBtn');
        const confirmBtn = document.getElementById('confirmSuspendBtn');

        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                modal.classList.add('hidden');
            });
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', function () {
                modal.classList.add('hidden');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', function () {
                modal.classList.add('hidden');
            });
        }

        if (confirmBtn) {
            confirmBtn.addEventListener('click', function () {
                const userId = this.getAttribute('data-user-id');
                const state = document.getElementById('stateSelect').value;

                if (!userId) return;

                this.disabled = true;
                this.innerHTML = '<i class="bi bi-hourglass-split animate-spin mr-2"></i> Atualizando...';

                fetch(`/moderation/users/${userId}/update-state`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({state})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert('Erro ao atualizar estado do usuário.');
                            this.disabled = false;
                            this.innerHTML = 'Atualizar Estado';
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        alert('Erro ao processar a solicitação.');
                        this.disabled = false;
                        this.innerHTML = 'Atualizar Estado';
                    });
            });
        }
    });
</script>
