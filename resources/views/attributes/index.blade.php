@extends('layout.app')

@section('title', 'Atributos')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Atributos</h1>
        <div class="mb-4">
            <a href="{{ route('attributes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Adicionar Atributo</a>
        </div>
        @if ($attributes->isEmpty())
            <p>No attributes found.</p>
        @else
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Nome</th>
                        <th class="border px-4 py-2">Tipo de Valor</th>
                        <th class="border px-4 py-2">Ativo</th>
                        <th class="border px-4 py-2">Obrigatório</th>
                        <th class="border px-4 py-2">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attributes as $attribute)
                        <tr>
                            <td class="border px-4 py-2">{{ $attribute->name }}</td>
                            <td class="border px-4 py-2">{{ $attribute->type }}</td>
                            <td class="border px-4 py-2">
                                <input type="checkbox" disabled {{ $attribute->is_active ? 'checked' : '' }}>
                            </td>
                            <td class="border px-4 py-2">
                                <input type="checkbox" disabled {{ $attribute->is_required ? 'checked' : '' }}>
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('attributes.edit', ['id' => $attribute->id]) }}" class="text-blue-500">Editar</a>
                                |
                                <form action="{{ route('attributes.destroy', ['id' => $attribute->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $attributes->links() }}
            </div>
        @endif
    </div>
@endsection
