<form action="{{ $action }}" method="POST" class="max-w-4xl mx-auto space-y-10" enctype="multipart/form-data">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <h1 class="text-2xl font-bold mb-6">Criar Anúncio</h1>
    <div class="bg-white shadow-2xl rounded-2xl p-10 border border-gray-200 animate-fade-in">
        <div class="flex items-center gap-3 mb-8 border-b pb-4 border-gray-100">
            <i class="bi bi-megaphone text-2xl text-indigo-600"></i>
            <h2 class="text-2xl font-extrabold text-indigo-600">Informações do Anúncio</h2>
        </div>

        {{-- Title --}}
        <div class="mb-6">
            <label for="title" class="block text-base font-medium text-gray-700 mb-2">Título</label>
            <input type="text" id="title" name="title"
                   value="{{ old('title', $advertisement->title ?? '') }}"
                   class="w-full px-5 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base" required>
        </div>

        {{-- Description --}}
        <div class="mb-6">
            <label for="description" class="block text-base font-medium text-gray-700 mb-2">Descrição</label>
            <textarea id="description" name="description" rows="5"
                      class="w-full px-5 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base"
                      required>{{ old('description', $advertisement->description ?? '') }}</textarea>
        </div>

        {{-- Price --}}
        <div class="mb-6">
            <label for="price" class="block text-base font-medium text-gray-700 mb-2">Preço (€)</label>
            <input type="number" id="price" name="price"
                   value="{{ old('price', $advertisement->price ?? '') }}"
                   class="w-full px-5 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base" required>
        </div>

        {{-- Transaction Type --}}
        <div class="mb-6">
            <label for="transaction_type" class="block text-base font-medium text-gray-700 mb-2">Tipo de Transação</label>
            <select name="transaction_type" id="transaction_type"
                    class="w-full px-5 py-3 rounded-xl border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-base" required>
                <option value="sale" {{ old('transaction_type', $advertisement->transaction_type ?? '') === 'sale' ? 'selected' : '' }}>Venda</option>
                <option value="rent" {{ old('transaction_type', $advertisement->transaction_type ?? '') === 'rent' ? 'selected' : '' }}>Aluguel</option>
            </select>
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
    </div>

    {{-- Submit --}}
    <div class="mt-8 flex justify-end">
        <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white text-base font-semibold px-8 py-3 rounded-xl shadow-lg transition-all">
            {{ $buttonText ?? 'Publicar Anúncio' }}
        </button>
    </div>    
</form>
