<?php

namespace App\Http\Controllers;

use App\Models\Denunciation;
use Illuminate\Http\Request;

class DenunciationController extends Controller
{

    public function store(Request $request)
    {
        // Verificar se o utilizador está autenticado
        if (!auth()->check()) {
            return response()->json([
                'message' => 'Autenticação necessária para denunciar anúncios.'
            ], 401);
        }

        // Buscar o limite diário de denúncias das variáveis globais
        $maxReportsPerDay = \App\Models\GlobalVariable::where('code', 'max_reports_per_day')
            ->first()->value ?? 5;

        // Contar quantas denúncias o utilizador já fez hoje
        $todayReportsCount = Denunciation::where('created_by', auth()->id())
            ->whereDate('submitted_at', now()->toDateString())
            ->count();

        // Verificar se o utilizador atingiu o limite
        if ($todayReportsCount >= $maxReportsPerDay) {
            return response()->json([
                'message' => "Limite diário de {$maxReportsPerDay} denúncia(s) atingido. Tente novamente amanhã."
            ], 429);
        }

        $validated = $request->validate([
            'advertisement_id' => 'required|exists:advertisements,id',
            'reason_id' => 'required|exists:denunciation_reasons,id',
            'description' => 'nullable|string|max:1000',
        ]);

        $denunciation = Denunciation::create([
            'advertisement_id' => $validated['advertisement_id'],
            'reason_id' => $validated['reason_id'],
            'desc' => $validated['description'],
            'report_state' => 0,
            'created_by' => auth()->id(),
            'submitted_at' => now(),
        ]);

        return response()->json([
            'message' => 'Denúncia enviada com sucesso.',
            'denunciation' => $denunciation,
        ], 201);
    }
}
