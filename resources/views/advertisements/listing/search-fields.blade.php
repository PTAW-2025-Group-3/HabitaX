<div class="flex flex-col md:flex-row md:space-x-6 space-y-4 md:space-y-0">
    {{-- Tipo de Imóvel --}}
    <div class="w-full md:w-1/4">
        <label for="property-type" class="block text-gray-secondary font-semibold mb-2">
            Tipo de Imóvel
        </label>
        <div class="relative dropdown-wrapper w-full">
            <select name="type" id="property-type" class="p-3 pl-4 pr-10 w-full dropdown-select">
                <option value="">Todos</option>
                @foreach($propertyTypes as $type)
                    <option value="{{ $type->id }}" {{ $selectedType == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-gray">
                <i class="bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
            </div>
        </div>
    </div>

    {{-- Distrito --}}
    <div class="w-full md:w-1/4">
        <label for="districtSelect" class="block text-gray-secondary font-semibold mb-2">Distrito</label>
        <div class="relative dropdown-wrapper w-full">
            <select name="district" id="districtSelect" class="p-3 pl-4 pr-10 w-full dropdown-select">
                <option value="">Distrito</option>
                @foreach($districts as $district)
                    <option value="{{ $district->id }}"
                            data-municipalities='@json($district->municipalities)'
                        {{ $selectedDistrict == $district->id ? 'selected' : '' }}>
                        {{ $district->name }}
                    </option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-gray">
                <i class="bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
            </div>
        </div>
    </div>

    {{-- Concelho --}}
    <div class="w-full md:w-1/4">
        <label for="municipalitySelect" class="block text-gray-secondary font-semibold mb-2">Concelho</label>
        <div class="relative dropdown-wrapper w-full">
            <select name="municipality" id="municipalitySelect" class="p-3 pl-4 pr-10 w-full dropdown-select">
                <option value="">Concelho</option>
                {{-- Se estiver carregado via controller --}}
                @if($selectedDistrict)
                    @foreach($districts->find($selectedDistrict)?->municipalities ?? [] as $municipality)
                        <option value="{{ $municipality->id }}"
                                data-parishes='@json($municipality->parishes)'
                            {{ $selectedMunicipality == $municipality->id ? 'selected' : '' }}>
                            {{ $municipality->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-gray">
                <i class="bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
            </div>
        </div>
    </div>

    {{-- Freguesia --}}
    <div class="w-full md:w-1/4">
        <label for="parishSelect" class="block text-gray-secondary font-semibold mb-2">Freguesia</label>
        <div class="relative dropdown-wrapper w-full">
            <select name="parish" id="parishSelect" class="p-3 pl-4 pr-10 w-full dropdown-select">
                <option value="">Freguesia</option>
                @if($selectedMunicipality)
                    @foreach(\App\Models\Parish::where('municipality_id', $selectedMunicipality)->get() as $parish)
                        <option value="{{ $parish->id }}" {{ $selectedParish == $parish->id ? 'selected' : '' }}>
                            {{ $parish->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-gray">
                <i class="bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button type="submit"
                class="bg-primary hover:bg-primary-dark text-white font-medium py-1 px-4 rounded-lg shadow-sm transition duration-200 flex items-center gap-2 text-base">
            <i class="bi bi-search text-base"></i>
            Pesquisar
        </button>
    </div>
</div>

{{-- JavaScript para lógica dinâmica --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const districtSelect = document.getElementById('districtSelect');
        const municipalitySelect = document.getElementById('municipalitySelect');
        const parishSelect = document.getElementById('parishSelect');

        districtSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const municipalities = JSON.parse(selectedOption.getAttribute('data-municipalities') || '[]');

            municipalitySelect.innerHTML = '<option value="">Concelho</option>';
            parishSelect.innerHTML = '<option value="">Freguesia</option>';

            municipalities.forEach(m => {
                const opt = document.createElement('option');
                opt.value = m.id;
                opt.text = m.name;
                opt.setAttribute('data-parishes', JSON.stringify(m.parishes));
                municipalitySelect.appendChild(opt);
            });
        });

        municipalitySelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const parishes = JSON.parse(selectedOption.getAttribute('data-parishes') || '[]');

            parishSelect.innerHTML = '<option value="">Freguesia</option>';
            parishes.forEach(p => {
                const opt = document.createElement('option');
                opt.value = p.id;
                opt.text = p.name;
                parishSelect.appendChild(opt);
            });
        });

        // Chevrons animação
        document.querySelectorAll('select').forEach(select => {
            const icon = select.parentElement.querySelector('i');
            select.addEventListener('click', () => {
                icon.classList.toggle('bi-dash');
                icon.classList.toggle('bi-chevron-right');
            });
        });

        // Reset chevrons ao clicar fora
        document.addEventListener('click', function (e) {
            document.querySelectorAll('select').forEach(select => {
                if (!select.contains(e.target)) {
                    const icon = select.parentElement.querySelector('i');
                    icon.classList.remove('bi-dash');
                    icon.classList.add('bi-chevron-right');
                }
            });
        });
    });
</script>
