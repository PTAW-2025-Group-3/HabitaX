<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <div id="details-section">
        @include('properties.form.details')
    </div>

    <div id="location-section">
        @include('properties.form.location')
    </div>

    @if($property)
        <div class="bg-white shadow-xl rounded-2xl p-8 mb-8 border border-gray-200 animate-fade-in">
            <div class="flex items-center mb-6 border-b border-gray-100 pb-4">
                <i class="bi bi-house-check text-xl text-primary mr-3"></i>
                <h2 class="text-xl font-bold text-primary">Detalhes de Propriedade</h2>
            </div>
            @include('properties.form.attributes', [
                'attributes' => $attributes,
                'parameters' => $parameters,
                'parameterMap' => $parameterMap,
                'parameterOptionMap' => $parameterOptionMap
            ])
        </div>
    @endif

    <!-- Other details -->
    @if(false)
        <div class="bg-white shadow-md rounded-lg p-8 mb-8 animate-fade-in">
            <div class="flex items-center mb-6 border-b border-gray-100 pb-4">
                <i class="bi bi-building text-xl text-primary mr-3"></i>
                <h2 class="text-xl font-bold text-primary">Outros detalhes</h2>
            </div>
        </div>
    @endif

    <!-- Images -->
    <div class="bg-white shadow-md rounded-lg p-8 mb-8 animate-fade-in">
        <div class="flex items-center mb-6 border-b border-gray-100 pb-4">
            <i class="bi bi-images text-xl text-primary mr-3"></i>
            <h2 class="text-xl font-bold text-primary">Imagens da Propriedade</h2>
        </div>
        <p class="text-sm text-gray-500 mb-4">Submete aqui imagens da propriedade. Imagens tem que ser... Depois deixamos aqui recomendações gerais para fotos.</p>
        <div class="filepond-wrapper w-full">
            <input
                type="file"
                class="filepond"
                name="images"
                id="images"
            />
        </div>
        <p class="text-xs text-gray-400 mb-4">
            Formatos aceites: JPG, JPEG, PNG |
            Tamanho máximo: 2MB |
            Máximo de 20 fotografias
        </p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex justify-end">
        <button type="submit" class="btn-primary px-6 py-2 rounded-md">
            {{ $buttonText }}
        </button>
    </div>
</form>

@push('styles')
    <style>
        .filepond--wrapper {
            max-width: 100%;
        }

        .filepond--file-poster {
            height: auto !important;
            object-fit: cover;
            object-position: center;
        }

        .filepond--root {
            width: 100%;
        }

        @media (min-width: 768px) {
            .filepond-wrapper {
                max-width: 500px;
            }
        }
    </style>
@endpush

@push('scripts')
    @php
        $existingImages = $property
            ? $property->getMedia('images')->map(function ($media) {
                return [
                    'source' => $media->getUrl('preview'),
                    'name' => $media->file_name,
                    'size' => $media->size,
                    'type' => $media->mime_type,
                ];
            })
            : collect();
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const existingImages = @json($existingImages);

            const pondOptions = {
                maxFiles: 20,
                maxFileSize: '2MB',
                allowMultiple: true,
                allowReorder: true,
                immediateUpload: false,
                storeAsFile: true,
                imagePreviewHeight: 150,
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'],
                labelIdle: 'Arraste e solte suas imagens ou <span class="filepond--label-action">Selecione</span>',
                files: existingImages.map(image => ({
                    source: image.source,
                    options: {
                        type: 'local',
                        file: {
                            name: image.name,
                            size: image.size,
                            type: image.type,
                        },
                        metadata: {
                            poster: image.source,
                        }
                    }
                }))
            };

            FilePond.create(document.querySelector('input.filepond'), pondOptions);
        });
    </script>
@endpush
