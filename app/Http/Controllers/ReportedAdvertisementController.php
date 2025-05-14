<?php

namespace App\Http\Controllers;

use App\Models\Denunciation;
use App\Presenters\DenunciationPresenter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ReportedAdvertisementController extends Controller
{
    public function index()
    {
        $denunciations = Denunciation::with(['creator', 'advertisement', 'reason'])
            ->whereHas('advertisement', function($query) {
                $query->where('is_suspended', false)
                    ->whereHas('creator', function($q) {
                        $q->where('state', 'active');
                    });
            })
            ->orderBy('submitted_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(5);

        // Transform each denunciation into a Presenter
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

    public function ajaxDenunciations(Request $request)
    {
        try {
            $query = Denunciation::with(['creator', 'advertisement', 'reason']);

            // Aplicar filtro
            $filter = $request->input('filter', 'all');
            if ($filter === 'pending') {
                // Para denúncias pendentes, filtramos anúncios não suspensos e usuários ativos
                $query->where('report_state', 0)
                    ->whereHas('advertisement', function($subQuery) {
                        $subQuery->where('is_suspended', false)
                            ->whereHas('creator', function($q) {
                                $q->where('state', 'active');
                            });
                    });
            } elseif ($filter === 'approved') {
                $query->where('report_state', 1);
            } elseif ($filter === 'rejected') {
                $query->where('report_state', 2);
            } else {
                // Para o filtro "Todos", aplicamos uma lógica composta:
                // 1. Incluir todas as denúncias já processadas (aprovadas/rejeitadas)
                // 2. Incluir apenas denúncias pendentes de anúncios não suspensos
                $query->where(function($q) {
                    // Denúncias já processadas (aprovadas ou rejeitadas)
                    $q->whereIn('report_state', [1, 2])
                        // OU denúncias pendentes de anúncios não suspensos
                        ->orWhere(function($subQ) {
                            $subQ->where('report_state', 0)
                                ->whereHas('advertisement', function($adQ) {
                                    $adQ->where('is_suspended', false)
                                        ->whereHas('creator', function($userQ) {
                                            $userQ->where('state', 'active');
                                        });
                                });
                        });
                });
            }

            // Melhorar a funcionalidade de pesquisa
            $search = $request->input('search', '');
            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    // Buscar por título do anúncio
                    $q->whereHas('advertisement', function($subQuery) use ($search) {
                        $subQuery->where('title', 'like', "%{$search}%");
                    })
                        // Buscar por nome do motivo
                        ->orWhereHas('reason', function($subQuery) use ($search) {
                            $subQuery->where('name', 'like', "%{$search}%");
                        })
                        // Buscar por nome do denunciante
                        ->orWhereHas('creator', function($subQuery) use ($search) {
                            $subQuery->where('name', 'like', "%{$search}%");
                        })
                        // Buscar na descrição da denúncia
                        ->orWhere('desc', 'like', "%{$search}%")
                        // Buscar por ID
                        ->orWhere('id', 'like', "%{$search}%");
                });
            }

            // Ordenação padrão
            $query->orderBy('submitted_at', 'desc')
                ->orderBy('id', 'desc');

            $denunciations = $query->paginate(5);

            // Transformar em formato adequado para resposta JSON
            $formattedDenunciations = [];
            foreach ($denunciations as $denunciation) {
                $presenter = new DenunciationPresenter($denunciation);
                $formattedDenunciations[] = [
                    'id' => $presenter->id(),
                    'title' => $presenter->title(),
                    'reason' => $presenter->reason(),
                    'reporter' => $presenter->creator(),
                    'date' => $presenter->submittedAt(),
                    'date_timestamp' => strtotime($denunciation->submitted_at),
                    'state' => strtolower($presenter->state()),
                    'state_badge' => $presenter->stateBadge(),
                    'action_button' => $presenter->actionButton(),
                ];
            }

            // Gerar HTML da paginação
            $paginationHtml = $denunciations->links()->toHtml();

            return response()->json([
                'denunciations' => $formattedDenunciations,
                'pagination' => $paginationHtml,
                'total' => $denunciations->total()
            ]);
        } catch (\Exception $e) {
            // Log do erro
            \Log::error('Erro no Ajax de denúncias: ' . $e->getMessage());

            // Retornar resposta de erro
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $denunciation = Denunciation::with(['creator', 'advertisement', 'reason', 'validator'])
            ->findOrFail($id);

        return view('moderation.partials.reported-advertisements.reported-advertisement', compact('denunciation'));
    }

    public function approve($id)
    {
        $denunciation = Denunciation::findOrFail($id);

        if ($denunciation->report_state !== 0) {
            return back()->with('error', 'Esta denúncia já foi processada.');
        }

        // Inicia uma transação para garantir a integridade dos dados
        \DB::beginTransaction();

        try {
            // Atualiza o estado da denúncia
            $denunciation->update([
                'report_state' => 1, // Aprovado
                'validated_by' => auth()->id(),
                'validated_at' => now()
            ]);

            // Suspende o anúncio denunciado
            $advertisement = $denunciation->advertisement;
            if ($advertisement) {
                $advertisement->is_suspended = true;
                $advertisement->save();
            }

            \DB::commit();
            return redirect()->route('moderation')
                ->with('success', 'Denúncia aprovada com sucesso. O anúncio foi suspenso.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->with('error', 'Erro ao processar a denúncia: ' . $e->getMessage());
        }
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

        return view('moderation.partials.reported-advertisements.history', $data);
    }
}
