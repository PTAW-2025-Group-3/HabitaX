@php
    $users = [
        ['id' => '#6541', 'name' => 'Cristiano Ronaldo', 'email' => 'cristian@email.com', 'registered' => '12/03/2025 - 14:45', 'status' => 'Ativo'],
        ['id' => '#812', 'name' => 'Maria da Silva', 'email' => 'mariadasilva@gmail.com', 'registered' => '11/03/2025 - 12:33', 'status' => 'Ativo'],
        ['id' => '#6141', 'name' => 'Aurélio da Silva', 'email' => 'aurelio.silva@gmail.com', 'registered' => '09/03/2025 - 19:43', 'status' => 'Ativo'],
        ['id' => '#6535', 'name' => 'Luís Assis', 'email' => 'luisassis@ib.pt', 'registered' => '07/03/2025 - 15:46', 'status' => 'Ativo'],
    ];
@endphp

<div class="mt-12">
    <h2 class="text-xl font-bold text-blue-600 mb-4">Gerir Utilizadores</h2>
    <table class="min-w-full bg-white shadow rounded-xl overflow-hidden">
        <thead class="bg-blue-100 text-left text-sm">
        <tr>
            <th class="p-4">ID</th>
            <th class="p-4">Nome</th>
            <th class="p-4">Email</th>
            <th class="p-4">Data de Registo</th>
            <th class="p-4">Estado</th>
            <th class="p-4">Ações</th>
        </tr>
        </thead>
        <tbody class="text-sm">
        @foreach ($users as $user)
            <tr class="border-t">
                <td class="p-4">{{ $user['id'] }}</td>
                <td class="p-4">{{ $user['name'] }}</td>
                <td class="p-4">{{ $user['email'] }}</td>
                <td class="p-4">{{ $user['registered'] }}</td>
                <td class="p-4 text-green-600">{{ $user['status'] }}</td>
                <td class="p-4">
                    <button class="text-xs bg-gray-200 px-2 py-1 rounded">Suspender</button>
                    <button class="text-xs bg-gray-200 px-2 py-1 rounded">Destacar</button>
                    <button class="text-xs bg-gray-200 px-2 py-1 rounded">Permissões</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
