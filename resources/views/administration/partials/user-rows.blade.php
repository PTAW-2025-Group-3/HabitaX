@forelse ($users as $user)
    <tr class="border-t hover:bg-gray-50 transition user-row"
        data-id="{{ $user->id }}"
        data-name="{{ $user->name }}"
        data-email="{{ $user->email }}"
        data-created_at="{{ $user->created_at->timestamp }}"
        data-state="{{ $user->state }}">
        <td class="p-4">#{{ $user->id }}</td>
        <td class="p-4">
            <img src="{{ $user->getProfilePictureUrl() }}" alt="Imagem de perfil"
                 class="w-10 h-10 rounded-full object-cover">
        </td>
        <td class="p-4 font-medium user-name">{{ $user->name }}</td>
        <td class="p-4 text-gray-600 user-email">{{ $user->email }}</td>
        <td class="p-4 text-gray-500">{{ $user->created_at->format('d/m/Y - H:i') }}</td>
        <td class="p-4">
            @if ($user->state === 'suspended')
                <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-yellow-100 text-yellow-600">
                    Suspenso
                </span>
            @elseif ($user->state === 'active')
                <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-700">
                    Ativo
                </span>
            @elseif ($user->state === 'banned')
                <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-red-100 text-red-600">
                    Banido
                </span>
            @elseif ($user->state === 'archived')
                <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-gray-100 text-gray-600">
                    Arquivado
                </span>
            @endif
        </td>
        <td class="p-4 space-x-1">
            <button class="btn-secondary text-xs px-2 py-1 state-user-btn"
                    data-user-id="{{ $user->id }}"
                    data-user-name="{{ $user->name }}"
                    data-user-state="{{ $user->state }}">
                Gerir Estado
            </button>
            <button class="btn-secondary text-xs px-2 py-1 permissions-btn"
                    data-user-id="{{ $user->id }}"
                    data-user-name="{{ $user->name }}"
                    data-user-role="{{ $user->user_type ?? 'user' }}">
                Permissões
            </button>
        </td>
    </tr>
@empty
    <tr class="border-t">
        <td colspan="7" class="p-4 text-center text-gray-500">Nenhum utilizador encontrado</td>
    </tr>
@endforelse
