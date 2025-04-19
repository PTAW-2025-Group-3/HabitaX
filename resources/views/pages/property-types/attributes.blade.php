@extends('layout.app')

@section('title', 'Atributos do Tipo de Propriedade')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mb-4">
            <a href="{{ route('property-types.edit', ['id' => $propertyType->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Voltar para Tipo de Propriedade</a>
        </div>
        @if ($propertyType->attributes->isEmpty())
            <p>Nenhum atributo encontrado para este tipo de propriedade.</p>
        @else
        <div class="container mx-auto p-4">
            <h2 class="text-xl font-bold mb-4">Gerir Atributos do Tipo de Propriedade: {{ $propertyType->name }}</h2>
            <form id="attribute-form" method="POST" action="{{ route('property-types.attributes.update', $propertyType->id) }}"  class="bg-white p-6 rounded-lg shadow-md space-y-4">
                @csrf
                <div class="mb-4">
                    <label for="filter" class="block text-sm font-medium text-gray-700">Filtrar Atributos:</label>
                    <select id="filter" class="mt-1 block w-1/3 pl-3 pr-10 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="all">Todos</option>
                        <option value="selected">Selecionados</option>
                        <option value="not-selected">Não Selecionados</option>
                    </select>
                </div>

                <table class="table-auto w-full border-collapse border border-gray-300 mb-4">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">Nome de Atributo</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Assinado</th>
                    </tr>
                    </thead>
                    <tbody id="attribute-table">
                    @foreach($allAttributes as $attribute)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">{{ $attribute->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <input
                                    type="checkbox"
                                    name="attributes[]"
                                    value="{{ $attribute->id }}"
                                    {{ in_array($attribute->id, $propertyTypeAttributes) ? 'checked' : '' }}
                                    class="attribute-checkbox w-5 h-5">
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <button type="submit" id="submit-button" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 disabled:opacity-50" disabled>
                    Submeter
                </button>
            </form>
        </div>
        @endif
    </div>

    {{--  gerir estado da botão de submissão  --}}
    <script>
        const initialState = @json($propertyTypeAttributes);
        const checkboxes = document.querySelectorAll('.attribute-checkbox');
        const submitButton = document.getElementById('submit-button');

        function getCurrentState() {
            return Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => parseInt(cb.value));
        }

        function arraysEqual(a, b) {
            return a.length === b.length && a.every(val => b.includes(val));
        }

        function updateButtonState() {
            const currentState = getCurrentState();
            submitButton.disabled = arraysEqual(currentState, initialState);
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateButtonState);
        });
    </script>

    {{--  filtrar atributos  --}}
    <script>
        const filter = document.getElementById('filter');
        const rows = document.querySelectorAll('#attribute-table tr');

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
    </script>
@endsection
