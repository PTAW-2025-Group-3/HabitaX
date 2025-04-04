@php
    $params = [
        ['id' => 1, 'nome' => 'Número de Quartos', 'tipo' => 'Número', 'min' => 1, 'max' => 10, 'opcoes' => '-', 'obrigatorio' => 'Sim', 'categorias' => 'Apartamento, Moradia'],
        ['id' => 2, 'nome' => 'Área (m²)', 'tipo' => 'Número', 'min' => 10, 'max' => 20, 'opcoes' => '-', 'obrigatorio' => 'Sim', 'categorias' => 'Apartamento, Moradia'],
        ['id' => 3, 'nome' => 'Classe Energética', 'tipo' => 'Lista de Opções', 'min' => '-', 'max' => '-', 'opcoes' => 'A, B, C, D, E, F', 'obrigatorio' => 'Não', 'categorias' => 'Todos'],
        ['id' => 4, 'nome' => 'Tem Garagem?', 'tipo' => 'Boolean', 'min' => '-', 'max' => '-', 'opcoes' => 'Sim/Não', 'obrigatorio' => 'Sim', 'categorias' => 'Apartamento, Moradia'],
    ];
@endphp

<div class="mt-12">
    <h2 class="text-xl font-bold text-blue-600 mb-4">Gestão de Parâmetros dos Anúncios</h2>
    <table class="min-w-full bg-white shadow rounded-xl overflow-hidden">
        <thead class="bg-blue-100 text-left text-sm">
        <tr>
            <th class="p-4">ID</th>
            <th class="p-4">Nome</th>
            <th class="p-4">Tipo de Dado</th>
            <th class="p-4">Mínimo</th>
            <th class="p-4">Máximo</th>
            <th class="p-4">Opções</th>
            <th class="p-4">Obrigatório</th>
            <th class="p-4">Categorias</th>
            <th class="p-4">Ações</th>
        </tr>
        </thead>
        <tbody class="text-sm">
        @foreach ($params as $param)
            <tr class="border-t">
                <td class="p-4">#{{ $param['id'] }}</td>
                <td class="p-4">{{ $param['nome'] }}</td>
                <td class="p-4">{{ $param['tipo'] }}</td>
                <td class="p-4">{{ $param['min'] }}</td>
                <td class="p-4">{{ $param['max'] }}</td>
                <td class="p-4">{{ $param['opcoes'] }}</td>
                <td class="p-4">{{ $param['obrigatorio'] }}</td>
                <td class="p-4">{{ $param['categorias'] }}</td>
                <td class="p-4">
                    <button class="text-xs bg-gray-200 px-2 py-1 rounded">✎</button>
                    <button class="text-xs bg-gray-200 px-2 py-1 rounded">🗑</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
