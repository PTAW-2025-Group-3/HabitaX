<form method="POST" action="{{ $action }}" class="bg-white p-6 rounded-lg shadow-md space-y-4"
      enctype="multipart/form-data">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    {{--  name  --}}
    <div class="flex flex-col">
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-primary">Nome</label>
            <input type="text" name="name" id="name" placeholder="Ex: Moradia"
                   value="{{ old('name', $district->name ?? '') }}"
                   class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
        </div>
        @error('name')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

{{--    --}}{{--   description   --}}
{{--    <div class="flex flex-col">--}}
{{--        <div class="mb-4">--}}
{{--            <label for="description" class="block text-sm font-semibold text-primary">Descrição</label>--}}
{{--            <textarea name="description" id="description" placeholder="Ex: Unidade habitacional destinada a habitação."--}}
{{--                      class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">{{ old('description', $district->description ?? '') }}</textarea>--}}
{{--        </div>--}}
{{--        @error('description')--}}
{{--        <div class="text-red-500 text-sm mt-1">--}}
{{--            {{ $message }}--}}
{{--        </div>--}}
{{--        @enderror--}}
{{--    </div>--}}

    {{--  is_active  --}}
    <div class="flex flex-col">
        <div class="flex items-center mb-4">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', $district->is_active ?? false) ? 'checked' : '' }}
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
                   {{ old('show_on_homepage', $district->show_on_homepage ?? false) ? 'checked' : '' }}
                   class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary">
            <label for="show_on_homepage" class="ml-2 block text-sm font-semibold text-primary">Mostrar na página
                inicial</label>
        </div>
        @error('show_on_homepage')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    {{--  Images  --}}
    <div class="flex flex-col">
        <label for="file" class="block text-sm font-semibold text-primary">Ícone (PNG, SVG)</label>
        <div class="mt-1 w-1/2">
            <input
                type="file"
                class="filepond"
                name="file"
                id="images"
                accept="image/png, image/jpeg, image/jpg, image/webp"
            />
            <div id="hidden-images-input"></div>
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
            max-width: 500px;
        }
    </style>
@endpush

@push('scripts')
    @php
        $existingImages = $district
            ? $district->getMedia('images')->map(function ($media) {
                return [
                    'source' => $media->file_name,
                    'name' => $media->file_name,
                    'size' => $media->size,
                    'type' => $media->mime_type,
                    'preview' => $media->getUrl(),
                ];
            })
            : collect();
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const existingImages = @json($existingImages);
            const hiddenContainer = document.getElementById('hidden-images-input');

            const createHiddenInput = (filename, preview = null) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'uploaded_images[]';
                input.value = filename;
                if (preview) {
                    input.dataset.preview = preview;
                }
                hiddenContainer.appendChild(input);
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
                maxFiles: 5,
                maxFileSize: '1MB',
                allowMultiple: true,
                allowReorder: true,
                imageCropAspectRatio: '1:1',
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'],
                labelIdle: 'Arraste e solte ou <span class="filepond--label-action">Selecione</span>',
                files: existingImages.map(image => {
                    createHiddenInput(image.name, image.preview);

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
                        url: '{{ route('uploads.process') }}',
                        method: 'POST',
                        onload: (response) => {
                            const filename = response.replace(/^["']+|["']+$/g, '');
                            createHiddenInput(filename);
                            return filename;
                        },
                        onerror: (error) => {
                            console.error('Erro ao carregar:', error);
                        }
                    },
                    revert: {
                        url: '{{ route('uploads.revert') }}',
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }
                },
                onreorderfiles: (files) => {
                    hiddenContainer.innerHTML = '';

                    files.forEach(file => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'uploaded_images[]';
                        input.value = file.serverId || file.source || file.file?.name;
                        hiddenContainer.appendChild(input);
                    });

                    console.log('Images reordered:', files.map(f => f.serverId || f.source));
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
                    console.error('Erro ao carregar:', error);
                }
            };

            FilePond.create(document.querySelector('input.filepond'), pondOptions);
        });
    </script>
@endpush
