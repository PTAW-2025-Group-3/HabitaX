@extends('account.account-layout')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-primary">Editar Anúncio</h2>

    <form method="POST" action="{{ route('advertisements.update', $advertisement->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Título</label>
            <input type="text" name="title" value="{{ old('title', $advertisement->title) }}" class="form-input w-full" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Descrição</label>
            <textarea name="description" rows="5" class="form-textarea w-full" required>{{ old('description', $advertisement->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Preço (€)</label>
            <input type="number" name="price" value="{{ old('price', $advertisement->price) }}" class="form-input w-full" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Tipo de Transação</label>
            <select name="transaction_type" class="form-select w-full" required>
                <option value="sale" {{ old('transaction_type', $advertisement->transaction_type) === 'sale' ? 'selected' : '' }}>Venda</option>
                <option value="rent" {{ old('transaction_type', $advertisement->transaction_type) === 'rent' ? 'selected' : '' }}>Arrendamento</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Propriedade</label>
            <select name="property_id" class="form-select w-full" required>
                @foreach($properties as $property)
                    <option value="{{ $property->id }}" {{ $advertisement->property_id == $property->id ? 'selected' : '' }}>
                        {{ $property->title ?? 'Propriedade #' . $property->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-primary px-6 py-2">
                Atualizar Anúncio
            </button>
        </div>
    </form>
</div>
@endsection
