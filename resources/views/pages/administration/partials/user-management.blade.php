@php
    $users = [
        ['id' => '#6541', 'name' => 'Cristiano Ronaldo', 'email' => 'cristian@email.com', 'registered' => '12/03/2025 - 14:45', 'status' => 'Ativo'],
        ['id' => '#812', 'name' => 'Maria da Silva', 'email' => 'mariadasilva@gmail.com', 'registered' => '11/03/2025 - 12:33', 'status' => 'Ativo'],
        ['id' => '#6141', 'name' => 'Aurélio da Silva', 'email' => 'aurelio.silva@gmail.com', 'registered' => '09/03/2025 - 19:43', 'status' => 'Ativo'],
        ['id' => '#6535', 'name' => 'Luís Assis', 'email' => 'luisassis@ib.pt', 'registered' => '07/03/2025 - 15:46', 'status' => 'Ativo'],
    ];
@endphp

<div class="mt-12 animate-fade-in">
    <h2 class="text-xl font-bold text-primary mb-4">Gerir Utilizadores</h2>
    <div class="overflow-x-auto rounded-xl shadow bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-blue-100 text-left">
            <tr>
                <th class="p-4">ID</th>
                <th class="p-4">Nome</th>
                <th class="p-4">Email</th>
                <th class="p-4">Data de Registo</th>
                <th class="p-4">Estado</th>
                <th class="p-4">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr class="border-t hover:bg-gray-50 transition">
                    <td class="p-4">{{ $user['id'] }}</td>
                    <td class="p-4 font-medium">{{ $user['name'] }}</td>
                    <td class="p-4 text-gray-600">{{ $user['email'] }}</td>
                    <td class="p-4 text-gray-500">{{ $user['registered'] }}</td>
                    <td class="p-4">
                            <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold
                                {{ $user['status'] === 'Ativo' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                {{ $user['status'] }}
                            </span>
                    </td>
                    <td class="p-4 space-x-1">
                        <button class="btn-secondary text-xs px-2 py-1">Suspender</button>
                        <button class="btn-secondary text-xs px-2 py-1">Destacar</button>
                        <button class="btn-secondary text-xs px-2 py-1">Permissões</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
