{{-- Div para sobrepor a searchbar e o nome por trás --}}
<div class="w-full flex flex-col items-center justify-start bg-back">
    {{-- Container Principal - Hidden on mobile --}}
    <div class="text-[280px] md:text-[200px] lg:text-[280px] font-extrabold text-black opacity-90 relative z-10 select-none hidden md:block">HabitaX</div>

    {{-- Versão mobile: título menor e visível --}}
    <div class="text-5xl font-extrabold text-black opacity-90 relative z-20 select-none block md:hidden mt-6 mb-4">HabitaX</div>

    <div class="relative md:absolute z-20 w-full max-w-5xl mx-auto bg-blue-800 bg-opacity-50 backdrop-blur-md rounded-2xl px-4 sm:px-6 py-6 sm:py-8 mt-0 md:mt-36 shadow-[0_20px_40px_rgba(0,0,0,0.3)] transition-all duration-500">
        <h2 class="text-center text-white text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold mb-4 sm:mb-6">
            O teu Espaço, <span class="text-gray-300 font-light">a tua Escolha</span>
        </h2>

        <form action="{{ route('advertisements.index') }}" method="GET"
              class="flex flex-col sm:flex-row flex-wrap sm:flex-nowrap justify-center gap-3 md:gap-2 lg:gap-4 items-center">

            {{-- Transaction Type Toggle --}}
            <div class="flex gap-0.5 w-full sm:w-auto">
                <input type="hidden" name="transaction_type" id="transactionTypeInput" value="sale">
                <button type="button" id="saleBtn"
                        class="property-toggle bg-primary text-white font-semibold px-3 sm:px-5 py-2 rounded-l-md shadow-md transition-all duration-300 flex-1 sm:flex-none">
                    Comprar
                </button>
                <button type="button" id="rentBtn"
                        class="property-toggle bg-gray-100 text-gray-800 font-semibold px-3 sm:px-5 py-2 rounded-r-md shadow-md transition-all duration-300 flex-1 sm:flex-none">
                    Arrendar
                </button>
            </div>

            {{-- Property Type --}}
            <div class="relative dropdown-wrapper w-full sm:w-auto">
                <select name="property_type" class="py-2 pl-4 pr-10 w-full h-10 dropdown-select">
                    <option value="">Todos</option>
                    @foreach($propertyTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>

            {{-- District --}}
            <div class="relative dropdown-wrapper w-full sm:w-auto">
                <select id="districtSelect" name="district" class="py-2 pl-4 pr-10 w-full h-10 dropdown-select">
                    <option value="">Selecione um Distrito</option>
                    @foreach(App\Models\District::orderBy('name')->get() as $district)
                        <option value="{{ $district->id }}" data-municipalities='@json($district->municipalities)'>
                            {{ $district->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>

            {{-- Municipality --}}
            <div class="relative dropdown-wrapper w-full sm:w-auto" id="municipalityWrapper">
                <select id="municipalitySelect" name="municipality"
                        class="py-2 pl-4 pr-10 w-full h-10 dropdown-select">
                    <option value="">Selecione um Concelho</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>

            {{-- Search Button --}}
            <button type="submit" class="px-3 py-3 btn-primary h-12 w-full sm:w-12">
                <i class="bi bi-search text-lg"></i>
                <span class="sm:hidden ml-2">Pesquisar</span>
            </button>
        </form>
    </div>
</div>

<div class="h-16 block md:hidden"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const saleBtn = document.getElementById('saleBtn');
        const rentBtn = document.getElementById('rentBtn');
        const transactionTypeInput = document.getElementById('transactionTypeInput');

        // Inicializa com 'sale' selecionado
        saleBtn.classList.add('bg-primary', 'text-white');
        saleBtn.classList.remove('bg-gray-100', 'text-gray-800');
        rentBtn.classList.remove('bg-blue-900', 'text-white');
        rentBtn.classList.add('bg-gray-100', 'text-gray-800');

        saleBtn.addEventListener('click', () => {
            saleBtn.classList.add('bg-primary', 'text-white');
            saleBtn.classList.remove('bg-gray-100', 'text-gray-800');
            rentBtn.classList.remove('bg-blue-900', 'text-white');
            rentBtn.classList.add('bg-gray-100', 'text-gray-800');

            transactionTypeInput.value = 'sale';
        });

        rentBtn.addEventListener('click', () => {
            rentBtn.classList.add('bg-blue-900', 'text-white');
            rentBtn.classList.remove('bg-gray-100', 'text-gray-800');
            saleBtn.classList.remove('bg-primary', 'text-white');
            saleBtn.classList.add('bg-gray-100', 'text-gray-800');

            transactionTypeInput.value = 'rent';
        });

        const districtSelect = document.getElementById('districtSelect');
        const municipalityWrapper = document.getElementById('municipalityWrapper');
        const municipalitySelect = document.getElementById('municipalitySelect');

        districtSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const municipalities = JSON.parse(selectedOption.getAttribute('data-municipalities') || '[]');

            municipalitySelect.innerHTML = '<option value="">Selecione um Concelho</option>';

            municipalities.forEach(municipality => {
                const option = new Option(municipality.name, municipality.id);
                municipalitySelect.add(option);
            });
        });
    });
</script>
