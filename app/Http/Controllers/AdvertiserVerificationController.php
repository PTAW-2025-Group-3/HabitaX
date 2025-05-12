<?php

namespace App\Http\Controllers;

use App\Models\AdvertiserVerification;
use Illuminate\Http\Request;

class AdvertiserVerificationController extends Controller
{
    /**
     * Exibe a lista de verificações de anunciantes
     */
    public function index()
    {
        $verifications = AdvertiserVerification::with('submitter')
            ->orderBy('submitted_at', 'desc')
            ->paginate(5);

        return view('pages.moderation.verification-advertiser', [
            'verifications' => $verifications
        ]);
    }

    /**
     * Busca verificações de anunciantes via AJAX
     */
    public function ajaxVerifications(Request $request)
    {
        $query = AdvertiserVerification::with('submitter');

        // Filtrar por estado se solicitado
        if ($request->has('filter') && $request->filter !== 'all') {
            $stateMap = [
                'pending' => 0,
                'approved' => 1,
                'rejected' => 2
            ];

            if (array_key_exists($request->filter, $stateMap)) {
                $query->where('verification_advertiser_state', $stateMap[$request->filter]);
            }
        }

        // Pesquisar por nome ou telefone do anunciante
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('submitter', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('telephone', 'like', "%{$search}%");
            });
        }

        // Paginação
        $verifications = $query->orderBy('submitted_at', 'desc')->paginate(5);

        // Mapear verificações com dados necessários
        $verificationsData = $verifications->map(function($verification) {
            $state = '';
            if ($verification->verification_advertiser_state === 0) {
                $state = 'pending';
            } elseif ($verification->verification_advertiser_state === 1) {
                $state = 'approved';
            } else {
                $state = 'rejected';
            }

            return [
                'id' => $verification->id,
                'submitter' => [
                    'name' => $verification->submitter->name ?? 'N/A',
                    'telephone' => $verification->submitter->telephone ?? 'N/A'
                ],
                'identifier_type' => $verification->identifier_type ?? 'N/A',
                'verification_advertiser_state' => $verification->verification_advertiser_state,
                'submitted_at' => $verification->submitted_at
            ];
        });

        return response()->json([
            'verifications' => $verificationsData,
            'pagination' => $verifications->links()->toHtml(),
            'total' => $verifications->total(),
            'from' => $verifications->firstItem(),
            'to' => $verifications->lastItem()
        ]);
    }

    /**
     * Exibe os detalhes de uma verificação específica
     */
    public function show($id)
    {
        $verification = AdvertiserVerification::with(['submitter', 'validator'])->findOrFail($id);

        return view('pages.moderation.partials.verification-advertisers.verification-advertiser', [
            'verification' => $verification
        ]);
    }

    public function create()
    {
        $documentTypes = \App\Models\DocumentType::all();
        return view('account.advertiser-verification', compact('documentTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_type_id' => 'required|exists:document_types,id',
            'document_number' => 'required|string|max:255',
            'identification_documents' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'identity_verifications' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        $verification = AdvertiserVerification::create([
            'document_type_id' => $request->document_type_id,
            'document_number' => $request->document_number,
            'submitted_by' => auth()->id(),
            'submitted_at' => now(),
        ]);

        $verification->addMedia($request->file('identification_documents'))
            ->toMediaCollection('identification_documents');
        $verification->addMedia($request->file('identity_verifications'))
            ->toMediaCollection('identity_verifications');

        return redirect()->route('advertiser-verification.create')
            ->with('success', 'Verificação de anunciante submetida com sucesso!');
    }

    public function updateState(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'state' => 'required|in:1,2',
                'comments' => 'nullable|string|max:500'
            ]);

            $verification = AdvertiserVerification::findOrFail($id);
            $verification->verification_advertiser_state = $validated['state'];
            $verification->validator_comments = $validated['comments'] ?? null;
            $verification->validated_by = auth()->id();
            $verification->validated_at = now();
            $verification->save();

            // Aqui gera-se o caralho do número do anunciante caso o estado seja 1
            if ($validated['state'] == 1 && $verification->submitter && !$verification->submitter->is_advertiser) {
                $verification->submitter->update([
                    'is_advertiser' => true
                ]);
            }

            // Verificar se é uma requisição AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Estado da verificação atualizado com sucesso.',
                    'redirect' => route('moderation')
                ]);
            }

            // Mensagem de sucesso baseada no estado
            $message = $validated['state'] == 1
                ? 'Verificação aprovada com sucesso!'
                : 'Verificação rejeitada com sucesso!';

            // Redirecionar com mensagem flash... ainda tenho de ver isto melhor to/do
            return redirect()
                ->route('moderation')
                ->with('success', $message);
        } catch (\Exception $e) {
            \Log::error('Erro ao atualizar verificação: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao atualizar verificação: ' . $e->getMessage()
                ], 500);
            }

            return redirect()
                ->back()
                ->with('error', 'Erro ao atualizar verificação: ' . $e->getMessage());
        }
    }
}
