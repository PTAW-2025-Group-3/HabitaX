@extends('layout.app')

@section('title', 'Opções de Atributo')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            <div class="mb-4">
                <a href="{{ route('attributes.index') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Voltar para Atributos
                </a>
            </div>

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-primary">Opções de Atributo</h2>
                <a href="{{ route('attribute-options.create', ['id' => $attribute->id]) }}" class="btn-primary px-4 py-2 rounded-lg flex items-center float-right">
                    <i class="bi bi-plus-lg mr-2"></i>
                    Adicionar Opção de Atributo
                </a>
            </div>

            @if ($options->get()->isEmpty())
                <div class="bg-white p-6 rounded-lg shadow text-center text-gray">
                    Nenhuma opção de atributo encontrada.
                </div>
            @else
                <div class="overflow-x-auto rounded-xl shadow bg-white">
                    <table class="min-w-full text-sm">
                        <thead class="bg-blue-100 text-left">
                        <tr>
                            <th class="p-4">Nome</th>
                            <th class="p-4 text-right">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($options->get() as $option)
                            <tr class="border-t hover:bg-gray-50 transition">
                                <td class="p-4 font-medium">{{ $option->name }}</td>
                                <td class="p-4 text-right space-x-1">
                                    <a href="{{ route('attribute-options.edit', ['id' => $option->id]) }}"
                                       class="btn-secondary text-xs px-2 py-1 inline-flex items-center">
                                        <i class="bi bi-pencil mr-1"></i> Editar
                                    </a>
                                    <button type="button"
                                            onclick="showDeleteModal('{{ $option->id }}', '{{ $option->name }}')"
                                            class="btn-warning text-xs px-2 py-1 inline-flex items-center">
                                        <i class="bi bi-trash mr-1"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    @include('components.delete-confirmation', [
    'itemType' => 'Opção de Atributo',
    'routeName' => route('attribute-options.destroy', ['id' => '__ID__'])
    ])
@endsection
