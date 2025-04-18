function initPagination() {
    const tableBody = document.getElementById('userTableBody');
    const paginationContainer = document.getElementById('pagination-container');

    function setupPaginationLinks() {
        const paginationLinks = document.querySelectorAll('#pagination-container a');

        paginationLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('href');

                // Mostrar indicador de carregamento
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="p-4 text-center">
                            <div class="flex justify-center">
                                <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-indigo-500"></div>
                            </div>
                            <p class="mt-2 text-gray-600">Carregando utilizadores...</p>
                        </td>
                    </tr>
                `;

                // Converter URL de paginação para endpoint AJAX
                const ajaxUrl = '/admin/users?page=' + url.split('page=')[1];

                // Fetch data
                fetch(ajaxUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        // Update table
                        tableBody.innerHTML = data.users;

                        // Update pagination
                        paginationContainer.innerHTML = data.pagination;

                        // Make sure status indicators match data attributes
                        updateUserStatusIndicators();

                        // Initialize everything after update
                        initializeAfterUpdate();

                        // Update URL without page reload
                        history.pushState({}, '', url);
                    })
                    .catch(error => {
                        tableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="p-4 text-center text-red-500">
                                <i class="bi bi-exclamation-triangle mr-2"></i>
                                Erro ao carregar utilizadores. Por favor, tente novamente.
                            </td>
                        </tr>
                    `;
                        console.error('Erro ao buscar usuários:', error);
                    });
            });
        });
    }

    function updateUserStatusIndicators() {
        const userRows = document.querySelectorAll('.user-row');

        userRows.forEach(row => {
            const isSuspended = row.dataset.suspended === 'true';
            const statusCell = row.querySelector('td:nth-child(5)');
            const actionButton = row.querySelector('.suspend-user-btn');

            if (statusCell) {
                if (isSuspended) {
                    statusCell.innerHTML = `
                        <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-red-100 text-red-600">
                            Suspenso
                        </span>
                    `;
                    if (actionButton) actionButton.textContent = 'Reativar';
                } else {
                    statusCell.innerHTML = `
                        <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-700">
                            Ativo
                        </span>
                    `;
                    if (actionButton) actionButton.textContent = 'Suspender';
                }
            }
        });
    }

    function initializeAfterUpdate() {
        setupPaginationLinks();

        // Call the exported functions from other modules
        if (window.updateUserRows) window.updateUserRows();
        if (window.setupSuspensionButtons) window.setupSuspensionButtons();
        if (window.setupPermissionsButtons) window.setupPermissionsButtons();
        if (window.sortUsers) window.sortUsers();
    }

    // Export for use in other modules
    window.setupPaginationLinks = setupPaginationLinks;
    window.initializeAfterUpdate = initializeAfterUpdate;
    window.updateUserStatusIndicators = updateUserStatusIndicators;

    // Initialize pagination
    setupPaginationLinks();

    // Run on initial page load to ensure correct status display
    updateUserStatusIndicators();
}

// Run initialization when DOM is ready
document.addEventListener('DOMContentLoaded', initPagination);
