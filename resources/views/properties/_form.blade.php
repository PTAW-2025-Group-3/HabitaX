<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div id="details-section">
        @include('properties.create.details')
    </div>

    <div id="location-section">
        @include('properties.create.location')
    </div>

    <div class="bg-white shadow-xl rounded-2xl p-8 mb-8 border border-gray-200 animate-fade-in">
        <div class="flex items-center mb-6 border-b border-gray-100 pb-4">
            <i class="bi bi-building text-2xl text-primary mr-3"></i>
            <h2 class="text-2xl font-bold text-primary">Tipo de Propriedade</h2>
        </div>

        <div class="transition-all duration-300 hover:shadow-md p-4 rounded-xl hover:bg-gray-50">
            <label for="property_type_id" class="block text-sm font-semibold text-gray-secondary mb-3 flex items-center">
                <i class="bi bi-house-gear mr-2 text-secondary"></i>
                Selecione o tipo de propriedade
            </label>

            <div class="relative dropdown-wrapper w-full sm:w-auto">
                <select name="property_type_id" id="property_type_id"
                        class="dropdown-select py-3 pl-4 pr-10 w-full text-base">
                    <option value="" disabled selected>Escolha o tipo de imóvel</option>
                    @foreach($propertyTypes as $propertyType)
                        <option value="{{ $propertyType->id }}" {{ old('property_type_id', $selectedPropertyType ?? '') == $propertyType->id ? 'selected' : '' }}>
                            {{ $propertyType->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
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
                // Load attributes
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

            // FilePond customization
            const existingImages = {{ json_encode($property->images ?? null) }};
            const pondOptions = {
                maxFiles: 20,
                allowMultiple: true,
                allowReorder: true,
                storeAsFile: true,
                imagePreviewHeight: 250,
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'],
                labelIdle: 'Arraste e solte suas imagens ou <span class="filepond--label-action">Selecione</span>',
            };
            if (existingImages) {
                pondOptions.files = [
                    {
                        source: existingImages.map(image => image.path),
                        options: {
                            type: 'local',
                            file: {},
                            metadata: {
                                poster: existingImages.map(image => image.path)
                            }
                        }
                    }
                ];
            }
            FilePond.create(document.querySelector('input.filepond'), pondOptions);
        });
    </script>
@endpush
