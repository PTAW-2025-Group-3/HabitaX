@extends('layout.app')

@section('title', 'Atributos')

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
                <h2 class="text-xl font-bold text-primary">Atributos</h2>
                <a href="{{ route('attributes.create') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center">
                    <i class="bi bi-plus-lg mr-2"></i>
                    Adicionar Atributo
                </a>
            </div>

            @if ($attributes->isEmpty())
                <div class="bg-white p-6 rounded-lg shadow text-center text-gray">
                    Nenhum atributo encontrado.
                </div>
            @else
                <!-- Tabela de atributos -->
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
                                        Tipo de Valor
                                    </div>
                                </th>
                                <th class="p-4 text-center">
                                    <div class="flex items-center justify-center">
                                        Ativo
                                    </div>
                                </th>
                                <th class="p-4 text-center">
                                    <div class="flex items-center justify-center">
                                        Obrigatório
                                    </div>
                                </th>
                                <th class="p-4">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($attributes as $attribute)
                                <tr class="border-t hover:bg-gray-50 transition">
                                    <td class="p-4 font-medium">{{ $attribute->name }}</td>
                                    <td class="p-4 text-gray-600">{{ $attribute->type }}</td>
                                    <td class="p-4 text-center">
                                        @if ($attribute->is_active)
                                            <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-700">
                                                Sim
                                            </span>
                                        @else
                                            <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-gray-100 text-gray-600">
                                                Não
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        @if ($attribute->is_required)
                                            <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-blue-100 text-blue-700">
                                                Sim
                                            </span>
                                        @else
                                            <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-gray-100 text-gray-600">
                                                Não
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 space-x-1">
                                        <a href="{{ route('attributes.edit', ['id' => $attribute->id]) }}" class="btn-secondary text-xs px-2 py-1 inline-flex items-center">
                                            <i class="bi bi-pencil mr-1"></i> Editar
                                        </a>
                                        <button type="button"
                                                onclick="showDeleteModal('{{ $attribute->id }}', '{{ $attribute->name }}')"
                                                class="btn-warning text-xs px-2 py-1 inline-flex items-center">
                                            <i class="bi bi-trash mr-1"></i> Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="p-4" id="pagination-container">
                            {{ $attributes->links() }}
                        </div>
                </div>
            @endif
        </div>
    </div>
    @include('components.delete-confirmation', [
    'itemType' => 'atributo',
    'routeName' => route('attributes.destroy', ['id' => '__ID__'])
])
@endsection
