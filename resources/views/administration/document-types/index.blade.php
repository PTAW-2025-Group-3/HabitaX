@extends('layout.app')

@section('title', 'Tipo de Documento')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mt-12 animate-fade-in">
            <div class="mb-4">
                <a href="{{ route('admin.index') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Voltar para Administração
                </a>
            </div>
            <h2 class="text-xl font-bold text-primary mb-6">Gerir Tipos de Documento</h2>
            <div class="mb-4">
                <a href="{{ route('document-types.create') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center w-fit">
                    <i class="bi bi-plus-circle mr-2"></i>
                    Criar Novo Tipo de Documento
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ativo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($documentTypes as $documentType)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $documentType->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $documentType->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($documentType->active)
                                        <span class="text-green-600">Sim</span>
                                    @else
                                        <span class="text-red-600">Não</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('document-types.edit', $documentType->id) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                                    |
                                    <form action="{{ route('document-types.destroy', $documentType->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $documentTypes->links() }}
            </div>
        </div>
    </div>
@endsection
