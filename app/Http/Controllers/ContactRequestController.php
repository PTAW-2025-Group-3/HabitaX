<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    public function index(Request $request)
    {
        // Check if user has any advertisements (is an advertiser)
        $isAdvertiser = auth()->user()->is_advertiser;

        // Default to 'sent' for non-advertisers, otherwise use the request parameter
        $requestType = $isAdvertiser ? $request->get('type', 'received') : 'sent';

        // Obter parâmetros de filtro
        $status = $request->get('status', 'all');
        $advertisementId = $request->get('advertisement_id');
        $userType = $request->get('user_type', 'all');
        $search = $request->get('search');

        // Query base para anúncios
        $adsQuery = Advertisement::query();

        if ($requestType === 'received') {
            $adsQuery->where('created_by', auth()->user()->id)
                ->whereHas('requests')
                ->orderBy('created_at', 'desc');

            // Query base para mensagens recebidas
            $messagesQuery = ContactRequest::with('user')
                ->whereHas('advertisement', function ($query) {
                    $query->where('created_by', auth()->user()->id);
                });
        } else {
            $adsQuery->whereHas('requests', function($query) {
                $query->where('created_by', auth()->id());
            })
                ->orderBy('created_at', 'desc');

            // Query base para mensagens enviadas
            $messagesQuery = ContactRequest::with(['advertisement.creator'])
                ->where('created_by', auth()->id());
        }

        // Aplicar filtros à query
        if ($status !== 'all') {
            $messagesQuery->where('state', $status);
        }

        if ($advertisementId) {
            $messagesQuery->where('advertisement_id', $advertisementId);
        }

        if ($userType !== 'all' && $requestType === 'received') {
            if ($userType === 'registered') {
                $messagesQuery->whereNotNull('created_by');
            } elseif ($userType === 'guest') {
                $messagesQuery->whereNull('created_by');
            }
        }

        if ($search) {
            $messagesQuery->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Ordenar e paginar
        $messages = $messagesQuery->orderBy('created_at', 'desc')->paginate(5);
        $ads = $adsQuery->get();

        // Para requisições AJAX, retornar dados JSON
        if ($request->ajax()) {
            $view = view('contact-requests.message-list', compact('messages', 'requestType', 'isAdvertiser'))->render();
            $pagination = view('vendor.pagination.tailwind', ['paginator' => $messages])->render();

            return response()->json([
                'html' => $view,
                'pagination' => $pagination,
                'count' => $messages->count()
            ]);
        }

        return view('contact-requests.index', compact('messages', 'ads', 'requestType', 'isAdvertiser'));
    }

    public function store(Request $request)
    {
        $messages = [
            'telephone.regex' => 'O número de telefone deve ser um número português válido (9 dígitos começando com 2, 3 ou 9, com ou sem o prefixo +351).',
            'name.regex' => 'O nome deve conter apenas letras, espaços, hífens ou apóstrofos.',
        ];

        $validated = $request->validate([
            'advertisement_id' => 'required|exists:advertisements,id',
            'name' => 'required|string|max:255|regex:/^[\pL\s\-\']+$/u',
            'email' => 'required|email',
            'telephone' => [
                'required',
                'regex:/^(\+351)?[2,3,9]\d{8}$/',
            ],
            'message' => 'required|string|min:10',
            'privacy_policy' => 'required|accepted',
        ], $messages);

        // Verificar se o utilizador logado é o dono do anúncio
        if (auth()->check()) {
            $advertisement = Advertisement::find($validated['advertisement_id']);

            if ($advertisement->created_by == auth()->id()) {
                $errorMessage = 'Não é possível contactar o seu próprio anúncio.';

                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => $errorMessage,
                        'errors' => ['advertisement_id' => [$errorMessage]]
                    ], 403);
                }

                return redirect()->back()->withErrors(['advertisement_id' => $errorMessage]);
            }
        }

        // Continua com a criação do pedido de contacto
        $contactRequest = ContactRequest::create([
            'advertisement_id' => $validated['advertisement_id'],
            'created_by' => auth()->check() ? auth()->id() : null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'message' => $validated['message'],
            'state' => 'unread',
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pedido de contacto enviado com sucesso!',
                'data' => $contactRequest,
            ]);
        }

        return redirect()->back()->with('success', 'O seu pedido de contacto foi enviado com sucesso!');
    }

    public function updateStatus(Request $request, ContactRequest $contactRequest)
    {
        // Verificar se o utilizador autenticado é dono do anúncio relacionado
        if ($contactRequest->advertisement->created_by !== auth()->id()) {
            abort(403, 'Não autorizado.');
        }

        // Validar o novo estado
        $validated = $request->validate([
            'state' => 'required|in:unread,read,archived',
        ]);

        // Atualizar o estado
        $contactRequest->state = $validated['state'];
        $contactRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado do pedido atualizado com sucesso',
            'data' => $contactRequest
        ]);
    }

}
