<?php

namespace App\Http\Controllers;

use App\Models\{Advertisement, User, Property, Denunciation};
use App\Traits\MonthsInPortuguese;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    use MonthsInPortuguese;

    public function index()
    {
        $months = collect($this->generateMonthLabels());
        $anunciosData = collect();
        $utilizadoresData = collect();

        // Começar no primeiro dia do mês atual e voltar 5 meses
        $startDate = now()->startOfMonth();

        for ($i = 5; $i >= 0; $i--) {
            $date = clone $startDate;
            $date = $date->subMonths($i);

            $anunciosData->push(
                Advertisement::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count()
            );

            $utilizadoresData->push(
                User::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count()
            );
        }

        $publishedAds = Advertisement::where('is_published', true)
            ->where('is_suspended', false)
            ->whereHas('creator', function($q) {
                $q->where('state', 'active');
            })
            ->whereHas('property.property_type', function($q) {
                $q->where('is_active', true);
            })
            ->count();

        $userRoleLabels = ['Utilizadores', 'Moderadores', 'Administradores'];
        $userRoleData = [
            User::where('user_type', 'user')->orWhereNull('user_type')->count(),
            User::where('user_type', 'moderator')->count(),
            User::where('user_type', 'admin')->count()
        ];

        return view('administration.index', [
            'activeUsers' => User::where('state', 'active')->count(),
            'totalUsers' => User::count(),
            'publishedAds' => $publishedAds,
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
            $response = [
                'users' => view('administration.partials.user-rows', ['users' => $users])->render()
            ];

            if ($users->hasPages()) {
                $response['pagination'] = $users->links()->toHtml();
            }

            return response()->json($response);
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

        $user->update(['user_type' => $request->role]);

        return response()->json([
            'success' => true,
            'role' => $user->user_type,
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
                User::where('user_type', 'user')->orWhereNull('user_type')->count(),
                User::where('user_type', 'moderator')->count(),
                User::where('user_type', 'admin')->count()
            ],
            'activeUsers' => User::where('state', 'active')->count(),
            'totalUsers' => User::count()
        ]);
    }
}
