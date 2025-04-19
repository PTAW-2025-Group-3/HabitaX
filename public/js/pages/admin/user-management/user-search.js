function initUserSearch() {
    const searchInput = document.getElementById('userSearchInput');
    const clearButton = document.getElementById('clearSearch');
    const searchResults = document.getElementById('searchResults');
    const resultCount = document.getElementById('resultCount');
    const tableBody = document.getElementById('userTableBody');
    const paginationContainer = document.getElementById('pagination-container');

    // Pesquisa em tempo real (AJAX)
    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase().trim();

        if (searchTerm.length > 0) {
            clearButton.classList.remove('hidden');
            searchResults.classList.remove('hidden');
        } else {
            clearButton.classList.add('hidden');
            searchResults.classList.add('hidden');
        }

        fetch(`/admin/users?search=${encodeURIComponent(searchTerm)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = data.users;
                paginationContainer.innerHTML = data.pagination;

                updateUserStatusIndicators();
                initializeAfterUpdate();

                // Atualizar contador de resultados
                const count = document.querySelectorAll('.user-row').length;
                resultCount.textContent = count;
            })
            .catch(error => {
                console.error('Erro ao pesquisar utilizadores:', error);
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="p-4 text-center text-red-500">
                            <i class="bi bi-exclamation-triangle mr-2"></i>
                            Erro ao carregar resultados.
                        </td>
                    </tr>
                `;
            });
    });

    // Limpar pesquisa
    clearButton.addEventListener('click', function () {
        searchInput.value = '';
        searchInput.focus();
        clearButton.classList.add('hidden');
        searchResults.classList.add('hidden');

        // Reload sem termo de pesquisa
        fetch(`/admin/users`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                tableBody.innerHTML = data.users;
                paginationContainer.innerHTML = data.pagination;

                updateUserStatusIndicators();
                initializeAfterUpdate();
                resultCount.textContent = document.querySelectorAll('.user-row').length;
            });
    });
}
