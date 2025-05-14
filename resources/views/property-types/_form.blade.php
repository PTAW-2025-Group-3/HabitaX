<form method="POST" action="{{ $action }}" class="bg-white p-6 rounded-lg shadow-md space-y-4" enctype="multipart/form-data">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    {{--  name  --}}
    <div class="flex flex-col">
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-primary">Nome</label>
            <input type="text" name="name" id="name" placeholder="Ex: Moradia"
                   value="{{ old('name', $propertyType->name ?? '') }}"
                   class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
        </div>
        @error('name')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    {{--   description   --}}
    <div class="flex flex-col">
        <div class="mb-4">
            <label for="description" class="block text-sm font-semibold text-primary">Descrição</label>
            <textarea name="description" id="description" placeholder="Ex: Unidade habitacional destinada a habitação."
                      class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">{{ old('description', $propertyType->description ?? '') }}</textarea>
        </div>
        @error('description')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    {{--  is_active  --}}
    <div class="flex flex-col">
        <div class="flex items-center mb-4">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', $propertyType->is_active ?? false) ? 'checked' : '' }}
                   class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary">
            <label for="is_active" class="ml-2 block text-sm font-semibold text-primary">Ativo</label>
        </div>
        @error('is_active')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    {{--  show on home  --}}
    <div class="flex flex-col">
        <div class="flex items-center mb-4">
            <input type="hidden" name="show_on_homepage" value="0">
            <input type="checkbox" name="show_on_homepage" id="show_on_homepage" value="1"
                   {{ old('show_on_homepage', $propertyType->show_on_homepage ?? false) ? 'checked' : '' }}
                   class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary">
            <label for="show_on_homepage" class="ml-2 block text-sm font-semibold text-primary">Mostrar na página inicial</label>
        </div>
        @error('show_on_homepage')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    {{--  icon  --}}
    <div class="flex flex-col">
        <label for="file" class="block text-sm font-semibold text-primary">Ícone (PNG, SVG)</label>
        <div class="mt-1 w-1/2">
            <input
                type="file"
                class="filepond"
                name="file"
                id="icon"
                accept="image/png, image/svg+xml, image/webp"
            />
            <div id="hidden-icon-input"></div>
        </div>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="relative mb-4 p-3 bg-red-50 text-xs sm:text-sm text-red-600 rounded-lg z-10">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="pt-4">
        <button
            type="submit" id="submit-button"
            class="btn-primary px-4 py-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
            Submeter
        </button>
    </div>
</form>

@push('styles')
    <style>
        .filepond--root {
            height: auto;
            max-width: 300px;
        }
    </style>
@endpush

@push('scripts')
    @php
        $existingImage = $propertyType?->getMedia('icon')->first();

        if ($existingImage) {
            $existingImage = [
                'source' => $existingImage->file_name,
                'name' => $existingImage->file_name,
                'size' => $existingImage->size,
                'type' => $existingImage->mime_type,
                'preview' => $existingImage->getUrl(),
            ];
        }
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hiddenContainer = document.getElementById('hidden-icon-input');
            let currentInput = null;

            const createHiddenInput = (filename) => {
                if (!currentInput) {
                    currentInput = document.createElement('input');
                    currentInput.type = 'hidden';
                    currentInput.name = 'uploaded_icon';
                    hiddenContainer.appendChild(currentInput);
                }

                currentInput.value = filename;
            };

            const removeHiddenInput = () => {
                if (!currentInput) {
                    currentInput = document.createElement('input');
                    currentInput.type = 'hidden';
                    currentInput.name = 'uploaded_icon';
                    hiddenContainer.appendChild(currentInput);
                }

                currentInput.value = '';
            };

            const pondOptions = {
                allowImageCrop: true,
                maxFileSize: '1MB',
                imageCropAspectRatio: '1:1',
                acceptedFileTypes: ['image/png', 'image/svg+xml', 'image/webp'],
                allowReplace: true,
                maxFiles: 1,
                labelIdle: 'Arraste e solte ou <span class="filepond--label-action">Selecione</span>',
                server: {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    process: {
                        url: '{{ route('uploads.process') }}',
                        method: 'POST',
                        onload: (response) => {
                            const filename = response.replace(/^["']+|["']+$/g, '');
                            createHiddenInput(filename);
                            return filename;
                        },
                        onerror: (err) => {
                            console.error('Erro ao carregar ícone:', err);
                        }
                    },
                    revert: {
                        url: '{{ route('uploads.revert') }}',
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        onload: removeHiddenInput
                    }
                },
                onremovefile: (error) => {
                    if (error) {
                        console.error('Erro ao remover arquivo:', error);
                    } else {
                        removeHiddenInput();
                    }
                },
                onerror: (error) => {
                    console.error('Erro ao carregar ícone:', error);
                }
            };

            const existingImage = @json($existingImage);
            if (existingImage) {
                createHiddenInput(existingImage.name);
                pondOptions.files = [{
                    source: existingImage.name,
                    options: {
                        type: 'local',
                        file: {
                            name: existingImage.name,
                            size: existingImage.size,
                            type: existingImage.type,
                        },
                        metadata: {
                            poster: existingImage.preview,
                        }
                    }
                }];
            }

            FilePond.create(document.querySelector('input.filepond'), pondOptions);
        });
    </script>
@endpush
