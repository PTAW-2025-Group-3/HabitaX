<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use App\Models\Denunciation;
use Illuminate\Http\Request;
class AdministrationController extends Controller {

    public function index() {

        $activeUsers = User::whereNotNull('email_verified_at')->count();
        $totalUsers = User::count();
        $publishedAds = Property::count();
        $reportedAds = Denunciation::count();

        $users = User::latest()->paginate(5);

        return view('pages.administration.index', compact(
            'activeUsers',
            'totalUsers',
            'publishedAds',
            'reportedAds',
            'users'
        ));
    }

    public function getUsers(Request $request)
    {
        $users = User::latest()->paginate(5);

        if ($request->ajax()) {
            $usersHtml = '';

            if ($users->count() > 0) {
                foreach ($users as $user) {
                    $usersHtml .= '<tr class="border-t hover:bg-gray-50 transition user-row"
                data-id="' . $user->id . '"
                data-name="' . $user->name . '"
                data-email="' . $user->email . '"
                data-created_at="' . $user->created_at->timestamp . '"
                data-suspended="' . ($user->is_suspended ? 'true' : 'false') . '">
                <td class="p-4">#' . $user->id . '</td>
                <td class="p-4 font-medium user-name">' . $user->name . '</td>
                <td class="p-4 text-gray-600 user-email">' . $user->email . '</td>
                <td class="p-4 text-gray-500">' . $user->created_at->format('d/m/Y - H:i') . '</td>
                <td class="p-4">';

                    if ($user->is_suspended) {
                        $usersHtml .= '<span class="inline-block px-2 py-1 text-xs rounded-full font-semibold bg-red-100 text-red-600">Suspenso</span>';
                    } else {
                        $usersHtml .= '<span class="inline-block px-2 py-1 text-xs rounded-full font-semibold ' .
                            ($user->email_verified_at ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-600') . '">' .
                            ($user->email_verified_at ? 'Ativo' : 'Pendente') . '</span>';
                    }

                    $usersHtml .= '</td>
                <td class="p-4 space-x-1">
                    <button class="btn-secondary text-xs px-2 py-1 suspend-user-btn"
                            data-user-id="' . $user->id . '"
                            data-user-name="' . $user->name . '"
                            data-is-suspended="' . ($user->is_suspended ? 'true' : 'false') . '">
                        ' . ($user->is_suspended ? 'Reativar' : 'Suspender') . '
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

    public function toggleSuspension(Request $request, User $user)
    {
        $user->is_suspended = !$user->is_suspended;
        $user->save();

        return response()->json([
            'success' => true,
            'is_suspended' => $user->is_suspended,
            'message' => $user->is_suspended ? 'Usuário suspenso com sucesso.' : 'Suspensão removida com sucesso.'
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
