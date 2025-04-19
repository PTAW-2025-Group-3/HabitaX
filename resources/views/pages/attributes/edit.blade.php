@extends('layout.app')

@section('title', 'Edit Attribute')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Attribute</h1>
    <div class="mb-4">
        <a href="{{ route('attributes.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back to Attributes</a>
    </div>
    <form method="POST" action="{{ route('attributes.update', ['id' => $attribute->id]) }}" class="bg-white p-6 rounded-lg shadow-md space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-semibold text-primary">Nome</label>
                <input type="text" name="name" id="name" placeholder="Ex: Tamanho"
                       value="{{ old('name', $attribute->name) }}"
                       class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
            </div>
            <div>
                <label for="type" class="block text-sm font-semibold text-primary">Tipo</label>
                <input type="text" id="type" value="{{ ucfirst($attribute->type) }}"
                       disabled
                       class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 bg-gray-100 text-gray-500">
                <input type="hidden" name="type" value="{{ $attribute->type }}">
            </div>
            @if($attribute->type === 'number')
                <div>
                    <label for="unit" class="block text-sm font-semibold text-primary">Unidade</label>
                    <input type="text" name="unit" id="unit"
                           value="{{ old('unit', $attribute->unit) }}"
                           placeholder="Ex: cm, kg"
                           class="mt-1 w-full rounded-md border border-gray-300 px-4 py-2 focus:border-primary focus:ring-primary">
                </div>
            @endif
            <div class="flex items-center mt-6">
                <input type="checkbox" name="required" id="required" value="1"
                       @checked(old('required', $attribute->required))
                       class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                <label for="required" class="ml-2 text-sm text-primary">Obrigatório</label>
            </div>
            <div class="flex items-center mt-6">
                <input type="checkbox" name="active" id="active" value="1"
                       @checked(old('active', $attribute->active))
                       class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                <label for="active" class="ml-2 text-sm text-primary">Ativo</label>
            </div>
        </div>
        <div class="pt-4">
            <button type="submit"
                    class="w-full rounded-md bg-primary py-2 px-4 text-center font-semibold text-white shadow hover:bg-primary-dark transition">
                Atualizar Atributo
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
</div>
@endsection
