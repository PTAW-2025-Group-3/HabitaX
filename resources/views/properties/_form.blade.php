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
        <p class="text-sm text-gray-500 mb-4">
            Carrega aqui as imagens da propriedade.
            As 5 primeiras aparecem em destaque no anúncio — escolhe as melhores!
            Podes arrastar as fotos para mudar a ordem.
        </p>
        <div class="filepond-wrapper w-full">
            <input
                type="file"
                class="filepond"
                name="file"
{{--                id="images"--}}
                multiple
            />
        </div>
        <div id="hidden-uploaded-inputs"></div>
        <p class="text-xs text-gray-400 mb-4">
            Formatos aceites: JPG, JPEG, PNG |
            Tamanho máximo: 5MB |
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
    <div class="flex justify-end space-x-3">
        <a href="{{ route('properties.my') }}" class="btn-warning px-5 py-2.5 rounded-md">
            Cancelar
        </a>
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
            object-fit: contain;
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
                    'source' => $media->file_name,
                    'name' => $media->file_name,
                    'size' => $media->size,
                    'type' => $media->mime_type,
                    'preview' => $media->getUrl('preview'),
                ];
            })
            : collect();
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const existingImages = @json($existingImages);
            const uploadedInputs = document.getElementById('hidden-uploaded-inputs');

            const createHiddenInput = (filename, preview = null) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'uploaded_images[]';
                input.value = filename;
                if (preview) {
                    input.dataset.preview = preview;
                }
                uploadedInputs.appendChild(input);
            };

            const removeHiddenInputByName = (name) => {
                const inputs = document.querySelectorAll('input[name="uploaded_images[]"]');
                for (const input of inputs) {
                    if (input.value === name) {
                        input.remove();
                        console.log('Removed input for name:', name);
                        return;
                    }
                }
                console.warn('No input found for name:', name);
            };

            const pondOptions = {
                maxFiles: 20,
                maxFileSize: '5MB',
                allowMultiple: true,
                allowReorder: true,
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'],
                labelIdle: 'Arraste e solte suas imagens ou <span class="filepond--label-action">Selecione</span>',

                files: existingImages.map(image => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'uploaded_images[]';
                    input.value = image.name;
                    uploadedInputs.appendChild(input);

                    return {
                        source: image.name,
                        options: {
                            type: 'local',
                            file: {
                                name: image.name,
                                size: image.size,
                                type: image.type,
                            },
                            metadata: {
                                poster: image.preview,
                            }
                        }
                    };
                }),
                server: {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    process: {
                        url: '/uploads/process',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        onload: (response) => {
                            const filename = response.replace(/^["']+|["']+$/g, '');
                            createHiddenInput(filename);
                            return filename;
                        },
                        onerror: (error) => {
                            console.error('Upload failed:', error);
                        },
                    },
                    revert: {
                        url: '/uploads/revert',
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    },
                },
                onreorderfiles: (files) => {
                    uploadedInputs.innerHTML = '';

                    files.forEach(file => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'uploaded_images[]';
                        input.value = file.serverId || file.source || file.file?.name;
                        uploadedInputs.appendChild(input);
                    });

                    console.log('Files reordered:', files.map(f => f.serverId || f.source));
                },
                onremovefile: (error, file) => {
                    const name = file?.file?.name;
                    if (name) {
                        removeHiddenInputByName(name);
                    } else {
                        console.warn('No valid identifier to remove hidden input');
                    }
                },
                onerror: (error) => {
                    console.error('Upload failed:', error);
                },

            };

            FilePond.create(document.querySelector('input.filepond'), pondOptions);
        });
    </script>
@endpush
