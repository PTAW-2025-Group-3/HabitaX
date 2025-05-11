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
            const existingImage = {!! isset($propertyType) && $propertyType->icon_path ? json_encode(Storage::url($propertyType->icon_path)) : 'null' !!};
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
