function initUserSearch() {
    const searchInput = document.getElementById('userSearchInput');
    const clearButton = document.getElementById('clearSearch');
    const searchResults = document.getElementById('searchResults');
    const resultCount = document.getElementById('resultCount');
    const tableBody = document.getElementById('userTableBody');
    let userRows = document.querySelectorAll('.user-row');

    // Pesquisa em tempo real
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();

        // Mostrar/esconder botão de limpar
        if (searchTerm.length > 0) {
            clearButton.classList.remove('hidden');
            searchResults.classList.remove('hidden');
        } else {
            clearButton.classList.add('hidden');
            searchResults.classList.add('hidden');
        }

        let matchCount = 0;
        let matchFound = false;

        userRows.forEach(row => {
            const userName = row.querySelector('.user-name').textContent.toLowerCase();
            const userEmail = row.querySelector('.user-email').textContent.toLowerCase();

            if (userName.includes(searchTerm) || userEmail.includes(searchTerm)) {
                row.style.display = '';
                matchFound = true;
                matchCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Atualizar contador de resultados
        resultCount.textContent = matchCount;

        // Exibir mensagem "nenhum resultado"
        if (!matchFound && userRows.length > 0) {
            let noResultsRow = tableBody.querySelector('.no-results-row');

            if (!noResultsRow) {
                noResultsRow = document.createElement('tr');
                noResultsRow.className = 'no-results-row border-t';
                noResultsRow.innerHTML = '<td colspan="6" class="p-4 text-center text-gray-500">Nenhum resultado encontrado para "' + searchTerm + '"</td>';
                tableBody.appendChild(noResultsRow);
            } else {
                noResultsRow.querySelector('td').textContent = 'Nenhum resultado encontrado para "' + searchTerm + '"';
                noResultsRow.style.display = '';
            }
        } else {
            const noResultsRow = tableBody.querySelector('.no-results-row');
            if (noResultsRow) {
                noResultsRow.style.display = 'none';
            }
        }
    });

    // Limpar pesquisa
    clearButton.addEventListener('click', function() {
        searchInput.value = '';
        searchInput.focus();
        clearButton.classList.add('hidden');
        searchResults.classList.add('hidden');

        // Mostrar todas as linhas novamente
        userRows.forEach(row => {
            row.style.display = '';
        });

        // Remover mensagem "nenhum resultado"
        const noResultsRow = tableBody.querySelector('.no-results-row');
        if (noResultsRow) {
            noResultsRow.style.display = 'none';
        }
    });

    // Update userRows reference when table content changes
    window.updateUserRows = function() {
        userRows = document.querySelectorAll('.user-row');
    };
}
