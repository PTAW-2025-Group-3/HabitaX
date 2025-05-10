@php use App\Enums\AttributeType; @endphp
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
                request('time_period') || request('min_price') || request('max_price'))
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
                    </div>
                </div>
            @endif

            <!-- Ver no Mapa -->
            @php
                $locationParts = [];

                if(request('parish')) {
                    $parish = \App\Models\Parish::find(request('parish'));
                    if ($parish) {
                        $locationParts[] = $parish->name;
                        if ($parish->municipality) {
                            $locationParts[] = $parish->municipality->name;
                            if ($parish->municipality->district) {
                                $locationParts[] = $parish->municipality->district->name;
                            }
                        }
                    }
                } elseif(request('municipality')) {
                    $municipality = \App\Models\Municipality::find(request('municipality'));
                    if ($municipality) {
                        $locationParts[] = $municipality->name;
                        if ($municipality->district) {
                            $locationParts[] = $municipality->district->name;
                        }
                    }
                } elseif(request('district')) {
                    $district = \App\Models\District::find(request('district'));
                    if ($district) {
                        $locationParts[] = $district->name;
                    }
                }

                $mapQuery = count($locationParts) > 0 ? implode(', ', $locationParts) . ', Portugal' : 'Portugal';
                $mapQueryEncoded = urlencode($mapQuery);
            @endphp

            <div class="bg-gradient-to-tr from-indigo-50 to-white rounded-2xl shadow-md overflow-hidden mb-8">
                <div class="h-48 md:h-56 relative">
                    <iframe
                        src="https://www.google.com/maps?q={{ $mapQueryEncoded }}&output=embed"
                        class="w-full h-full border-0"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </div>

                <a
                    href="https://www.google.com/maps/search/?api=1&query={{ $mapQueryEncoded }}"
                    target="_blank"
                    class="w-full text-blue-600 hover:text-blue-700 bg-white text-sm md:text-base font-semibold py-3 border-t border-indigo-100 transition block text-center">
                    <i class="bi bi-geo-alt-fill mr-1"></i> Ver no mapa
                </a>
            </div>

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
                        <input type="number" name="min_price" placeholder="Mínimo"
                               value="{{ request('min_price') }}"
                               class="p-2 pl-4 pr-4 w-full border border-gray-300 rounded-lg">
                    </div>
                    <div class="relative">
                        <input type="number" name="max_price" placeholder="Máximo"
                               value="{{ request('max_price') }}"
                               class="p-2 pl-4 pr-4 w-full border border-gray-300 rounded-lg">
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="w-full h-px bg-gray-200 my-6"></div>

            <!-- Dynamic filters -->
            @if(isset($type))
                <div class="mb-6">
                    Filtros específicos
                </div>
                @php
                    $path = 'advertisements.listing.attributes.';
                    $attributeIncludes = [
                        AttributeType::INT->value => $path . 'int',
                        AttributeType::FLOAT->value => $path . 'float',
                        AttributeType::BOOLEAN->value => $path . 'boolean',
                        AttributeType::DATE->value => $path . 'date',
                        AttributeType::SELECT_SINGLE->value => $path . 'select-single',
                        AttributeType::SELECT_MULTIPLE->value => $path . 'select-multiple',
                    ];
                @endphp
                @foreach($type->filterAttributes as $attribute)
                    @if(isset($attributeIncludes[$attribute->type->value]))
                        <div class="mb-6">
                            @include($attributeIncludes[$attribute->type->value], [
                                'attribute' => $attribute
                            ])
                        </div>
                    @endif
                @endforeach
            @endif

            <!-- obsolete -->
            <div style="display: none">
                <!-- Quartos -->
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-secondary mb-3 flex items-center">
                        <i class="bi bi-door-open-fill mr-2 text-secondary"></i> Quartos
                    </h3>
                    <input type="hidden" name="min_bedrooms" id="min_bedrooms" value="{{ request('min_bedrooms') }}">
                    <div class="grid grid-cols-5 gap-2 filter-group" data-filter-name="min_bedrooms">
                        <button data-value="" class="py-2 px-3 border rounded-lg font-medium hover:bg-secondary transition {{ request('min_bedrooms') == null ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }}">All</button>
                        <button data-value="1" class="py-2 px-3 border rounded-lg font-medium hover:bg-secondary transition {{ request('min_bedrooms') == '1' ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }}">1+</button>
                        <button data-value="2" class="py-2 px-3 border rounded-lg font-medium hover:bg-secondary transition {{ request('min_bedrooms') == '2' ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }}">2+</button>
                        <button data-value="3" class="py-2 px-3 border rounded-lg font-medium hover:bg-secondary transition {{ request('min_bedrooms') == '3' ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }}">3+</button>
                        <button data-value="4" class="py-2 px-3 border rounded-lg font-medium hover:bg-secondary transition {{ request('min_bedrooms') == '4' ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }}">4+</button>
                    </div>
                </div>

                <!-- Casas de Banho -->
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-secondary mb-3 flex items-center">
                        <i class="bi bi-badge-wc-fill mr-2 text-secondary"></i> Casas de Banho
                    </h3>
                    <input type="hidden" name="min_bathrooms" id="min_bathrooms" value="{{ request('min_bathrooms') }}">
                    <div class="grid grid-cols-4 gap-2 filter-group" data-filter-name="min_bathrooms">
                        <button data-value="" class="py-2 px-3 border rounded-lg font-medium hover:bg-secondary transition {{ request('min_bathrooms') == null ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }}">All</button>
                        <button data-value="1" class="py-2 px-3 border rounded-lg font-medium hover:bg-secondary transition {{ request('min_bathrooms') == '1' ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }}">1+</button>
                        <button data-value="2" class="py-2 px-3 border rounded-lg font-medium hover:bg-secondary transition {{ request('min_bathrooms') == '2' ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }}">2+</button>
                        <button data-value="3" class="py-2 px-3 border rounded-lg font-medium hover:bg-secondary transition {{ request('min_bathrooms') == '3' ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }}">3+</button>
                    </div>
                </div>

                <!-- Estado -->
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-secondary mb-3 flex items-center">
                        <i class="bi bi-building-fill-check mr-2 text-secondary"></i> Estado
                    </h3>
                    <input type="hidden" name="condition" id="condition" value="{{ request('condition') }}">
                    <div class="space-y-2 filter-group" data-filter-name="condition">
                        <button data-value="" class="w-full py-2 px-3 border rounded-lg font-medium hover:bg-secondary transition {{ request('condition') == null ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }}">Qualquer</button>
                        <button data-value="new" class="w-full py-2 px-4 border rounded-lg font-medium hover:bg-secondary transition {{ request('condition') == 'new' ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }}">Novo/Renovado</button>
                        <button data-value="used" class="w-full py-2 px-4 border rounded-lg font-medium hover:bg-secondary transition {{ request('condition') == 'used' ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }}">Usado</button>
                        <button data-value="to_renovate" class="w-full py-2 px-4 border rounded-lg font-medium hover:bg-secondary transition {{ request('condition') == 'to_renovate' ? 'bg-secondary text-white border-secondary' : 'border-gray-300' }}">Para Renovar</button>
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
            </div>

            <!-- Aplicar Filtros -->
            <div class="mt-8">
                <button type="submit" class="w-full py-3 btn-secondary">
                    <i class="bi bi-funnel-fill mr-2"></i> Aplicar Filtros
                </button>
                @if(request()->hasAny(['time_period', 'min_price', 'max_price', 'attributes']))
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
        document.querySelectorAll('.filter-group').forEach(group => {
            const inputName = group.dataset.filterName;
            const hiddenInput = document.getElementById(inputName);
            const buttons = group.querySelectorAll('button');

            buttons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();

                    const value = button.dataset.value;

                    // Atualizar o input escondido
                    hiddenInput.value = value;

                    // Estilo visual ativo
                    buttons.forEach(b => {
                        b.classList.remove('bg-secondary', 'text-white', 'border-secondary');
                        b.classList.add('border-gray-300');
                    });
                    button.classList.add('bg-secondary', 'text-white', 'border-secondary');
                    button.classList.remove('border-gray-300');
                });
            });
        });
    });
</script>





