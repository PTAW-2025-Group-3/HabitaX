<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use App\Models\Denunciation;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function index()
    {
        return view('pages.administration.index', [
            'activeUsers' => User::whereNotNull('email_verified_at')->count(),
            'totalUsers' => User::count(),
            'publishedAds' => Property::count(),
            'reportedAds' => Denunciation::count(),
            'users' => User::orderBy('created_at', 'desc')->paginate(5),
        ]);
    }

    public function getUsers(Request $request)
    {
        $query = User::query();

        // Filtro de busca
        if ($request->has('search') && $request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%".strtolower($search)."%"])
                    ->orWhereRaw('LOWER(email) LIKE ?', ["%".strtolower($search)."%"]);
            });
        }

        // Ordenação (sem 'latest()' para não sobrescrever!)
        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'desc');

        if (in_array($sort, ['id', 'name', 'email', 'created_at']) && in_array($order, ['asc', 'desc'])) {
            $query->orderBy($sort, $order);
        }

        // Paginação
        $users = $query->paginate(5)->appends([
            'search' => $request->input('search'),
            'sort' => $sort,
            'order' => $order,
        ]);

        // AJAX response
        if ($request->ajax()) {
            $usersHtml = '';

            if ($users->count() > 0) {
                foreach ($users as $user) {
                    $state = in_array($user->state, ['active', 'suspended', 'banned', 'archived']) ? $user->state : 'active';

                    $usersHtml .= '<tr class="border-t hover:bg-gray-50 transition user-row"
                    data-id="' . $user->id . '"
                    data-name="' . $user->name . '"
                    data-email="' . $user->email . '"
                    data-created_at="' . $user->created_at->timestamp . '"
                    data-state="' . $state . '">
                    <td class="p-4">#' . $user->id . '</td>
                    <td class="p-4 font-medium user-name">' . $user->name . '</td>
                    <td class="p-4 text-gray-600 user-email">' . $user->email . '</td>
                    <td class="p-4 text-gray-500">' . $user->created_at->format('d/m/Y - H:i') . '</td>
                    <td class="p-4">';

                    $badgeMap = [
                        'active' => '<span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-green-100 text-green-700">Ativo</span>',
                        'suspended' => '<span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-yellow-100 text-yellow-600">Suspenso</span>',
                        'banned' => '<span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-red-100 text-red-600">Banido</span>',
                        'archived' => '<span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-gray-100 text-gray-600">Arquivado</span>',
                    ];

                    $usersHtml .= $badgeMap[$state] ?? '';
                    $usersHtml .= '</td>
                    <td class="p-4 space-x-1">
                        <button class="btn-secondary text-xs px-2 py-1 state-user-btn"
                                data-user-id="' . $user->id . '"
                                data-user-name="' . $user->name . '"
                                data-user-state="' . $state . '">
                            Gerir Estado
                        </button>
                        <button class="btn-secondary text-xs px-2 py-1 permissions-btn"
                                data-user-id="' . $user->id . '"
                                data-user-name="' . $user->name . '"
                                data-user-role="' . ($user->userType ?? 'user') . '">
                            Permissões
                        </button>
                    </td>
                </tr>';
                }
            } else {
                $usersHtml = '<tr class="border-t">
                <td colspan="6" class="p-4 text-center text-gray-500">Nenhum utilizador encontrado</td>
            </tr>';
            }

            $paginationHtml = $users->links()->toHtml();

            return response()->json([
                'users' => $usersHtml,
                'pagination' => $paginationHtml
            ]);
        }

        return redirect()->route('admin.index');
    }


    public function toggleStatus(Request $request, User $user)
    {
        $request->validate([
            'state' => 'required|in:active,suspended,banned,archived'
        ]);

        if (!in_array($request->state, ['active', 'suspended', 'banned', 'archived'])) {
            return response()->json([
                'success' => false,
                'message' => 'Estado inválido fornecido.'
            ], 400);
        }

        $user->state = $request->state;
        $user->save();

        $user->refresh();

        $stateMessages = [
            'active' => 'Utilizador ativado com sucesso.',
            'suspended' => 'Utilizador suspenso com sucesso.',
            'banned' => 'Utilizador banido com sucesso.',
            'archived' => 'Utilizador arquivado com sucesso.'
        ];

        return response()->json([
            'success' => true,
            'state' => $user->state,
            'message' => $stateMessages[$user->state]
        ]);
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,moderator,admin'
        ]);

        $user->userType = $request->role;
        $user->save();

        return response()->json([
            'success' => true,
            'role' => $user->userType,
            'message' => 'Tipo de utilizador atualizado com sucesso.'
        ]);
    }
}
