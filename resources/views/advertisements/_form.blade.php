<form action="{{ $action }}" method="POST" class="bg-white rounded-xl shadow-lg p-6 animate-fade-in max-w-7xl mx-auto" enctype="multipart/form-data">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <div class="space-y-6">
        <div class="border-b border-gray-200 pb-4 mb-5">
            <h2 class="text-2xl font-bold text-primary">{{ isset($advertisement) ? 'Editar Anúncio' : 'Criar Anúncio' }}</h2>
            <p class="text-gray-600 mt-1">Preencha os detalhes do seu anúncio abaixo</p>
        </div>

        {{-- Title --}}
        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
            <input type="text" id="title" name="title"
                   value="{{ old('title', $advertisement->title ?? '') }}"
                   placeholder="Digite um título atrativo para o seu anúncio"
                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary transition-colors" required>
            @error('title')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
            <textarea id="description" name="description" rows="5"
                      placeholder="Descreva detalhadamente o seu imóvel"
                      class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary transition-colors"
                      required>{{ old('description', $advertisement->description ?? '') }}</textarea>
            @error('description')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Grid para campos side-by-side --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Price --}}
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Preço (€)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500">€</span>
                    </div>
                    <input type="number" id="price" name="price"
                           value="{{ old('price', $advertisement->price ?? '') }}"
                           placeholder="0.00"
                           class="w-full pl-8 px-4 py-3 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary transition-colors"
                           required>
                </div>
                @error('price')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Transaction Type --}}
            <div>
                <label for="transaction_type" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Transação</label>
                <select name="transaction_type" id="transaction_type"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary transition-colors" required>
                    <option value="" disabled selected>Selecione o tipo de transação</option>
                    <option value="sale" {{ old('transaction_type', $advertisement->transaction_type ?? '') === 'sale' ? 'selected' : '' }}>Venda</option>
                    <option value="rent" {{ old('transaction_type', $advertisement->transaction_type ?? '') === 'rent' ? 'selected' : '' }}>Aluguel</option>
                </select>
                @error('transaction_type')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Property --}}
        <div class="mb-6">
            <label for="property_id" class="block text-sm font-medium text-gray-700 mb-1">Selecionar Imóvel</label>
            <select name="property_id" id="property_id"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary transition-colors" required>
                <option value="" disabled {{ old('property_id', $advertisement->property_id ?? '') ? '' : 'selected' }}>Selecione um imóvel</option>
                @foreach($properties as $property)
                    <option value="{{ $property->id }}" {{ old('property_id', $advertisement->property_id ?? '') == $property->id ? 'selected' : '' }}>
                        {{ $property->title }}
                    </option>
                @endforeach
            </select>
            @if(count($properties) === 0)
                <p class="text-amber-600 text-xs mt-1">Você não tem imóveis cadastrados. <a href="{{ route('properties.create') }}" class="text-primary underline">Cadastre um imóvel primeiro</a>.</p>
            @endif
            @error('property_id')
            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Footer com botões --}}
        <div class="pt-5 border-t border-gray-200 flex justify-end space-x-3">
            <a href="{{ route('advertisements.my') }}" class="btn-warning px-5 py-2.5">
                Cancelar
            </a>
            <button type="submit" class="btn-primary px-5 py-2.5 rounded-lg">
                {{ $buttonText }}
            </button>
        </div>
    </div>
</form>
