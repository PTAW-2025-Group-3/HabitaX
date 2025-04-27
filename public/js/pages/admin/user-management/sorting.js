function initSorting() {
    const tableBody = document.getElementById('userTableBody');
    const paginationContainer = document.getElementById('pagination-container');
    const sortableColumns = document.querySelectorAll('.sortable-column');
    const searchInput = document.getElementById('userSearchInput');

    // Get sort parameters from URL
    function getUrlParameter(name) {
        const url = new URL(window.location.href);
        return url.searchParams.get(name);
    }

    // Initialize global sort variables
    window.currentSort = getUrlParameter('sort') || 'created_at';
    window.currentOrder = getUrlParameter('order') || 'desc';
    let currentSort = window.currentSort;
    let currentOrder = window.currentOrder;

    // Update sort icons in column headers
    function updateSortIcons() {
        sortableColumns.forEach(column => {
            const sortIcon = column.querySelector('.sort-icon');
            const columnSort = column.dataset.sort;

            if (sortIcon) {
                if (columnSort === currentSort) {
                    sortIcon.innerHTML = currentOrder === 'asc'
                        ? '<i class="bi bi-arrow-up"></i>'
                        : '<i class="bi bi-arrow-down"></i>';
                } else {
                    sortIcon.innerHTML = '';
                }
            }
        });
    }

    // Fetch sorted data from server
    function sortUsers() {
        if (!tableBody) return;

        const searchTerm = searchInput?.value?.trim() || '';
        const ajaxUrl = `/admin/users?sort=${currentSort}&order=${currentOrder}${searchTerm ? `&search=${encodeURIComponent(searchTerm)}` : ''}`;

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
                if (data.users) {
                    tableBody.innerHTML = data.users;

                    // Only update pagination if it exists and data.pagination exists
                    if (paginationContainer && data.pagination) {
                        paginationContainer.innerHTML = data.pagination;
                    }

                    // Update UI indicators and rebind events
                    if (typeof window.updateUserStatusIndicators === 'function') {
                        window.updateUserStatusIndicators();
                    }

                    updateSortIcons();

                    // Rebind event handlers
                    if (typeof window.setupSuspensionButtons === 'function') window.setupSuspensionButtons();
                    if (typeof window.setupPermissionsButtons === 'function') window.setupPermissionsButtons();
                    if (typeof window.setupPaginationLinks === 'function') window.setupPaginationLinks();

                    // Update URL with sort parameters
                    history.pushState({}, '', ajaxUrl);
                } else {
                    throw new Error('Invalid response format');
                }
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
                console.error('Erro ao buscar usuários:', error);
            });
    }

    // Column header sorting
    if (sortableColumns && sortableColumns.length > 0) {
        sortableColumns.forEach(column => {
            column.addEventListener('click', function() {
                const columnSort = column.dataset.sort;
                if (!columnSort) return;

                if (columnSort === currentSort) {
                    currentOrder = currentOrder === 'asc' ? 'desc' : 'asc';
                } else {
                    currentSort = columnSort;
                    currentOrder = 'asc';
                }

                window.currentSort = currentSort;
                window.currentOrder = currentOrder;

                updateSortIcons();
                sortUsers();
            });
        });
    }

    // Export for use in other modules
    window.sortUsers = sortUsers;
    window.updateSortIcons = updateSortIcons;

    // Initialize UI without fetching data
    updateSortIcons();
}

document.addEventListener('DOMContentLoaded', initSorting);
