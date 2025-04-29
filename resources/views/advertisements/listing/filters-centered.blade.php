<div class="w-full md:w-1/4">
    <form method="GET" action="{{ route('advertisements.index') }}" id="filters-form">
        <!-- Preservar os filtros de localização e tipo de propriedade -->
        @if(request('property_type'))
            <input type="hidden" name="property_type" value="{{ request('property_type') }}">
        @endif
        @if(request('district'))
            <input type="hidden" name="district" value="{{ request('district') }}">
        @endif
        @if(request('municipality'))
            <input type="hidden" name="municipality" value="{{ request('municipality') }}">
        @endif
        @if(request('parish'))
            <input type="hidden" name="parish" value="{{ request('parish') }}">
        @endif

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <h2 class="font-bold text-2xl mb-6 text-primary text-center">Filtros</h2>

            @if(request('property_type') || request('district') || request('municipality') || request('parish') ||
    request('time_period') || request('min_price') || request('max_price') || request('min_area') || request('max_area'))
                <div class="mb-4 p-3 bg-blue-50 rounded-lg border border-blue-100">
                    <h4 class="font-medium text-sm text-blue-800 mb-2">Filtros ativos:</h4>
                    <div class="flex flex-wrap gap-2">
                        @if(request('property_type'))
                            @php
                                $type = \App\Models\PropertyType::find(request('property_type'));
                            @endphp
                            @if($type)
                                <span class="inline-flex items-center px-2 py-1 bg-white rounded-full text-xs font-medium text-blue-700 border border-blue-200">
                        <span>Tipo: {{ $type->name }}</span>
                        <a href="{{ route('advertisements.index', request()->except('property_type')) }}" class="ml-1 text-gray-500 hover:text-red-500">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </span>
                            @endif
                        @endif

                        @if(request('parish'))
                            @php
                                $parish = \App\Models\Parish::find(request('parish'));
                            @endphp
                            @if($parish)
                                <span class="inline-flex items-center px-2 py-1 bg-white rounded-full text-xs font-medium text-blue-700 border border-blue-200">
                        <span>Freguesia: {{ $parish->name }}</span>
                        <a href="{{ route('advertisements.index', request()->except('parish')) }}" class="ml-1 text-gray-500 hover:text-red-500">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </span>
                            @endif
                        @elseif(request('municipality'))
                            @php
                                $municipality = \App\Models\Municipality::find(request('municipality'));
                            @endphp
                            @if($municipality)
                                <span class="inline-flex items-center px-2 py-1 bg-white rounded-full text-xs font-medium text-blue-700 border border-blue-200">
                        <span>Concelho: {{ $municipality->name }}</span>
                        <a href="{{ route('advertisements.index', request()->except('municipality')) }}" class="ml-1 text-gray-500 hover:text-red-500">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </span>
                            @endif
                        @elseif(request('district'))
                            @php
                                $district = \App\Models\District::find(request('district'));
                            @endphp
                            @if($district)
                                <span class="inline-flex items-center px-2 py-1 bg-white rounded-full text-xs font-medium text-blue-700 border border-blue-200">
                        <span>Distrito: {{ $district->name }}</span>
                        <a href="{{ route('advertisements.index', request()->except('district')) }}" class="ml-1 text-gray-500 hover:text-red-500">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </span>
                            @endif
                        @endif

                        @if(request('time_period'))
                            @php
                                $timePeriodText = [
                                    '24h' => 'Últimas 24 horas',
                                    '3d' => 'Últimos 3 dias',
                                    '7d' => 'Última semana',
                                    '30d' => 'Último mês'
                                ][request('time_period')] ?? request('time_period');
                            @endphp
                            <span class="inline-flex items-center px-2 py-1 bg-white rounded-full text-xs font-medium text-blue-700 border border-blue-200">
                    <span>Publicação: {{ $timePeriodText }}</span>
                    <a href="{{ route('advertisements.index', request()->except('time_period')) }}" class="ml-1 text-gray-500 hover:text-red-500">
                        <i class="bi bi-x-circle"></i>
                    </a>
                </span>
                        @endif

                        @if(request('min_price') || request('max_price'))
                            <span class="inline-flex items-center px-2 py-1 bg-white rounded-full text-xs font-medium text-blue-700 border border-blue-200">
                    <span>
                        Preço:
                        @if(request('min_price') && request('max_price'))
                            {{ number_format(request('min_price'), 0, ',', '.') }}€ - {{ number_format(request('max_price'), 0, ',', '.') }}€
                        @elseif(request('min_price'))
                            > {{ number_format(request('min_price'), 0, ',', '.') }}€
                        @else
                            < {{ number_format(request('max_price'), 0, ',', '.') }}€
                        @endif
                    </span>
                    <a href="{{ route('advertisements.index', request()->except(['min_price', 'max_price'])) }}" class="ml-1 text-gray-500 hover:text-red-500">
                        <i class="bi bi-x-circle"></i>
                    </a>
                </span>
                        @endif

                        @if(request('min_area') || request('max_area'))
                            <span class="inline-flex items-center px-2 py-1 bg-white rounded-full text-xs font-medium text-blue-700 border border-blue-200">
                    <span>
                        Área:
                        @if(request('min_area') && request('max_area'))
                            {{ request('min_area') }}m² - {{ request('max_area') }}m²
                        @elseif(request('min_area'))
                            > {{ request('min_area') }}m²
                        @else
                            < {{ request('max_area') }}m²
                        @endif
                    </span>
                    <a href="{{ route('advertisements.index', request()->except(['min_area', 'max_area'])) }}" class="ml-1 text-gray-500 hover:text-red-500">
                        <i class="bi bi-x-circle"></i>
                    </a>
                </span>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Ver no Mapa -->
            <div class="mb-6">
                <h3 class="font-semibold text-gray-secondary mb-3 flex items-center">
                    <i class="bi bi-geo-alt-fill mr-2 text-secondary"></i>
                    Ver no Mapa
                </h3>
                <div class="w-full h-48 bg-gray-200 rounded-lg overflow-hidden relative">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49369.99053093508!2d-8.661563!3d40.641013!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd23b8ac5643d6d5%3A0x4da7817b0ddf00f4!2sAveiro!5e0!3m2!1spt-PT!2spt!4v1711570225305!5m2!1spt-PT!2spt"
                        class="absolute top-0 left-0 w-full h-full border-0"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                    <button class="absolute bottom-2 right-2 px-3 py-2 btn-primary">
                        <i class="bi bi-arrows-fullscreen mr-1"></i> Expandir
                    </button>
                </div>
            </div>

            <!-- Quartos -->
            <div class="mb-6">
                <h3 class="font-semibold text-gray-secondary mb-3 flex items-center">
                    <i class="bi bi-door-open-fill mr-2 text-secondary"></i> Quartos
                </h3>
                <div class="grid grid-cols-5 gap-2 filter-group">
                    <button data-selected
                            class="py-2 px-3 border-2 border-secondary rounded-lg font-medium hover:bg-secondary transition">
                        All
                    </button>
                    <button
                        class="py-2 px-3 border border-gray-300 rounded-lg hover:border-secondary hover:bg-indigo-50 transition">
                        1+
                    </button>
                    <button
                        class="py-2 px-3 border border-gray-300 rounded-lg hover:border-secondary hover:bg-indigo-50 transition">
                        2+
                    </button>
                    <button
                        class="py-2 px-3 border border-gray-300 rounded-lg hover:border-secondary hover:bg-indigo-50 transition">
                        3+
                    </button>
                    <button
                        class="py-2 px-3 border border-gray-300 rounded-lg hover:border-secondary hover:bg-indigo-50 transition">
                        4+
                    </button>
                </div>
            </div>

            <!-- Casas de Banho -->
            <div class="mb-6">
                <h3 class="font-semibold text-gray-secondary mb-3 flex items-center">
                    <i class="bi bi-badge-wc-fill mr-2 text-secondary"></i> Casas de Banho
                </h3>
                <div class="grid grid-cols-4 gap-2 filter-group">
                    <button data-selected
                            class="py-2 px-3 border-2 border-secondary rounded-lg font-medium hover:bg-secondary transition">
                        All
                    </button>
                    <button
                        class="py-2 px-3 border border-gray-300 rounded-lg hover:border-secondary hover:bg-indigo-50 transition">
                        1+
                    </button>
                    <button
                        class="py-2 px-3 border border-gray-300 rounded-lg hover:border-secondary hover:bg-indigo-50 transition">
                        2+
                    </button>
                    <button
                        class="py-2 px-3 border border-gray-300 rounded-lg hover:border-secondary hover:bg-indigo-50 transition">
                        3+
                    </button>
                </div>
            </div>

            <!-- Estado -->
            <div class="mb-6">
                <h3 class="font-semibold text-gray-secondary mb-3 flex items-center">
                    <i class="bi bi-building-fill-check mr-2 text-secondary"></i> Estado
                </h3>
                <div class="space-y-2 filter-group">
                    <button data-selected
                            class="w-full py-2 px-3 border-2 border-secondary rounded-lg font-medium hover:bg-secondary transition">
                        Qualquer
                    </button>
                    <button
                        class="w-full py-2 px-4 border border-gray-300 rounded-lg text-left hover:border-secondary hover:bg-indigo-50 transition">
                        Novo/Renovado
                    </button>
                    <button
                        class="w-full py-2 px-4 border border-gray-300 rounded-lg text-left hover:border-secondary hover:bg-indigo-50 transition">
                        Usado
                    </button>
                    <button
                        class="w-full py-2 px-4 border border-gray-300 rounded-lg text-left hover:border-secondary hover:bg-indigo-50 transition">
                        Para Renovar
                    </button>
                </div>
            </div>

            <!-- Divider -->
            <div class="w-full h-px bg-gray-200 my-6"></div>

            <!-- Publicação -->
            <div class="mb-6">
                <h3 class="font-semibold text-gray-secondary mb-3 flex items-center">
                    <i class="bi bi-clock-history mr-2 text-secondary"></i> Publicação
                </h3>
                <div class="relative dropdown-wrapper">
                    <select name="time_period" class="p-2 pl-4 pr-10 dropdown-select">
                        <option value="">Qualquer tempo</option>
                        <option value="24h" {{ request('time_period') == '24h' ? 'selected' : '' }}>Últimas 24 horas</option>
                        <option value="3d" {{ request('time_period') == '3d' ? 'selected' : '' }}>Últimos 3 dias</option>
                        <option value="7d" {{ request('time_period') == '7d' ? 'selected' : '' }}>Última semana</option>
                        <option value="30d" {{ request('time_period') == '30d' ? 'selected' : '' }}>Último mês</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                        <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                    </div>
                </div>
            </div>

            <!-- Preço -->
            <div class="mb-6">
                <h3 class="font-semibold text-gray-secondary mb-3 flex items-center">
                    <i class="bi bi-currency-euro mr-2 text-secondary"></i> Preço
                </h3>
                <div class="grid grid-cols-2 gap-3">
                    <div class="relative">
                        <input type="number" name="min_price" placeholder="Mínimo (€)"
                               value="{{ request('min_price') }}"
                               class="p-2 pl-4 pr-4 w-full border border-gray-300 rounded-lg">
                    </div>
                    <div class="relative">
                        <input type="number" name="max_price" placeholder="Máximo (€)"
                               value="{{ request('max_price') }}"
                               class="p-2 pl-4 pr-4 w-full border border-gray-300 rounded-lg">
                    </div>
                </div>
            </div>

            <!-- Tamanho -->
            <div class="mb-6">
                <h3 class="font-semibold text-gray-secondary mb-3 flex items-center">
                    <i class="bi bi-arrows-expand mr-2 text-secondary"></i> Tamanho
                </h3>
                <div class="grid grid-cols-2 gap-3">
                    <div class="relative">
                        <input type="number" name="min_area" placeholder="Mínimo (m²)"
                               value="{{ request('min_area') }}"
                               class="p-2 pl-4 pr-4 w-full border border-gray-300 rounded-lg">
                    </div>
                    <div class="relative">
                        <input type="number" name="max_area" placeholder="Máximo (m²)"
                               value="{{ request('max_area') }}"
                               class="p-2 pl-4 pr-4 w-full border border-gray-300 rounded-lg">
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="w-full h-px bg-gray-200 my-6"></div>

            <!-- Comodidades -->
            <div class="mb-4">
                <h3 class="font-semibold text-gray-secondary mb-4 flex items-center">
                    <i class="bi bi-sliders2-vertical mr-2 text-secondary"></i> Comodidades
                </h3>
                <div class="grid grid-cols-1 gap-3">
                    @foreach (['Ar Condicionado', 'Garagem', 'Jardim', 'Piscina', 'Painéis Solares', 'Mobilidade Reduzida'] as $amenity)
                        <div
                            class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200 hover:border-secondary hover:bg-indigo-50 transition">
                            <div class="w-5 mr-3 flex items-center justify-center">
                                <input type="checkbox" id="{{ Str::slug($amenity) }}"
                                       class="h-5 w-5 text-secondary rounded border-gray-300 focus:ring-secondary">
                            </div>
                            <label for="{{ Str::slug($amenity) }}" class="text-sm font-medium">{{ $amenity }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Aplicar Filtros -->
            <div class="mt-8">
                <button type="submit" class="w-full py-3 btn-secondary">
                    <i class="bi bi-funnel-fill mr-2"></i> Aplicar Filtros
                </button>
                @if(request()->hasAny(['time_period', 'min_price', 'max_price', 'min_area', 'max_area']))
                    <a href="{{ route('advertisements.index') }}" class="mt-2 block text-center text-sm text-secondary hover:underline">
                        Limpar filtros
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Botões de filtros
        document.querySelectorAll('.filter-group').forEach(group => {
            const type = group.dataset.filterType || 'default';
            const buttons = group.querySelectorAll('button');

            const applyActiveStyle = (button) => {
                if (type === 'light') {
                    button.classList.remove('border-gray-300', 'text-gray-700', 'hover:bg-indigo-50');
                    button.classList.add('bg-indigo-100', 'text-secondary', 'border-secondary');
                } else {
                    button.classList.remove('border-gray-300', 'text-gray-700', 'bg-white', 'hover:bg-indigo-50');
                    button.classList.add('bg-secondary', 'text-white', 'border-secondary');
                }
            };

            const resetButtons = () => {
                buttons.forEach(b => {
                    b.classList.remove(
                        'bg-secondary', 'text-white', 'border-secondary',
                        'bg-indigo-100', 'text-secondary',
                        'hover:bg-indigo-50'
                    );
                    b.classList.add('border-gray-300', 'text-gray-700', 'bg-white', 'hover:bg-indigo-50');
                    b.blur();
                });
            };

            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    resetButtons();
                    applyActiveStyle(button);
                });
            });

            const preselected = group.querySelector('button[data-selected]');
            if (preselected) applyActiveStyle(preselected);
        });

    });
</script>



