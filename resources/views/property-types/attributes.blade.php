@php use App\Enums\AttributeType; @endphp
@extends('layout.app')

@section('title', 'Atributos do Tipo de Propriedade')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mb-6">
            <a href="{{ route('property-types.index', ['id' => $propertyType->id]) }}" class="btn-primary px-4 py-2">
                <i class="bi bi-arrow-left mr-2"></i>
                Voltar para Tipo de Propriedade
            </a>
        </div>

        <div class="mt-12 animate-fade-in">
            <h2 class="text-xl font-bold text-primary mb-4">Gerir Atributos do Tipo de
                Propriedade: {{ $propertyType->name }}</h2>

            <form id="attribute-form" method="POST"
                  action="{{ route('property-types.attributes.update', $propertyType->id) }}" class="space-y-4">
                @csrf
                <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 gap-4">
                    <div class="relative flex-grow md:max-w-xl">
                        <div class="relative dropdown-wrapper w-full sm:w-auto">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray">
                                <i class="bi bi-funnel"></i>
                            </div>
                            <select id="filter"
                                    class="py-2 pl-10 pr-10 w-full h-10 dropdown-select">
                                <option value="all">Todos os Atributos</option>
                                <option value="selected">Atributos Selecionados</option>
                                <option value="not-selected">Atributos Não Selecionados</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                                <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabela de atributos -->
                <div class="overflow-x-auto rounded-xl shadow bg-white">
                    <table class="min-w-full text-sm">
                        <thead class="bg-blue-100 text-left">
                        <tr>
                            <th class="p-4">
                                <div class="flex items-center">
                                    Nome de Atributo
                                </div>
                            </th>
                            <th class="p-4">
                                <div class="flex items-center">
                                    Tipo de Atributo
                                </div>
                            </th>
                            <th class="p-4">
                                <div class="flex items-center">
                                    Descrição
                                </div>
                            </th>
                            <th class="p-4 text-center">
                                <div class="flex items-center justify-center">
                                    Assinado
                                </div>
                            </th>
                            <th class="p-4 text-center">
                                <div class="flex items-center justify-center">
                                    Mostrar em:
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="attribute-table">
                        @foreach($allAttributes as $attribute)
                            <tr class="border-t hover:bg-gray-50 transition">
                                <td class="p-4 font-medium">{{ $attribute->name }}</td>
                                <td class="p-4">
                                    {{ $attribute->type }}
                                </td>
                                <td class="p-4">
                                    {{ \Illuminate\Support\Str::limit($attribute->description, 50, '...') }}
                                </td>
                                <td class="p-4 text-center">
                                    <input type="checkbox" name="attributes[{{ $attribute->id }}][selected]"
                                           value="1"
                                           class="attribute-checkbox w-5 h-5 cursor-pointer accent-blue-600"
                                           id="attr_{{ $attribute->id }}"
                                        {{ isset($propertyTypeAttributes[$attribute->id]) ? 'checked' : '' }}>
                                </td>
                                @if($attribute->is_required &&
                                ($attribute->type !== AttributeType::TEXT && $attribute->type !== AttributeType::LONG_TEXT && $attribute->type !== AttributeType::SELECT_MULTIPLE))
                                    <td class="show_options p-4" hidden>
                                        <div class="flex mb-2">
                                            <input type="checkbox" class="w-5 h-5 cursor-pointer accent-blue-600"
                                                   name="attributes[{{ $attribute->id }}][show_in_list]"
                                                   value="1"
                                                   id="list_{{ $attribute->id }}"
                                                {{ isset($propertyTypeAttributes[$attribute->id]) && $propertyTypeAttributes[$attribute->id]['show_in_list'] ? 'checked' : '' }}>
                                            <label class="ml-2" for="list_{{ $attribute->id }}">Listagem</label>
                                        </div>
                                        <div class="flex">
                                            <input type="checkbox" class="w-5 h-5 cursor-pointer accent-blue-600"
                                                   name="attributes[{{ $attribute->id }}][show_in_filter]"
                                                   value="1"
                                                   id="filter_{{ $attribute->id }}"
                                                {{ isset($propertyTypeAttributes[$attribute->id]) && $propertyTypeAttributes[$attribute->id]['show_in_filter'] ? 'checked' : '' }}>
                                            <label class="ml-2" for="filter_{{ $attribute->id }}">Filtro</label>
                                        </div>
                                    </td>
                                @else
                                    <td class="p-4 text-gray-400">
                                        Não aplicável
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" id="submit-button"
                            class="btn-primary px-6 py-3 rounded-lg flex items-center justify-center transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="bi bi-save mr-2"></i>
                        Guardar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const maxFilters = {{ $maxFilter }};
            const maxList = {{ $maxList }};

            const checkboxes = document.querySelectorAll('.attribute-checkbox');
            const filter = document.getElementById('filter');
            const rows = document.querySelectorAll('#attribute-table tr');
            const filterCheckboxes = document.querySelectorAll('input[name$="[show_in_filter]"]');
            const listCheckboxes = document.querySelectorAll('input[name$="[show_in_list]"]');

            filter.addEventListener('change', () => {
                const filterValue = filter.value;

                rows.forEach(row => {
                    const checkbox = row.querySelector('.attribute-checkbox');
                    if (filterValue === 'all') {
                        row.style.display = '';
                    } else if (filterValue === 'selected' && checkbox.checked) {
                        row.style.display = '';
                    } else if (filterValue === 'not-selected' && !checkbox.checked) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Show/Hide options based on checkbox state
            checkboxes.forEach(checkbox => {
                const showOptions = checkbox.closest('tr').querySelectorAll('.show_options');
                showOptions.forEach(option => {
                    if (checkbox.checked) {
                        option.removeAttribute('hidden');
                    }

                    // Add event listener for changes
                    checkbox.addEventListener('change', function () {
                        if (this.checked) {
                            option.removeAttribute('hidden');
                        } else {
                            option.setAttribute('hidden', true);
                        }
                    });
                });
            });

            // Enforce limits on the number of selected checkboxes
            function enforceLimit(checkboxes, max, type) {
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', () => {
                        const selectedCount = Array.from(checkboxes).filter(cb => cb.checked).length;

                        if (selectedCount > max) {
                            checkbox.checked = false;
                            alert(`You can only select up to ${max} attributes for ${type}.`);
                        }
                    });
                });
            }

            enforceLimit(filterCheckboxes, maxFilters, 'filters');
            enforceLimit(listCheckboxes, maxList, 'list');
        });
    </script>
@endpush
