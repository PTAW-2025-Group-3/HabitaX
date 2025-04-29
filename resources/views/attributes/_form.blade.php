@php use App\Enums\AttributeType;use Carbon\Carbon;@endphp
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
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="relative dropdown-wrapper w-full sm:w-auto">
            <label for="type" class="block text-sm font-semibold text-primary mb-1">Tipo</label>
            <select
                name="type"
                id="type"
                class="dropdown-select py-2 pl-4 pr-10 w-full h-10"
                @isset($attribute) disabled @endisset>
                <option value="" disabled selected>Selecione o tipo</option>
                @foreach ($attributeTypes as $type)
                    <option value="{{ $type->value }}"
                        @selected(old('type', $attribute->type->value ?? '') === $type->value)>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @empty($attribute)
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 pt-5 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            @endempty
            @error('type')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="md:col-span-2">
            <label for="description" class="block text-sm font-semibold text-primary">Descrição</label>
            <textarea name="description" id="description"
                      placeholder="Ex: Certificado elétrico é um documento que avalia a eficiência energética de um imóvel numa escala de A+ (muito eficiente) a F (pouco eficiente)."
                      class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">{{ old('description', $attribute->description ?? '') }}</textarea>
            @error('description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        {{--   Apenas para os tipos numeros   --}}
        <div id="number-fields" class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4 hidden">
            <div>
                <label for="min_value" class="block text-sm font-semibold text-primary">Valor mínimo</label>
                <input type="number" name="min_value" id="min_value"
                       value="{{ old('min_value', $attribute->min_value ?? '') }}"
                       placeholder="Ex: 0"
                       class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
                @error('min_value')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="max_value" class="block text-sm font-semibold text-primary">Valor máximo</label>
                <input type="number" name="max_value" id="max_value"
                       value="{{ old('max_value', $attribute->max_value ?? '') }}"
                       placeholder="Ex: 100"
                       class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
                @error('max_value')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="unit" class="block text-sm font-semibold text-primary">Unidade</label>
                <input type="text" name="unit" id="unit"
                       value="{{ old('unit', $attribute->unit ?? '') }}"
                       placeholder="Ex: m², kg, etc."
                       class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
                @error('unit')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        {{--   Apenas para os tipo texto   --}}
        <div id="text-fields" class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 hidden">
            <div>
                <label for="min_length" class="block text-sm font-semibold text-primary">Minimo de caracteres</label>
                <input type="number" name="min_length" id="min_length"
                       value="{{ old('min_length', $attribute->min_length ?? '') }}"
                       placeholder="Ex: 0"
                       class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
                @error('min_length')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="max_length" class="block text-sm font-semibold text-primary">Máximo de caracteres</label>
                <input type="number" name="max_length" id="max_length"
                       value="{{ old('max_length', $attribute->max_length ?? '') }}"
                       placeholder="Ex: 100"
                       class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
                @error('max_length')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        {{--   Apenas para o tipo escolha multipla   --}}
        <div id="multiple-choice-fields" class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 hidden">
            <div>
                <label for="min_options" class="block text-sm font-semibold text-primary">Mínimo de opções</label>
                <input type="number" name="min_options" id="min_options"
                       value="{{ old('min_options', $attribute->min_options ?? '') }}"
                       placeholder="Ex: 1"
                       class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
                @error('min_options')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="max_options" class="block text-sm font-semibold text-primary">Máximo de opções</label>
                <input type="number" name="max_options" id="max_options"
                       value="{{ old('max_options', $attribute->max_options ?? '') }}"
                       placeholder="Ex: 3"
                       class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
                @error('max_options')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        {{--   Apenas para o tipo data  --}}
        <div id="date-fields" class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4 hidden">
            <div>
                <label for="min_date" class="block text-sm font-semibold text-primary">Data mínima</label>
                <input type="date" name="min_date" id="min_date"
                       value="{{ old('min_date', isset($attribute->min_date) ? Carbon::parse($attribute->min_date)->format('Y-m-d') : '') }}"
                       class="form-input">
                @error('min_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="max_date" class="block text-sm font-semibold text-primary">Data máxima</label>
                <input type="date" name="max_date" id="max_date"
                       value="{{ old('max_date', isset($attribute->max_date) ? Carbon::parse($attribute->max_date)->format('Y-m-d') : '') }}"
                       class="form-input">
                @error('max_date')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="md:col-span-2 gap-4">
            <div class="flex items-center mt-6">
                <input type="checkbox" name="is_required" id="is_required" value="1"
                       @checked(old('is_required', $attribute->is_required ?? false))
                       class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                <label for="is_required" class="ml-2 text-sm text-primary">Obrigatório</label>
                @error('is_required')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center mt-6">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                       @checked(old('is_active', $attribute->is_active ?? true))
                       class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                <label for="is_active" class="ml-2 text-sm text-primary">Ativo</label>
                @error('is_active')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="md:col-span-2">
        <button type="submit" class="btn-primary px-4 py-2 rounded-lg flex items-center">
            {{ $buttonText }}
        </button>
    </div>
</form>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = $('#type');
            const numberFields = $('#number-fields');
            const textFields = $('#text-fields');
            const dateFields = $('#date-fields');
            const multipleChoiceFields = $('#multiple-choice-fields');
            const fields = [numberFields, textFields, multipleChoiceFields, dateFields];

            function toggleFieldVisibility(fieldToShow, fields) {
                fields.forEach(field => {
                    if (field === fieldToShow) {
                        field.removeClass('hidden');
                    } else {
                        field.addClass('hidden');
                    }
                });
            }
            function toggleFields() {
                const selectedType = typeSelect.val();
                switch (selectedType) {
                    case '{{ AttributeType::INT->value }}':
                    case '{{ AttributeType::FLOAT->value }}':
                        toggleFieldVisibility(numberFields, fields);
                        break;
                    case '{{ AttributeType::TEXT->value }}':
                    case '{{ AttributeType::LONG_TEXT->value }}':
                        toggleFieldVisibility(textFields, fields);
                        break;
                    case '{{ AttributeType::SELECT_MULTIPLE->value }}':
                        toggleFieldVisibility(multipleChoiceFields, fields);
                        break;
                    case '{{ AttributeType::DATE->value }}':
                        toggleFieldVisibility(dateFields, fields);
                        break;
                    default:
                        toggleFieldVisibility(null, fields);
                        break;
                }
            }
            function changeStep() {
                const selectedType = typeSelect.val();
                if (selectedType === '{{ AttributeType::INT->value }}') {
                    $('#min_value').attr('step', '1');
                    $('#max_value').attr('step', '1');
                } else if (selectedType === '{{ AttributeType::FLOAT->value }}') {
                    $('#min_value').attr('step', '0.01');
                    $('#max_value').attr('step', '0.01');
                }
            }

            toggleFields();
            typeSelect.on('change', toggleFields);
            typeSelect.on('change', changeStep);
        });
    </script>

@endpush
