<form method="GET" action="{{ route('advertisements.index') }}">
    {{-- Preservar filtros laterais --}}
    @if(request('time_period'))
        <input type="hidden" name="time_period" value="{{ request('time_period') }}">
    @endif
    @if(request('min_price'))
        <input type="hidden" name="min_price" value="{{ request('min_price') }}">
    @endif
    @if(request('max_price'))
        <input type="hidden" name="max_price" value="{{ request('max_price') }}">
    @endif
    @if(request('min_area'))
        <input type="hidden" name="min_area" value="{{ request('min_area') }}">
    @endif
    @if(request('max_area'))
        <input type="hidden" name="max_area" value="{{ request('max_area') }}">
    @endif

    <input type="hidden" name="transaction_type" id="transactionTypeInput" value="{{ request('transaction_type', 'sale') }}">
    {{--    Toggle Buttons--}}
    <div class="relative w-full max-w-md mx-auto mb-8">
        <div class="flex bg-gray-300 rounded-2xl relative overflow-hidden">
            <!-- Slider Azul -->
            <div id="slider"
                 class="absolute top-0 left-0 w-1/2 h-full bg-blue-900 rounded-2xl transition-transform duration-300 ease-in-out z-0 transform"
                 style="transform: translateX({{ request('transaction_type') == 'rent' ? '100%' : '0%' }})"
            ></div>

            <!-- Botões -->
            <button
                id="btn-comprar"
                type="button"
                class="w-1/2 text-center z-10 cursor-pointer py-3 px-6 text-xl font-medium text-black"
            >
                Comprar
            </button>
            <button
                id="btn-arrendar"
                type="button"
                class="w-1/2 text-center z-10 cursor-pointer py-3 px-6 text-xl font-medium text-black"
            >
                Arrendar
            </button>
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
                <select name="property_type" id="property-type" class="special-chevron p-3 pl-4 pr-10 w-full dropdown-select">
                    <option value="">Todos</option>
                    @foreach($propertyTypes as $type)
                        <option value="{{ $type->id }}" {{ $selectedType == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
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
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
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
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
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
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function setupTransactionButtons() {
                const btnComprar = document.getElementById("btn-comprar");
                const btnArrendar = document.getElementById("btn-arrendar");
                const transactionInput = document.getElementById("transactionTypeInput");
                const slider = document.getElementById("slider");

                function activateButton(buttonToActivate, buttonToDeactivate, transformValue, typeValue) {
                    slider.style.display = "block";
                    slider.style.transform = `translateX(${transformValue})`;
                    transactionInput.value = typeValue;

                    buttonToActivate.classList.add("text-white", "font-semibold");
                    buttonToActivate.classList.remove("text-gray-800");
                    buttonToDeactivate.classList.remove("text-white", "font-semibold");
                    buttonToDeactivate.classList.add("text-gray-800");
                }

                // Estado inicial com base no valor do input hidden
                const selected = transactionInput.value || "sale";
                if (selected === "rent") {
                    activateButton(btnArrendar, btnComprar, "100%", "rent");
                } else {
                    activateButton(btnComprar, btnArrendar, "0%", "sale");
                }

                // Nos cliques
                btnComprar.addEventListener("click", () => {
                    activateButton(btnComprar, btnArrendar, "0%", "sale");
                });

                btnArrendar.addEventListener("click", () => {
                    activateButton(btnArrendar, btnComprar, "100%", "rent");
                });
            }

            function setupLocationSelects() {
                const districtSelect = document.getElementById('districtSelect');
                const municipalitySelect = document.getElementById('municipalitySelect');
                const parishSelect = document.getElementById('parishSelect');

                districtSelect.addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];
                    const municipalities = JSON.parse(selectedOption.dataset.municipalities || '[]');

                    municipalitySelect.innerHTML = '<option value="">Concelho</option>';
                    parishSelect.innerHTML = '<option value="">Freguesia</option>';

                    municipalities.forEach(m => {
                        const opt = document.createElement('option');
                        opt.value = m.id;
                        opt.textContent = m.name;
                        opt.dataset.parishes = JSON.stringify(m.parishes);
                        municipalitySelect.appendChild(opt);
                    });
                });

                municipalitySelect.addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];
                    const parishes = JSON.parse(selectedOption.dataset.parishes || '[]');

                    parishSelect.innerHTML = '<option value="">Freguesia</option>';

                    parishes.forEach(p => {
                        const opt = document.createElement('option');
                        opt.value = p.id;
                        opt.textContent = p.name;
                        parishSelect.appendChild(opt);
                    });
                });
            }

            setupTransactionButtons();
            setupLocationSelects();
        });
    </script>
@endpush
