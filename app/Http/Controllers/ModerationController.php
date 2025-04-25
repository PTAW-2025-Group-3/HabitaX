<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Denunciation;
use App\Models\User;
use Carbon\Carbon;

class ModerationController extends Controller
{
    public function index()
    {
        // Get data for denunciations
        $reportedController = new ReportedAdvertisementController();
        $denunciationData = $reportedController->index();

        // Summary box data
        $reportedCount = Denunciation::where('report_state', 0)->count();
        $pendingCount = Advertisement::where('state', 'active')->count();
        $resolvedCount = Denunciation::whereIn('report_state', [1, 2])->count();
        $suspendedUsersCount = User::where('state', 'suspended')->count();

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

        return view('pages.moderation.index', [
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
        ]);
    }
}
