@extends('layout.app')

@section('title', 'Tipos de Propriedades')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tipos de Propriedades</h1>
    <div class="mb-4">
        <a href="{{ route('property-types.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Adicionar Tipo de Propriedade</a>
    </div>
    @if ($propertyTypes->isEmpty())
        <p>Nenhum tipo de propriedade encontrado.</p>
    @else
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Nome</th>
                    <th class="border px-4 py-2">Atributos</th>
                    <th class="border px-4 py-2">Ativo</th>
                    <th class="border px-4 py-2">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($propertyTypes as $propertyType)
                    <tr>
                        <td class="border px-4 py-2">{{ $propertyType->name }}</td>
                        <td class="border px-4 py-2">
                            @foreach ($propertyType->attributes as $attribute)
                                <span class="inline-block bg-gray-200 text-gray-700 rounded-full px-3 py-1 text-sm font-semibold mr-2 mb-2">
                                    {{ $attribute->name }}
                                </span>
                            @endforeach
                        </td>
                        <td class="border px-4 py-2">
                            <input type="checkbox" disabled {{ $propertyType->is_active ? 'checked' : '' }}>
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('property-types.edit', ['id' => $propertyType->id]) }}" class="text-blue-500">Editar</a>
                            |
                            <a href="{{ route('property-types.attributes.edit', ['id' => $propertyType->id]) }}" class="text-blue-500">Gerir Atributos</a>
                            |
                            <form action="{{ route('property-types.destroy', ['id' => $propertyType->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
