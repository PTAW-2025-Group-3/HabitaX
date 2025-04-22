<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-200">
        <h2 class="text-xl font-bold text-primary mb-6">Tipo de Propriedade</h2>

        <div>
            <label for="property_type_id" class="block text-sm font-medium text-gray-600 mb-1">Selecione o tipo de propriedade</label>
            <div class="relative">
                <select name="property_type_id" id="property_type_id"
                        class="py-2 pl-3 pr-10 w-full bg-white border border-gray-300 rounded-lg shadow-sm
                               appearance-none text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <option value="">Selecione</option>
                    @foreach($propertyTypes as $propertyType)
                        <option value="{{ $propertyType->id }}" {{ old('property_type_id', $selectedPropertyType ?? '') == $propertyType->id ? 'selected' : '' }}>
                            {{ $propertyType->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <i class="bi bi-chevron-down text-sm"></i>
                </div>
            </div>
        </div>
    </div>

    <div id="dynamic-attributes">
        {{--   Dynamic attributes will be loaded here   --}}
    </div>

    <div class="flex justify-end">
        <button type="submit" class="btn-secondary px-6 py-2 rounded-md">
            {{ $buttonText }}
        </button>
    </div>
</form>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelector = document.getElementById('property_type_id');
            const container = document.getElementById('dynamic-attributes');

            function loadAttributes(typeId) {
                fetch(`/property-type/${typeId}/attributes/html`)
                    .then(res => res.text())
                    .then(html => {
                        container.innerHTML = html;
                    })
                    .catch(() => {
                        container.innerHTML = '<p class="text-danger">Erro ao carregar atributos</p>';
                    });
            }

            typeSelector.addEventListener('change', () => {
                if (typeSelector.value) {
                    loadAttributes(typeSelector.value);
                } else {
                    container.innerHTML = '';
                }
            });

            if (typeSelector.value) {
                loadAttributes(typeSelector.value);
            }
        });
    </script>
@endpush
