@props(['user', 'state', 'classes', 'label'])

<tr class="border-t hover:bg-gray-50 transition user-row"
    data-id="{{ $user->id }}"
    data-name="{{ $user->name }}"
    data-email="{{ $user->email }}"
    data-created_at="{{ $user->created_at->timestamp }}"
    data-state="{{ $state }}">
    <td class="p-4">#{{ $user->id }}</td>
    <td class="p-4 font-medium user-name">{{ $user->name }}</td>
    <td class="p-4 text-gray-600 user-email">{{ $user->email }}</td>
    <td class="p-4 text-gray-500">{{ $user->created_at->format('d/m/Y - H:i') }}</td>
    <td class="p-4">
        <span class="inline-block px-2 py-1 text-xs rounded-full font-semibold {{ $classes }}">{{ $label }}</span>
    </td>
    <td class="p-4 space-x-1">
        <button class="btn-secondary text-xs px-2 py-1 state-user-btn"
                data-user-id="{{ $user->id }}"
                data-user-name="{{ $user->name }}"
                data-user-state="{{ $state }}">
            Gerir Estado
        </button>
        <button class="btn-secondary text-xs px-2 py-1 permissions-btn"
                data-user-id="{{ $user->id }}"
                data-user-name="{{ $user->name }}"
                data-user-role="{{ $user->userType ?? 'user' }}">
            Permissões
        </button>
    </td>
</tr>
