<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="flex items-center mb-6 border-b border-gray-100 pb-4">
        <i class="bi bi-building text-xl text-primary mr-3"></i>
        <h2 class="text-xl font-bold text-primary">Informação Base da Propriedade</h2>
    </div>

    <!-- Título -->
    <div class="transition-all duration-300 hover:shadow-md p-4 rounded-xl hover:bg-gray-50 mb-4">
        <label for="title" class="block text-sm font-semibold text-gray-secondary mb-3 flex items-center">
            <i class="bi bi-house-door mr-2 text-secondary"></i>
            Título da Propriedade
        </label>
        <input type="text" name="title" id="title"
               placeholder="ex., Apartamento T3 Moderno"
               value="{{ old('title', $property->title ?? '') }}"
               class="form-input focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
        @error('title')
        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    <!-- Descrição -->
    <div class="transition-all duration-300 hover:shadow-md p-4 rounded-xl hover:bg-gray-50 mb-4">
        <label for="description" class="block text-sm font-semibold text-gray-secondary mb-3 flex items-center">
            <i class="bi bi-file-text mr-2 text-secondary"></i>
            Descrição da Propriedade
        </label>
        <textarea name="description" id="description" rows="5"
                  placeholder="Descreva a propriedade em detalhe..."
                  class="form-input focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
        >{{ old('description', $property->description ?? '') }}</textarea> {{-- mesmo assim para evitar espaço vazio--}}
        @error('description')
        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
    </div>

    @if(!$property)
        <div class="transition-all duration-300 hover:shadow-md p-4 rounded-xl hover:bg-gray-50">
            <label for="property_type_id" class="block text-sm font-semibold text-gray-secondary mb-3 flex items-center">
                <i class="bi bi-house-gear mr-2 text-secondary"></i>
                Selecione o tipo de propriedade
            </label>
            <div class="relative dropdown-wrapper w-full sm:w-auto">
                <select name="property_type_id" id="property_type_id"
                        class="dropdown-select py-3 pl-4 pr-10 w-full text-base">
                    <option value="" disabled selected>Escolhe o tipo de imóvel</option>
                    @foreach($propertyTypes as $propertyType)
                        <option value="{{ $propertyType->id }}" {{ old('property_type_id', $selectedPropertyType ?? '') == $propertyType->id ? 'selected' : '' }}>
                            {{ $propertyType->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </div>
        </div>
    @else
        <div class="transition-all duration-300 hover:shadow-md p-4 rounded-xl hover:bg-gray-50 mb-4">
            <label class="block text-sm font-semibold text-gray-secondary mb-3 flex items-center">
                <i class="bi bi-house-gear mr-2 text-secondary"></i>
                Tipo da propriedade
            </label>
            <div class="flex items-center mb-4">
                <input type="hidden" name="property_type_id" value="{{ $property->property_type->id }}">
                <span>{{ $property->property_type->name }}</span>
                <span class="text-gray-500 ml-2">
                    @if($property->property_type->is_active)
                        <i class="bi bi-check-circle text-green-500"></i>
                    @else
                        <i class="bi bi-x-circle text-red-500"></i>
                    @endif
                </span>
            </div>
            {{--   edit property type   --}}
        </div>
    @endif
</div>
