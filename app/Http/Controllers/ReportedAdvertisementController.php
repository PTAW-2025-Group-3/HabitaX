<?php

namespace App\Http\Controllers;

use App\Models\Denunciation;
use App\Presenters\DenunciationPresenter;
use Illuminate\Support\Str;


class ReportedAdvertisementController extends Controller
{
    public function index()
    {
        $denunciations = Denunciation::with(['creator', 'advertisement', 'reason'])
            ->orderBy('submitted_at', 'desc')
            ->paginate(5);

        // Transforma cada denúncia num Presenter
        $presented = $denunciations->map(fn($d) => new DenunciationPresenter($d));

        return [
            'section' => [
                'title' => 'Anúncios Reportados',
                'filters' => ['Todos', 'Por Resolver', 'Aprovados', 'Rejeitados'],
                'headers' => ['ID', 'Anúncio', 'Motivo', 'Denunciante', 'Data', 'Estado', 'Ações'],
            ],
            'paginator' => $denunciations,
            'presented' => $presented,
        ];
    }

    public function show($id)
    {
        $denunciation = Denunciation::with(['creator', 'advertisement', 'reason', 'validator'])
            ->findOrFail($id);

        return view('pages.moderation.partials.reported-advertisements.reported-advertisement', compact('denunciation'));
    }

    public function approve($id)
    {
        $denunciation = Denunciation::findOrFail($id);

        if ($denunciation->report_state !== 0) {
            return back()->with('error', 'Esta denúncia já foi processada.');
        }

        $denunciation->update([
            'report_state' => 1, // Approved
            'validated_by' => auth()->id(),
            'validated_at' => now()
        ]);

        return redirect()->route('moderation')
            ->with('success', 'Denúncia aprovada com sucesso.');
    }

    public function reject($id)
    {
        $denunciation = Denunciation::findOrFail($id);

        if ($denunciation->report_state !== 0) {
            return back()->with('error', 'Esta denúncia já foi processada.');
        }

        $denunciation->update([
            'report_state' => 2, // Rejected
            'validated_by' => auth()->id(),
            'validated_at' => now()
        ]);

        return redirect()->route('moderation')
            ->with('success', 'Denúncia rejeitada com sucesso.');
    }

    public function history($advertisementId)
    {
        $denunciations = Denunciation::with(['creator', 'reason', 'validator'])
            ->where('advertisement_id', $advertisementId)
            ->orderBy('submitted_at', 'desc')
            ->paginate(10);

        // Define columns for the history table
        $columns = [
            function($item) { return $item->id; },
            function($item) { return $item->reason->name ?? 'N/A'; },
            function($item) { return $item->creator->name ?? 'N/A'; },
            function($item) { return $item->submitted_at ? $item->submitted_at->format('d/m/Y H:i') : 'N/A'; },
            function($item) {
                switch($item->report_state) {
                    case 0: return '<span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-medium">Por Resolver</span>';
                    case 1: return '<span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-medium">Aprovado</span>';
                    case 2: return '<span class="px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs font-medium">Rejeitado</span>';
                    default: return '<span class="px-2 py-1 rounded-full bg-gray-100 text-gray-800 text-xs font-medium">Desconhecido</span>';
                }
            },
            function($item) {
                return $item->validator ? $item->validator->name : 'N/A';
            },
        ];

        $data = [
            'section' => [
                'title' => 'Histórico de Denúncias',
                'filters' => ['Todos', 'Por Resolver', 'Aprovados', 'Rejeitados'],
                'headers' => ['ID', 'Motivo', 'Denunciante', 'Data', 'Estado', 'Validado por'],
            ],
            'paginator' => $denunciations,
            'columns' => $columns,
            'advertisementId' => $advertisementId
        ];

        return view('pages.moderation.partials.reported-advertisements.history', $data);
    }
}
