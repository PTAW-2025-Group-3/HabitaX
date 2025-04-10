<div class="flex flex-col md:flex-row md:space-x-6 space-y-4 md:space-y-0">
    <!-- Tipo de Imóvel -->
    <div class="w-full md:w-1/2">
        <label for="property-type" class="block text-gray-800 font-semibold mb-2">Tipo de Imóvel</label>
        <div class="relative">
            <select id="property-type"
                    class="p-3 pl-4 pr-10 w-full dropdown-select">
                <option selected>Moradias</option>
                <option>Apartamentos</option>
                <option>Terrenos</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-gray-500">
                <i class="bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
            </div>
        </div>
    </div>

    <!-- Local -->
    <div class="w-full md:w-1/2">
        <label for="location" class="block text-gray-800 font-semibold mb-2">Local</label>
        <input
            type="text"
            id="location"
            value="Aveiro"
            class="w-full px-5 py-3 form-input-big"
        />
    </div>

    <!-- Botão de Pesquisa (separado) -->
    <div class="w-full md:w-auto flex items-end">
        <button
            type="button"
            class="w-full md:w-auto px-5 py-3 btn-primary"
        >
            <i class="bi bi-search mr-2"></i>
            <span>Pesquisar</span>
        </button>
    </div>
</div>

<script>
    // Código especifico para o chevron (dá drop up por algum motivo)
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('property-type');
        const icon = select.parentElement.querySelector('i');

        let isOpen = false;

        select.addEventListener('click', () => {
            isOpen = !isOpen;

            icon.classList.remove('bi-chevron-right', 'bi-dash');
            icon.classList.add(isOpen ? 'bi-dash' : 'bi-chevron-right');
        });

        // Fecha se clicar fora do select
        document.addEventListener('click', (e) => {
            if (!select.contains(e.target) && isOpen) {
                isOpen = false;
                icon.classList.remove('bi-dash');
                icon.classList.add('bi-chevron-right');
            }
        });
    });
</script>




