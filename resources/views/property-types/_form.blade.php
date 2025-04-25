<form method="POST" action="{{ $action }}" class="bg-white p-6 rounded-lg shadow-md space-y-4" enctype="multipart/form-data">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    {{--  name  --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="name" class="block text-sm font-semibold text-primary">Nome</label>
            <input type="text" name="name" id="name" placeholder="Ex: Moradia"
                   value="{{ old('name', $propertyType->name ?? '') }}"
                   class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
        </div>
    </div>

    {{--   description   --}}
    <div>
        <label for="description" class="block text-sm font-semibold text-primary">Descrição</label>
        <textarea name="description" id="description" placeholder="Ex: Unidade habitacional destinada a habitação."
                  class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">{{ old('description', $propertyType->description ?? '') }}</textarea>
    </div>

    {{--  is_active  --}}
    <div class="flex items-center">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" id="is_active" value="1"
               {{ old('is_active', $propertyType->is_active ?? false) ? 'checked' : '' }}
               class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary">
        <label for="is_active" class="ml-2 block text-sm font-semibold text-primary">Ativo</label>
    </div>

    {{--  icon  --}}
    <div>
        <label for="icon" class="block text-sm font-semibold text-primary">Ícone (PNG, SVG)</label>
        @if (isset($propertyType) && $propertyType->icon_path)
            <div class="mt-2">
                <img id="icon-preview" src="{{ Storage::url($propertyType->icon_path) }}" alt="{{ $propertyType->name }} Icon"
                     class="w-8 h-8 md:w-10 md:h-10 rounded-full">
            </div>
        @else
            <div class="mt-2">
                <img id="icon-preview" src="#" alt="Preview" class="w-8 h-8 md:w-10 md:h-10 rounded-full hidden">
            </div>
        @endif
        <input type="file" name="icon" id="icon" accept=".svg,.png,.jpg,.jpeg,.webp"
               class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
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
            type="submit" id="submit-button" disabled
            class="btn-primary px-4 py-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
            Submeter
        </button>
    </div>
</form>

{{--  gerir estado da botão de submissão  --}}
<script>
    $(document).ready(function () {
        // ativar ou desativar o botão de submissão
        const initial = @json($propertyType ?? []);
        const nome = document.getElementById('name');
        const description = document.getElementById('description');
        const isActive = document.getElementById('is_active');
        const iconInput = document.getElementById('icon');
        const iconPreview = document.getElementById('icon-preview');
        const submitButton = document.getElementById('submit-button');

        function updateButtonState() {
            const nameChanged = nome.value.trim() !== initial.name;
            const descriptionChanged = description.value.trim() !== initial.description;
            const isActiveChanged = isActive.checked !== initial.is_active;
            const iconChanged = iconInput.files.length > 0;

            submitButton.disabled = !nameChanged && !descriptionChanged && !isActiveChanged && !iconChanged;
        }

        nome.addEventListener('input', updateButtonState);
        description.addEventListener('input', updateButtonState);
        isActive.addEventListener('change', updateButtonState);
        iconInput.addEventListener('change', updateButtonState);
        iconInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    iconPreview.src = e.target.result;
                    iconPreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
