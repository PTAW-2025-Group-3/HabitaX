<form action="{{ $action }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4" enctype="multipart/form-data">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    {{-- Title --}}
    <div class="mb-6">
        <label for="title" class="block text-base font-medium text-gray-700 mb-2">Título</label>
        <input type="text" id="title" name="title"
               value="{{ old('title', $advertisement->title ?? '') }}"
               class="w-full px-5 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base" required>
        @error('title')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    {{-- Description --}}
    <div class="mb-6">
        <label for="description" class="block text-base font-medium text-gray-700 mb-2">Descrição</label>
        <textarea id="description" name="description" rows="5"
                  class="w-full px-5 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base"
                  required>{{ old('description', $advertisement->description ?? '') }}</textarea>
        @error('description')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    {{-- Price --}}
    <div class="mb-6">
        <label for="price" class="block text-base font-medium text-gray-700 mb-2">Preço (€)</label>
        <input type="number" id="price" name="price"
               value="{{ old('price', $advertisement->price ?? '') }}"
               class="w-full px-5 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base" required>
        @error('price')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    {{-- Transaction Type --}}
    <div class="mb-6">
        <label for="transaction_type" class="block text-base font-medium text-gray-700 mb-2">Tipo de Transação</label>
        <select name="transaction_type" id="transaction_type"
                class="w-full px-5 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base" required>
            <option value="sale" {{ old('transaction_type', $advertisement->transaction_type ?? '') === 'sale' ? 'selected' : '' }}>Venda</option>
            <option value="rent" {{ old('transaction_type', $advertisement->transaction_type ?? '') === 'rent' ? 'selected' : '' }}>Aluguel</option>
        </select>
        @error('transaction_type')
        <div class="text-red-500 text-sm mt-1">
            {{ $message }}
        </div>
        @enderror
    </div>

    {{-- Property --}}
    <div class="mb-6">
        <label for="property_id" class="block text-base font-medium text-gray-700 mb-2">Selecionar Imóvel</label>
        <select name="property_id" id="property_id"
                class="w-full px-5 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base" required>
            @foreach($properties as $property)
                <option value="{{ $property->id }}" {{ old('property_id', $advertisement->property_id ?? '') == $property->id ? 'selected' : '' }}>
                    {{ $property->title }}
                </option>
            @endforeach
        </select>
    </div>
    @error('property_id')
    <div class="text-red-500 text-sm mt-1">
        {{ $message }}
    </div>
    @enderror

    {{-- Submit --}}
    <div class="md:col-span-2">
        <button type="submit" class="btn-primary px-4 py-2 rounded-lg flex items-center">
            {{ $buttonText }}
        </button>
    </div>
</form>
