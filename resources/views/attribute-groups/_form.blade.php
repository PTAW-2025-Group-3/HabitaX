<form action="{{ $action }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4" enctype="multipart/form-data">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    {{--  name  --}}
    <div>
        <label for="name" class="block text-sm font-semibold text-primary">Nome</label>
        <input type="text" name="name" id="name" placeholder="Ex: Area"
               value="{{ old('name', $group->name ?? '') }}"
               class="form-input">
        @error('name')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    {{--  is_active  --}}
    <div class="flex flex-col">
        <div class="flex items-center mb-4">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', $group->is_active ?? false) ? 'checked' : '' }}
                   class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary">
            <label for="is_active" class="ml-2 block text-sm font-semibold text-primary">Ativo</label>
        </div>
        @error('is_active')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>
    {{--  description  --}}
    <div class="flex flex-col md:col-span-2">
        <div class="mb-4">
            <label for="description" class="block text-sm font-semibold text-primary">Descrição</label>
            <textarea name="description" id="description" placeholder="Ex: Atributos relacionados a área."
                      class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">{{ old('description', $group->description ?? '') }}</textarea>
        </div>
        @error('description')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>
    {{--  icon  --}}
    <div>
        <label for="icon" class="block text-sm font-semibold text-primary">Ícone (PNG, SVG)</label>
        <div class="mt-1 w-1/2">
            <input
                type="file"
                class="filepond"
                name="icon"
                id="icon"
                accept="image/png, image/svg+xml, image/webp"
            />
        </div>
        @error('icon')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="md:col-span-2">
        <button type="submit" class="btn-primary px-4 py-2 rounded-lg flex items-center">
            {{ $buttonText }}
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pondOptions = {
                instantUpload: false,
                storeAsFile: true,
                allowReplace: true,
                allowImageCrop: true,
                imageCropAspectRatio: '1:1',
                acceptedFileTypes: ['image/png', 'image/svg+xml', 'image/webp'],
                labelIdle: 'Arraste e solte ou <span class="filepond--label-action">Selecione</span>',
            };
            const existingImage = {!! isset($group) && $group->icon_path ? json_encode(Storage::url($group->icon_path)) : 'null' !!};
            if (existingImage) {
                pondOptions.files = [{
                    source: existingImage,
                    options: {
                        type: 'local',
                        file: {
                            name: existingImage.split('/').pop(),
                            size: existingImage.length,
                            type: existingImage.split('.').pop(),
                        },
                        metadata: {
                            poster: existingImage
                        }
                    }
                }];
            }
            FilePond.create(document.querySelector('input.filepond'), pondOptions);
        });
    </script>
@endpush
