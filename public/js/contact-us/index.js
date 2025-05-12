document.addEventListener('DOMContentLoaded', function () {
    // Variáveis globais
    const searchInput = document.getElementById('contactSearchInput');
    const clearSearch = document.getElementById('clearContactSearch');
    const searchResults = document.getElementById('contactSearchResults');
    const resultCount = document.getElementById('contactResultCount');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const tableBody = document.getElementById('contactsTableBody');
    const paginationContainer = document.getElementById('pagination-container');

    let currentFilter = 'all';
    let searchTerm = '';
    let searchTimeout;

    // Carregar dados via Ajax
    function loadContacts() {
        // Mostrar indicador de carregamento
        tableBody.innerHTML = '<tr><td colspan="7" class="p-4 text-center text-gray-500"><i class="bi bi-hourglass-split mr-2 animate-spin"></i>A carregar dados...</td></tr>';

        // Montar a URL com os parâmetros
        const url = `/moderation/contact-us/data?filter=${currentFilter}&search=${encodeURIComponent(searchTerm)}`;

        // Fazer requisição Ajax
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
            .then(response => response.json())
            .then(data => {
                // Atualizar a tabela
                if (data.contacts.data.length === 0) {
                    tableBody.innerHTML = '<tr class="border-t"><td colspan="7" class="p-4 text-center text-gray-500">Nenhum resultado encontrado</td></tr>';
                } else {
                    tableBody.innerHTML = '';

                    data.contacts.data.forEach(contact => {
                        const row = document.createElement('tr');
                        row.className = 'border-t hover:bg-gray-50 transition contact-row';
                        row.setAttribute('data-id', contact.id);
                        row.setAttribute('data-name', (contact.first_name + ' ' + contact.last_name).toLowerCase());
                        row.setAttribute('data-email', contact.email.toLowerCase());
                        row.setAttribute('data-processed', contact.is_processed ? 'processed' : 'not-processed');

                        const status = contact.is_processed
                            ? '<span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Processado</span>'
                            : '<span class="px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">Não Processado</span>';

                        row.innerHTML = `
                        <td class="p-4">#${contact.id}</td>
                        <td class="p-4 font-medium">${contact.first_name} ${contact.last_name}</td>
                        <td class="p-4 text-gray-600">${contact.email}</td>
                        <td class="p-4 text-gray-600">${contact.message.substring(0, 40)}${contact.message.length > 40 ? '...' : ''}</td>
                        <td class="p-4">${status}</td>
                        <td class="p-4 text-gray-500">${formatDate(contact.created_at)}</td>
                        <td class="p-4">
                            <div class="flex gap-1">
                                <a href="/moderation/contact-us/${contact.id}" class="btn-secondary px-3 py-1 text-xs">
                                    Ver Detalhes
                                </a>
                            </div>
                        </td>
                    `;

                        tableBody.appendChild(row);
                    });
                }

                // Atualizar a paginação usando os links do Laravel
                paginationContainer.innerHTML = '';
                const paginationDiv = document.createElement('div');
                paginationDiv.innerHTML = data.links;
                paginationContainer.appendChild(paginationDiv);

                // Interceptar os cliques nos links da paginação
                setupPaginationLinks();

                // Atualizar contador de resultados se estiver pesquisando
                if (searchTerm) {
                    searchResults.classList.remove('hidden');
                    resultCount.textContent = data.total;
                } else {
                    searchResults.classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Erro ao carregar dados:', error);
                tableBody.innerHTML = '<tr><td colspan="7" class="p-4 text-center text-red-500">Erro ao carregar dados. Por favor, tente novamente.</td></tr>';
            });
    }

    // Configurar os links de paginação para uso com AJAX
    function setupPaginationLinks() {
        const links = document.querySelectorAll('#pagination-container a');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Extrair a URL da página
                const pageUrl = this.getAttribute('href');

                // Criar um objeto URL para manipular os parâmetros corretamente
                const ajaxUrl = new URL(window.location.origin + '/moderation/contact-us/data');

                // Obter parâmetros de página da URL original
                const originalParams = new URL(pageUrl, window.location.origin).searchParams;
                const pageParam = originalParams.get('page');

                // Adicionar parâmetros necessários
                if (pageParam) ajaxUrl.searchParams.append('page', pageParam);
                ajaxUrl.searchParams.append('filter', currentFilter);
                if (searchTerm) ajaxUrl.searchParams.append('search', searchTerm);

                // Fazer a requisição Ajax para a nova página
                fetch(ajaxUrl.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        // Atualizar URL no navegador sem recarregar a página
                        history.pushState({}, '', pageUrl);

                        // Atualizar a tabela
                        if (data.contacts.data.length === 0) {
                            tableBody.innerHTML = '<tr class="border-t"><td colspan="7" class="p-4 text-center text-gray-500">Nenhum resultado encontrado</td></tr>';
                        } else {
                            tableBody.innerHTML = '';

                            data.contacts.data.forEach(contact => {
                                const row = document.createElement('tr');
                                row.className = 'border-t hover:bg-gray-50 transition contact-row';
                                row.setAttribute('data-id', contact.id);
                                row.setAttribute('data-name', (contact.first_name + ' ' + contact.last_name).toLowerCase());
                                row.setAttribute('data-email', contact.email.toLowerCase());
                                row.setAttribute('data-processed', contact.is_processed ? 'processed' : 'not-processed');

                                const status = contact.is_processed
                                    ? '<span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Processado</span>'
                                    : '<span class="px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">Não Processado</span>';

                                row.innerHTML = `
                                <td class="p-4">#${contact.id}</td>
                                <td class="p-4 font-medium">${contact.first_name} ${contact.last_name}</td>
                                <td class="p-4 text-gray-600">${contact.email}</td>
                                <td class="p-4 text-gray-600">${contact.message.substring(0, 40)}${contact.message.length > 40 ? '...' : ''}</td>
                                <td class="p-4">${status}</td>
                                <td class="p-4 text-gray-500">${formatDate(contact.created_at)}</td>
                                <td class="p-4">
                                    <div class="flex gap-1">
                                        <a href="/moderation/contact-us/${contact.id}" class="btn-secondary px-3 py-1 text-xs">
                                            Ver Detalhes
                                        </a>
                                    </div>
                                </td>
                            `;

                                tableBody.appendChild(row);
                            });
                        }

                        // Atualizar a paginação
                        paginationContainer.innerHTML = '';
                        const paginationDiv = document.createElement('div');
                        paginationDiv.innerHTML = data.links;
                        paginationContainer.appendChild(paginationDiv);

                        // Configurar os novos links de paginação
                        setupPaginationLinks();
                    })
                    .catch(error => {
                        console.error('Erro ao carregar dados:', error);
                        tableBody.innerHTML = '<tr><td colspan="7" class="p-4 text-center text-red-500">Erro ao carregar dados. Por favor, tente novamente.</td></tr>';
                    });
            });
        });
    }

    // Formatar data
    function formatDate(dateString) {
        const date = new Date(dateString);
        return `${String(date.getDate()).padStart(2, '0')}/${String(date.getMonth() + 1).padStart(2, '0')}/${date.getFullYear()} - ${String(date.getHours()).padStart(2, '0')}:${String(date.getMinutes()).padStart(2, '0')}`;
    }

    // Funcionalidade do campo de busca
    searchInput.addEventListener('input', function () {
        searchTerm = this.value.trim().toLowerCase();

        // Mostrar ou ocultar botão de limpar
        if (searchTerm.length > 0) {
            clearSearch.classList.remove('hidden');
        } else {
            clearSearch.classList.add('hidden');
        }

        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            loadContacts();
        }, 300);
    });

    clearSearch.addEventListener('click', function () {
        searchInput.value = '';
        searchTerm = '';
        this.classList.add('hidden');
        searchResults.classList.add('hidden');
        loadContacts();
    });

    // Funcionalidade dos botões de filtro
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
            loadContacts();
        });
    });

    // Inicializar configuração dos links de paginação
    setupPaginationLinks();

    // Carregar dados iniciais apenas se ainda não foram carregados
    loadContacts();
});
