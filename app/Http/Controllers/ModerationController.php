<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Denunciation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ModerationController extends Controller
{
    public function index()
    {
        // Get data for denunciations
        $reportedController = new ReportedAdvertisementController();
        $denunciationData = $reportedController->index();

        // Summary box data
        $reportedCount = Denunciation::where('report_state', 0)->count();

        // Substituindo state=active para is_published=true e is_suspended=false
        $pendingCount = Advertisement::where('is_published', true)
            ->where('is_suspended', false)
            ->count();

        $resolvedCount = Denunciation::whereIn('report_state', [1, 2])->count();
        $suspendedUsersCount = User::where('state', 'suspended')->count();

        $users = User::orderBy('updated_at', 'desc')->paginate(5);

        // Adicionando dados de verificações de anunciantes
        $verifications = \App\Models\AdvertiserVerification::with('submitter')
            ->orderBy('submitted_at', 'desc')
            ->paginate(5);

        // Preparar últimos 6 meses
        $suspendedUsersData = [];
        $reportedAdsData = [];
        $monthLabels = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthLabels[] = $date->format('M'); // Apenas aqui!

            $suspendedUsersData[] = User::where('state', 'suspended')
                ->whereYear('updated_at', $date->year)
                ->whereMonth('updated_at', $date->month)
                ->count();

            $reportedAdsData[] = Denunciation::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        // Denunciation reasons for current month
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $totalDenunciations = Denunciation::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $reasonsData = [];
        if ($totalDenunciations > 0) {
            $reasonsData = Denunciation::join('denunciation_reasons', 'denunciations.reason_id', '=', 'denunciation_reasons.id')
                ->selectRaw('denunciation_reasons.name, COUNT(*) as count')
                ->whereYear('denunciations.created_at', $currentYear)
                ->whereMonth('denunciations.created_at', $currentMonth)
                ->groupBy('denunciation_reasons.name')
                ->orderByDesc('count')
                ->get()
                ->map(function ($item) use ($totalDenunciations) {
                    return [
                        'name' => $item->name,
                        'count' => $item->count,
                        'percentage' => round(($item->count / $totalDenunciations) * 100),
                    ];
                });

            if ($reasonsData->count() > 3) {
                $topReasons = $reasonsData->take(2);
                $otherReasons = $reasonsData->skip(2);
                $otherCount = $otherReasons->sum('count');
                $otherPercentage = round(($otherCount / $totalDenunciations) * 100);

                $reasonsData = $topReasons->push([
                    'name' => 'Outros',
                    'count' => $otherCount,
                    'percentage' => $otherPercentage,
                ]);
            }
        }

        return view('moderation.index', [
            'denunciationData' => $denunciationData,
            'presented' => $denunciationData['presented'] ?? [],
            'denunciations' => $denunciationData['paginator'] ?? null,
            'reportedCount' => $reportedCount,
            'pendingCount' => $pendingCount,
            'resolvedCount' => $resolvedCount,
            'suspendedUsersCount' => $suspendedUsersCount,
            'suspendedUsersData' => $suspendedUsersData,
            'monthLabels' => $monthLabels,
            'reportedAdsData' => $reportedAdsData,
            'reasonsData' => $reasonsData,
            'totalDenunciations' => $totalDenunciations,
            'users' => $users,
            'verifications' => $verifications, // Adicionando esta linha para resolver o problema
        ]);
    }

    public function suspendedUsers()
    {
        $users = User::whereIn('state', ['suspended', 'banned', 'archived'])
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('moderation.suspended-users', [
            'users' => $users
        ]);
    }

    public function updateUserState(Request $request, $userId)
    {
        $validated = $request->validate([
            'state' => 'required|in:active,suspended,banned,archived'
        ]);

        $user = User::findOrFail($userId);
        $user->state = $validated['state'];
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado do utilizador atualizado com sucesso.',
            'user' => $user
        ]);
    }

    public function ajaxSuspendedUsers(Request $request)
    {
        $query = User::query();

        // Filtrar apenas utilizadores com estados específicos
        $query->whereIn('state', ['active', 'suspended', 'banned', 'archived']);

        // Filtrar por estado específico se solicitado
        if ($request->has('filter') && $request->filter !== 'all') {
            $query->where('state', $request->filter);
        }

        // Pesquisar por nome ou email se tiver termo de pesquisa
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Paginação
        $users = $query->orderBy('updated_at', 'desc')->paginate(5);

        // Mapear utilizadores para incluir URL da imagem de perfil
        $usersData = $users->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'state' => $user->state,
                'created_at' => $user->created_at,
                'profile_picture_url' => $user->getProfilePictureUrl()
            ];
        });

        return response()->json([
            'users' => $usersData,
            'pagination' => $users->links()->toHtml(),
            'total' => $users->total(),
            'from' => $users->firstItem(),
            'to' => $users->lastItem()
        ]);
    }
}
