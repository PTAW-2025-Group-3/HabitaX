function initSorting() {
    const tableBody = document.getElementById('userTableBody');
    const sortDropdownButton = document.getElementById('sortDropdownButton');
    const sortDropdownMenu = document.getElementById('sortDropdownMenu');
    const sortableColumns = document.querySelectorAll('.sortable-column');
    const sortOptions = document.querySelectorAll('.sort-option');
    const currentSortLabel = document.getElementById('currentSortLabel');
    let userRows = document.querySelectorAll('.user-row');

    // Variables
    let currentSort = 'created_at';
    let currentOrder = 'desc';

    // Função para mostrar ícones de ordenação
    function updateSortIcons() {
        sortableColumns.forEach(column => {
            const sortIcon = column.querySelector('.sort-icon');
            const columnSort = column.dataset.sort;

            if (columnSort === currentSort) {
                sortIcon.innerHTML = currentOrder === 'asc'
                    ? '<i class="bi bi-arrow-up"></i>'
                    : '<i class="bi bi-arrow-down"></i>';
            } else {
                sortIcon.innerHTML = '';
            }
        });
    }

    // Função para ordenar os usuários
    function sortUsers() {
        userRows = document.querySelectorAll('.user-row');
        const rows = Array.from(userRows);

        rows.sort((a, b) => {
            let valueA = a.dataset[currentSort];
            let valueB = b.dataset[currentSort];

            // Converter para números se for id ou timestamp
            if (currentSort === 'id' || currentSort === 'created_at') {
                valueA = parseInt(valueA);
                valueB = parseInt(valueB);
            }

            // Comparar valores
            if (valueA < valueB) {
                return currentOrder === 'asc' ? -1 : 1;
            }
            if (valueA > valueB) {
                return currentOrder === 'asc' ? 1 : -1;
            }
            return 0;
        });

        // Reordenar no DOM
        rows.forEach(row => {
            tableBody.appendChild(row);
        });

        // Atualizar ícones
        updateSortIcons();
    }

    // Mostrar/esconder dropdown de ordenação
    sortDropdownButton.addEventListener('click', function() {
        sortDropdownMenu.classList.toggle('hidden');
    });

    // Fechar dropdown ao clicar fora
    document.addEventListener('click', function(event) {
        if (!sortDropdownButton.contains(event.target) && !sortDropdownMenu.contains(event.target)) {
            sortDropdownMenu.classList.add('hidden');
        }
    });

    // Eventos para opções de ordenação no dropdown
    sortOptions.forEach(option => {
        option.addEventListener('click', function() {
            currentSort = this.dataset.sort;
            currentOrder = this.dataset.order;
            currentSortLabel.textContent = this.textContent.trim();
            sortDropdownMenu.classList.add('hidden');
            sortUsers();
        });
    });

    // Eventos para colunas ordenáveis
    sortableColumns.forEach(column => {
        column.addEventListener('click', function() {
            const columnSort = this.dataset.sort;

            // Se clicar na mesma coluna, inverte a ordem
            if (columnSort === currentSort) {
                currentOrder = currentOrder === 'asc' ? 'desc' : 'asc';
            } else {
                currentSort = columnSort;
                currentOrder = 'asc';
            }

            // Atualizar o texto no dropdown
            const matchingOption = Array.from(sortOptions).find(
                option => option.dataset.sort === currentSort && option.dataset.order === currentOrder
            );

            if (matchingOption) {
                currentSortLabel.textContent = matchingOption.textContent.trim();
            } else {
                // Texto personalizado quando não há correspondência exata no dropdown
                const sortLabels = {
                    'id': 'ID',
                    'name': 'Nome',
                    'email': 'Email',
                    'created_at': 'Data de Registo'
                };

                currentSortLabel.textContent = `${sortLabels[currentSort]} (${currentOrder === 'asc' ? 'A-Z' : 'Z-A'})`;
            }

            sortUsers();
        });
    });

    // Export for use in other modules
    window.sortUsers = sortUsers;

    // Initialize sorting
    sortUsers();
}
