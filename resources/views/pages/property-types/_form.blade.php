<form method="POST" action="{{ $action }}" class="bg-white p-6 rounded-lg shadow-md space-y-4">
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
            class="w-auto rounded-md bg-blue-500 py-2 px-4 text-center font-semibold text-white shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition">
            Submeter
        </button>
    </div>
</form>

{{--  gerir estado da botão de submissão  --}}
<script>
    // ativar ou desativar o botão de submissão
    const initial = @json($propertyType ?? []);
    const nome = document.getElementById('name');
    const description = document.getElementById('description');
    const isActive = document.getElementById('is_active');
    const submitButton = document.getElementById('submit-button');
    const form = document.querySelector('form');

    function updateButtonState() {
        const nameChanged = nome.value.trim() !== initial.name;
        const descriptionChanged = description.value.trim() !== initial.description;
        const isActiveChanged = isActive.checked !== initial.is_active;

        submitButton.disabled = !nameChanged && !descriptionChanged && !isActiveChanged;
    }
    nome.addEventListener('input', updateButtonState);
    description.addEventListener('input', updateButtonState);
    isActive.addEventListener('change', updateButtonState);
</script>
