function initPagination() {
    const tableBody = document.getElementById('userTableBody');
    const paginationContainer = document.getElementById('pagination-container');
    const searchInput = document.getElementById('userSearchInput');

    // Usar variáveis globais exportadas do sorting.js
    const currentSort = () => window.currentSort || 'created_at';
    const currentOrder = () => window.currentOrder || 'desc';

    function setupPaginationLinks() {
        const paginationLinks = document.querySelectorAll('#pagination-container a');

        if (paginationLinks.length === 0) return;

        paginationLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const url = this.getAttribute('href');

                const pageMatch = url.match(/page=(\d+)/);
                if (!pageMatch) {
                    console.error('Invalid pagination URL:', url);
                    return;
                }

                const page = pageMatch[1];
                const searchTerm = searchInput?.value?.trim() || '';
                const sort = currentSort();
                const order = currentOrder();

                const ajaxUrl = `/admin/users?page=${page}` +
                    `&sort=${encodeURIComponent(sort)}` +
                    `&order=${encodeURIComponent(order)}` +
                    (searchTerm ? `&search=${encodeURIComponent(searchTerm)}` : '');

                tableBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="p-4 text-center">
                            <div class="flex justify-center">
                                <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-indigo-500"></div>
                            </div>
                            <p class="mt-2 text-gray-600">Carregando utilizadores...</p>
                        </td>
                    </tr>
                `;

                fetch(ajaxUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        tableBody.innerHTML = data.users;
                        paginationContainer.innerHTML = data.pagination;
                        updateUserStatusIndicators();
                        initializeAfterUpdate();

                        history.pushState({}, '', ajaxUrl);
                    })
                    .catch(error => {
                        tableBody.innerHTML = `
                            <tr>
                                <td colspan="7" class="p-4 text-center text-red-500">
                                    <i class="bi bi-exclamation-triangle mr-2"></i>
                                    Erro ao carregar utilizadores. Por favor, tente novamente.
                                </td>
                            </tr>
                        `;
                        console.error('Erro ao buscar utilizadores:', error);
                    });
            });
        });
    }

    function updateUserStatusIndicators() {
        const userRows = document.querySelectorAll('.user-row');

        userRows.forEach(row => {
            const state = row.dataset.state;
            const statusCell = row.querySelector('td:nth-child(6)');

            if (!state || !statusCell) return;

            const badgeMap = {
                active: 'Ativo|bg-green-100 text-green-700',
                suspended: 'Suspenso|bg-yellow-100 text-yellow-600',
                banned: 'Banido|bg-red-100 text-red-600',
                archived: 'Arquivado|bg-gray-100 text-gray-600'
            };

            const fallback = 'Desconhecido|bg-gray-200 text-gray-700';
            const [label, style] = (badgeMap[state] || fallback).split('|');

            statusCell.innerHTML = `<span class="inline-block px-2 py-1 text-xs rounded-full font-semibold ${style}">${label}</span>`;
        });
    }

    function initializeAfterUpdate() {
        setupPaginationLinks();

        if (typeof window.setupSuspensionButtons === 'function') window.setupSuspensionButtons();
        if (typeof window.setupPermissionsButtons === 'function') window.setupPermissionsButtons();
    }

    window.setupPaginationLinks = setupPaginationLinks;
    window.initializeAfterUpdate = initializeAfterUpdate;
    window.updateUserStatusIndicators = updateUserStatusIndicators;

    setupPaginationLinks();
    updateUserStatusIndicators();
}

document.addEventListener('DOMContentLoaded', initPagination);
