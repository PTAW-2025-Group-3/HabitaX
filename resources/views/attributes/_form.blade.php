<form method="POST" action="{{ $action }}" class="bg-white p-6 rounded-lg shadow-md space-y-4">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="name" class="block text-sm font-semibold text-primary">Nome</label>
            <input type="text" name="name" id="name" placeholder="Ex: Tamanho"
                   value="{{ old('name', $attribute->name ?? '') }}"
                   class="form-input">
        </div>
        <div class="relative dropdown-wrapper w-full sm:w-auto">
            <label for="type" class="block text-sm font-semibold text-primary mb-1">Tipo</label>
            <select
                name="type"
                id="type"
                class="dropdown-select py-2 pl-4 pr-10 w-full h-10">
                <option value="" disabled selected>Selecione o tipo</option>
                @foreach ($attributeTypes as $type)
                    <option value="{{ $type->value }}"
                        @selected(old('type', $attribute->type->value ?? '') === $type->value)>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 pt-5 text-gray">
                <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
            </div>
        </div>

    @if(($attribute->type ?? '') === 'number')
            <div>
                <label for="unit" class="block text-sm font-semibold text-primary">Unidade</label>
                <input type="text" name="unit" id="unit"
                       value="{{ old('unit', $attribute->unit ?? '') }}"
                       placeholder="Ex: cm, kg"
                       class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
            </div>
            <div></div>
        @endif
        <div class="flex items-center mt-6">
            <input type="checkbox" name="required" id="required" value="1"
                   @checked(old('required', $attribute->is_required ?? false))
                   class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
            <label for="required" class="ml-2 text-sm text-primary">Obrigatório</label>
        </div>
        <div class="flex items-center mt-6">
            <input type="checkbox" name="active" id="active" value="1"
                   @checked(old('active', $attribute->is_active ?? false))
                   class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
            <label for="active" class="ml-2 text-sm text-primary">Ativo</label>
        </div>
    </div>
    <div class="pt-4">
        <button type="submit"
                class="btn-primary w-full py-2 px-4 hover:scale-100">
            {{ $buttonText }}
        </button>
    </div>
    @if ($errors->any())
        <div class="mt-4">
            <ul class="list-disc pl-5 text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>
