<?php

namespace App\Http\Controllers;

use App\Models\{Advertisement, User, Property, Denunciation};
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function index()
    {
        $months = collect();
        $anunciosData = collect();
        $utilizadoresData = collect();

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $months->push($month->format('M'));

            $anunciosData->push(
                Advertisement::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count()
            );

            $utilizadoresData->push(
                User::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count()
            );
        }
        
        $userRoleLabels = ['Utilizadores', 'Moderadores', 'Administradores'];
        $userRoleData = [
            User::where('userType', 'user')->orWhereNull('userType')->count(),
            User::where('userType', 'moderator')->count(),
            User::where('userType', 'admin')->count()
        ];

        return view('pages.administration.index', [
            'activeUsers' => User::where('state', 'active')->count(),
            'totalUsers' => User::count(),
            'publishedAds' => Property::count(),
            'reportedAds' => Denunciation::count(),
            'users' => User::orderBy('created_at', 'desc')->paginate(5),
            'chartLabels' => $months,
            'anunciosData' => $anunciosData,
            'utilizadoresData' => $utilizadoresData,
            'userRoleData' => $userRoleData,
            'userRoleLabels' => $userRoleLabels
        ]);
    }

    public function getUsers(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = strtolower($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(email) LIKE ?', ["%{$search}%"]);
            });
        }

        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'desc');

        if (in_array($sort, ['id', 'name', 'email', 'created_at']) && in_array($order, ['asc', 'desc'])) {
            $query->orderBy($sort, $order);
        }

        $users = $query->paginate(5)->appends($request->only(['search', 'sort', 'order']));

        if ($request->ajax()) {
            $badgeMap = [
                'active' => 'bg-green-100 text-green-700|Ativo',
                'suspended' => 'bg-yellow-100 text-yellow-600|Suspenso',
                'banned' => 'bg-red-100 text-red-600|Banido',
                'archived' => 'bg-gray-100 text-gray-600|Arquivado'
            ];

            $usersHtml = $users->count() > 0 ? $users->map(function ($user) use ($badgeMap) {
                $state = in_array($user->state, array_keys($badgeMap)) ? $user->state : 'active';
                [$classes, $label] = explode('|', $badgeMap[$state]);

                return view('components.admin.user-row', compact('user', 'state', 'classes', 'label'))->render();
            })->implode('') : '<tr class="border-t"><td colspan="6" class="p-4 text-center text-gray-500">Nenhum utilizador encontrado</td></tr>';

            return response()->json([
                'users' => $usersHtml,
                'pagination' => $users->links()->toHtml()
            ]);
        }

        return redirect()->route('admin.index');
    }

    public function toggleStatus(Request $request, User $user)
    {
        $request->validate([
            'state' => 'required|in:active,suspended,banned,archived'
        ]);

        $user->update(['state' => $request->state]);

        $stateMessages = [
            'active' => 'Utilizador ativado com sucesso.',
            'suspended' => 'Utilizador suspenso com sucesso.',
            'banned' => 'Utilizador banido com sucesso.',
            'archived' => 'Utilizador arquivado com sucesso.'
        ];

        return response()->json([
            'success' => true,
            'state' => $user->state,
            'message' => $stateMessages[$user->state],
            'stats' => [
                'activeUsers' => User::where('state', 'active')->count(),
                'totalUsers' => User::count()
            ]
        ]);
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,moderator,admin'
        ]);

        $user->update(['userType' => $request->role]);

        return response()->json([
            'success' => true,
            'role' => $user->userType,
            'message' => 'Tipo de utilizador atualizado com sucesso.',
            'stats' => [
                'activeUsers' => User::where('state', 'active')->count(),
                'totalUsers' => User::count()
            ]
        ]);
    }

    public function getUserRolesData()
    {
        // Fix the method by using direct counts instead of pluck
        return response()->json([
            'userRoleData' => [
                User::where('userType', 'user')->orWhereNull('userType')->count(),
                User::where('userType', 'moderator')->count(),
                User::where('userType', 'admin')->count()
            ],
            'activeUsers' => User::where('state', 'active')->count(),
            'totalUsers' => User::count()
        ]);
    }
}
