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
                   class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
        </div>
        <div>
            <label for="type" class="block text-sm font-semibold text-primary">Tipo</label>
            <select name="type" id="type"
                    class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
                <option value="" disabled selected>Selecione o tipo</option>
                @foreach ($attributeTypes as $type)
                    <option value="{{ $type->value }}"
                        @selected(old('type', $attribute->type->value ?? '') === $type->value)>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
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
                class="w-full rounded-md bg-primary py-2 px-4 text-center font-semibold text-white shadow hover:bg-primary-dark transition">
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
