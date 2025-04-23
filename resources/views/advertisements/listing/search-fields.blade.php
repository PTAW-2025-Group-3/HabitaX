<div class="flex flex-col md:flex-row md:space-x-6 space-y-4 md:space-y-0">
    <!-- Tipo de Imóvel (mantido igual) -->
    <div class="w-full md:w-1/2">
        <label for="property-type" class="block text-gray-secondary font-semibold mb-2">
            Tipo de Imóvel
        </label>

        <div class="relative dropdown-wrapper w-full">
            <select id="property-type" class="p-3 pl-4 pr-10 w-full dropdown-select">
                <option value="all">Todos</option>
                @foreach($propertyTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-gray">
                <i class="bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
            </div>
        </div>
    </div>

    <!-- Local - MODIFICADO para layout horizontal -->
    <div class="w-full md:w-1/2">
        <label class="block text-gray-secondary font-semibold mb-2">Local</label>

        <div class="flex flex-row space-x-3"> <!-- Alterado para flex-row e space-x -->
            <!-- Distrito (largura reduzida) -->
            <div class="relative dropdown-wrapper flex-1"> <!-- flex-1 para ocupar espaço disponível -->
                <select id="districtSelect" class="p-3 pl-4 pr-10 w-full dropdown-select">
                    <option value="">Distrito</option>
                    @foreach(App\Models\District::orderBy('name')->get() as $district)
                        <option value="{{ $district->id }}" data-municipalities='@json($district->municipalities)'>
                            {{ $district->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>

            <!-- Concelho (largura reduzida) -->
            <div class="relative dropdown-wrapper flex-1 hidden" id="municipalityWrapper"> <!-- flex-1 para ocupar espaço disponível -->
                <select id="municipalitySelect" class="p-3 pl-4 pr-10 w-full dropdown-select">
                    <option value="">Concelho</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Botão de Pesquisa (mantido igual) -->
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
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Código original do chevron (para o Tipo de Imóvel)
        const propertyTypeSelect = document.getElementById('property-type');
        const propertyTypeIcon = propertyTypeSelect.parentElement.querySelector('i');
        let isPropertyTypeOpen = false;

        propertyTypeSelect.addEventListener('click', () => {
            isPropertyTypeOpen = !isPropertyTypeOpen;
            propertyTypeIcon.classList.remove('bi-chevron-right', 'bi-dash');
            propertyTypeIcon.classList.add(isPropertyTypeOpen ? 'bi-dash' : 'bi-chevron-right');
        });

        document.addEventListener('click', (e) => {
            if (!propertyTypeSelect.contains(e.target) && isPropertyTypeOpen) {
                isPropertyTypeOpen = false;
                propertyTypeIcon.classList.remove('bi-dash');
                propertyTypeIcon.classList.add('bi-chevron-right');
            }
        });

        // 2. Lógica para os novos dropdowns (Distrito/Concelho)
        const districtSelect = document.getElementById('districtSelect');
        const municipalityWrapper = document.getElementById('municipalityWrapper');
        const municipalitySelect = document.getElementById('municipalitySelect');

        // Animação do chevron para Distrito
        districtSelect.addEventListener('click', function() {
            const icon = this.parentElement.querySelector('i');
            icon.classList.toggle('bi-dash');
            icon.classList.toggle('bi-chevron-right');
        });

        // Animação do chevron para Concelho
        municipalitySelect.addEventListener('click', function() {
            const icon = this.parentElement.querySelector('i');
            icon.classList.toggle('bi-dash');
            icon.classList.toggle('bi-chevron-right');
        });

        // Lógica para carregar concelhos
        districtSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const municipalities = JSON.parse(selectedOption.getAttribute('data-municipalities') || '[]');

            // Reset
            municipalitySelect.innerHTML = '<option value="">Concelho</option>';

            if (municipalities.length > 0) {
                municipalities.forEach(municipality => {
                    const option = new Option(municipality.name, municipality.id);
                    municipalitySelect.add(option);
                });
                municipalityWrapper.classList.remove('hidden');
            } else {
                municipalityWrapper.classList.add('hidden');
            }
        });

        // Fechar dropdowns ao clicar fora
        document.addEventListener('click', function(e) {
            if (!districtSelect.contains(e.target)) {
                const icon = districtSelect.parentElement.querySelector('i');
                icon.classList.remove('bi-dash');
                icon.classList.add('bi-chevron-right');
            }

            if (!municipalitySelect.contains(e.target)) {
                const icon = municipalitySelect.parentElement.querySelector('i');
                icon.classList.remove('bi-dash');
                icon.classList.add('bi-chevron-right');
            }
        });
    });
</script>
