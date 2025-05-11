@php
    $params = [
        ['id' => 1, 'nome' => 'Número de Quartos', 'tipo' => 'Número', 'min' => 1, 'max' => 10, 'opcoes' => '-', 'obrigatorio' => 'Sim', 'categorias' => 'Apartamento, Moradia'],
        ['id' => 2, 'nome' => 'Área (m²)', 'tipo' => 'Número', 'min' => 10, 'max' => 20, 'opcoes' => '-', 'obrigatorio' => 'Sim', 'categorias' => 'Apartamento, Moradia'],
        ['id' => 3, 'nome' => 'Classe Energética', 'tipo' => 'Lista de Opções', 'min' => '-', 'max' => '-', 'opcoes' => 'A, B, C, D, E, F', 'obrigatorio' => 'Não', 'categorias' => 'Todos'],
        ['id' => 4, 'nome' => 'Tem Garagem?', 'tipo' => 'Boolean', 'min' => '-', 'max' => '-', 'opcoes' => 'Sim/Não', 'obrigatorio' => 'Sim', 'categorias' => 'Apartamento, Moradia'],
    ];
@endphp

<div class="mt-12">
    <h2 class="text-xl font-bold text-primary mb-4">Gestão de Parâmetros dos Anúncios</h2>
    <div class="overflow-x-auto rounded-xl shadow bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-blue-100 text-left">
            <tr>
                <th class="p-4">ID</th>
                <th class="p-4">Nome</th>
                <th class="p-4">Tipo</th>
                <th class="p-4">Min</th>
                <th class="p-4">Max</th>
                <th class="p-4">Opções</th>
                <th class="p-4">Obrigatório</th>
                <th class="p-4">Categorias</th>
                <th class="p-4">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($params as $param)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="p-4 font-mono text-gray-600">#{{ $param['id'] }}</td>
                    <td class="p-4 font-medium">{{ $param['nome'] }}</td>
                    <td class="p-4 text-gray-700">{{ $param['tipo'] }}</td>
                    <td class="p-4">{{ $param['min'] }}</td>
                    <td class="p-4">{{ $param['max'] }}</td>
                    <td class="p-4 text-gray-500">{{ $param['opcoes'] }}</td>
                    <td class="p-4">
                            <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold
                                {{ $param['obrigatorio'] === 'Sim' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                {{ $param['obrigatorio'] }}
                            </span>
                    </td>
                    <td class="p-4 text-gray-600">{{ $param['categorias'] }}</td>
                    <td class="p-4 space-x-1">
                        <button class="btn-secondary text-xs px-2 py-1" title="Editar">✎</button>
                        <button class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded hover:bg-red-200 transition" title="Eliminar">🗑</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
