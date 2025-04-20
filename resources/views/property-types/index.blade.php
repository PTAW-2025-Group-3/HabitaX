@extends('layout.app')

@section('title', 'Tipos de Propriedades')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            <div class="mb-4">
                <a href="{{ route('admin.index') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Voltar para Dashboard
                </a>
            </div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-primary">Tipos de Propriedades</h2>
                <a href="{{ route('property-types.create') }}"
                   class="btn-primary px-4 py-2 rounded-lg flex items-center">
                    <i class="bi bi-plus-lg mr-2"></i>
                    Adicionar Tipo de Propriedade
                </a>
            </div>

            @if ($propertyTypes->isEmpty())
                <div class="bg-white p-6 rounded-lg shadow text-center text-gray">
                    Nenhum tipo de propriedade encontrado.
                </div>
            @else
                <!-- Tabela de tipos de propriedades -->
                <div class="overflow-x-auto rounded-xl shadow bg-white">
                    <table class="min-w-full text-sm">
                        <thead class="bg-blue-100 text-left">
                        <tr>
                            <th class="p-4">
                                <div class="flex items-center">
                                    Nome
                                </div>
                            </th>
                            <th class="p-4">
                                <div class="flex items-center">
                                    Atributos
                                </div>
                            </th>
                            <th class="p-4 text-center">
                                <div class="flex items-center justify-center">
                                    Ativo
                                </div>
                            </th>
                            <th class="p-4">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($propertyTypes as $propertyType)
                            <tr class="border-t hover:bg-gray-50 transition">
                                <td class="p-4 font-medium">{{ $propertyType->name }}</td>
                                <td class="p-4">
                                    @foreach ($propertyType->attributes as $attribute)
                                        <span
                                            class="inline-block px-2 py-1 mb-1 text-xs rounded-full font-semibold bg-gray-100 text-gray-600 mr-1">
                                                {{ $attribute->name }}
                                            </span>
                                    @endforeach
                                </td>
                                <td class="p-4 text-center">
                                    @if ($propertyType->is_active)
                                        <span
                                            class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-700">
                                                Sim
                                            </span>
                                    @else
                                        <span
                                            class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-gray-100 text-gray-600">
                                                Não
                                            </span>
                                    @endif
                                </td>
                                <td class="p-4 space-x-1">
                                    <a href="{{ route('property-types.edit', ['id' => $propertyType->id]) }}"
                                       class="btn-secondary text-xs px-2 py-1 inline-flex items-center">
                                        <i class="bi bi-pencil mr-1"></i> Editar
                                    </a>
                                    <a href="{{ route('property-types.attributes.edit', ['id' => $propertyType->id]) }}"
                                       class="btn-secondary text-xs px-2 py-1 inline-flex items-center">
                                        <i class="bi bi-gear mr-1"></i> Gerir Atributos
                                    </a>
                                    <button type="button"
                                            onclick="showDeleteModal('{{ $propertyType->id }}', '{{ $propertyType->name }}')"
                                            class="btn-warning text-xs px-2 py-1 inline-flex items-center">
                                        <i class="bi bi-trash mr-1"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="p-4" id="pagination-container">
                        {{ $propertyTypes->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    @include('components.delete-confirmation', [
    'itemType' => 'tipo de propriedade',
    'routeName' => route('property-types.destroy', ['id' => '__ID__'])
])
@endsection
