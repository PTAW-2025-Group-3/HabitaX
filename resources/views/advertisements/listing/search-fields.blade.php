<form method="GET" action="{{ route('advertisements.index') }}">

{{--    Toggle Buttons--}}
    <div class="relative w-full max-w-md mx-auto mb-8">
        <div class="flex bg-gray-300 rounded-2xl relative overflow-hidden">
                <!-- Slider Azul -->
            <div
                id="slider"
                class="absolute top-0 left-0 w-1/2 h-full bg-blue-900 rounded-2xl transition-all duration-300 z-0"
            ></div>

            <!-- Botões -->
            <div
               id="btn-comprar"
               class="w-1/2 text-center z-10 cursor-pointer py-3 px-6 text-xl font-medium text-black"
            >
                Comprar
            </div>
            <div
               id="btn-arrendar"
               class="w-1/2 text-center z-10 cursor-pointer py-3 px-6 text-xl font-medium text-black"
            >
                Arrendar
            </div>
        </div>
    </div>
{{--    Separador --}}
    <div class="w-full h-px bg-gray-400 mb-6"></div>

    <div class="flex flex-col md:flex-row md:space-x-6 space-y-4 md:space-y-0">
        {{-- Tipo de Imóvel --}}
        <div class="w-full md:w-1/4">
            <label for="property-type" class="block text-gray-secondary font-semibold mb-2">
                Tipo de Imóvel
            </label>
            <div class="relative dropdown-wrapper w-full">
                <select name="property_type" id="property-type"> class="special-chevron p-3 pl-4 pr-10 w-full dropdown-select">
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
            <label for="districtSelect"
                   class="block text-gray-secondary font-semibold mb-2">Distrito</label>
            <div class="relative dropdown-wrapper w-full">
                <select name="district" id="districtSelect" class="special-chevron p-3 pl-4 pr-10 w-full dropdown-select">
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
            <label for="municipalitySelect" class=" block text-gray-secondary font-semibold mb-2">Concelho</label>
            <div class="relative dropdown-wrapper w-full">
                <select name="municipality" id="municipalitySelect" class="special-chevron p-3 pl-4 pr-10 w-full dropdown-select">
                    <option value="">Concelho</option>
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
            <label for="parishSelect"
                   class="special-chevron block text-gray-secondary font-semibold mb-2">Freguesia</label>
            <div class="relative dropdown-wrapper w-full">
                <select name="parish" id="parishSelect" class="special-chevron p-3 pl-4 pr-10 w-full dropdown-select">
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

        {{-- Botão Pesquisar --}}
        <div class="w-full md:w-1/4 flex items-end">
            <button type="submit"
                    class="w-full p-3 pl-4 pr-4 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow transition duration-200 flex items-center justify-center gap-2 h-[48px]">
                <i class="bi bi-search text-lg"></i>
                Pesquisar
            </button>
        </div>
    </div>
</form>

<script>
    // Código específico para o chevron (ícone)
    document.addEventListener('DOMContentLoaded', function () {
        const selects = document.querySelectorAll('.special-chevron');

        selects.forEach(chevron => {
            const wrapper = chevron.parentElement; // div.dropdown-wrapper
            const icon = wrapper.querySelector('i');
            let isOpen = false;

            chevron.addEventListener('click', (e) => {
                e.stopPropagation(); // impedir que propague o click para o document
                isOpen = !isOpen;

                icon.classList.remove('bi-chevron-right', 'bi-dash');
                icon.classList.add(isOpen ? 'bi-dash' : 'bi-chevron-right');
            });

            document.addEventListener('click', (e) => {
                if (!wrapper.contains(e.target) && isOpen) {
                    isOpen = false;
                    icon.classList.remove('bi-dash');
                    icon.classList.add('bi-chevron-right');
                }
            });
        });
    });
</script>

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
    });
</script>

{{--Toggle Buttons JavaScript--}}
<script>
    const btnComprar = document.getElementById("btn-comprar");
    const btnArrendar = document.getElementById("btn-arrendar");
    const slider = document.getElementById("slider");

    let selected = null; // Controla o botão atualmente ativo

    btnComprar.addEventListener("click", () => {
        if (selected === "comprar") {
            // Se já estava selecionado, deseleciona
            selected = null;
            slider.style.display = "none";
            btnComprar.classList.remove("text-white", "font-semibold");
            btnComprar.classList.add("text-gray-800");
        } else {
            selected = "comprar";
            slider.style.display = "block";
            slider.style.left = "0%";
            btnComprar.classList.add("text-white", "font-semibold");
            btnComprar.classList.remove("text-gray-800");
            btnArrendar.classList.remove("text-white", "font-semibold");
            btnArrendar.classList.add("text-gray-800");
        }
    });

    btnArrendar.addEventListener("click", () => {
        if (selected === "arrendar") {
            selected = null;
            slider.style.display = "none";
            btnArrendar.classList.remove("text-white", "font-semibold");
            btnArrendar.classList.add("text-gray-800");
        } else {
            selected = "arrendar";
            slider.style.display = "block";
            slider.style.left = "50%";
            btnArrendar.classList.add("text-white", "font-semibold");
            btnArrendar.classList.remove("text-gray-800");
            btnComprar.classList.remove("text-white", "font-semibold");
            btnComprar.classList.add("text-gray-800");
        }
    });

    // Inicialmente sem seleção
    slider.style.display = "none";
</script>

