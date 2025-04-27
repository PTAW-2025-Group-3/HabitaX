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
        $isAdvertiser = Advertisement::where('created_by', auth()->id())->exists();

        // Default to 'sent' for non-advertisers, otherwise use the request parameter
        $requestType = $isAdvertiser ? $request->get('type', 'received') : 'sent';

        if ($requestType === 'received') {
            // Anúncios para filtro (para pedidos recebidos)
            $ads = Advertisement::where('created_by', auth()->user()->id)
                ->whereHas('requests')
                ->orderBy('created_at', 'desc')
                ->get();

            // Pedidos recebidos (para anúncios do utilizador)
            $messages = ContactRequest::with('user')
                ->whereHas('advertisement', function ($query) {
                    $query->where('created_by', auth()->user()->id);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            // Anúncios para filtro (anúncios aos quais o utilizador enviou mensagens)
            $ads = Advertisement::whereHas('requests', function($query) {
                $query->where('created_by', auth()->id());
            })
                ->orderBy('created_at', 'desc')
                ->get();

            // Pedidos enviados pelo utilizador
            $messages = ContactRequest::with(['advertisement.user'])
                ->where('created_by', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('contact-requests.index', compact('messages', 'ads', 'requestType', 'isAdvertiser'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'advertisement_id' => 'required|exists:advertisements,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'required|string|min:9',
            'message' => 'required|string|min:10',
        ]);

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
