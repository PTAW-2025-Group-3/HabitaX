<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::orderBy('created_at', 'desc')
            ->with('processed_by')
            ->paginate(10);
        return view('moderation.contact-us.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'required|regex:/^(\+[0-9]{1,3})?[0-9]{9,15}$/|min:9',
            'message' => 'required|string|min:10',
        ], [
            'telephone.regex' => 'O número de telefone deve conter apenas dígitos e pode começar com + seguido do código do país.'
        ]);

        ContactUs::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'message' => $request->message,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Contacto submetido com sucesso!'
            ]);
        }

        return redirect()->route('home')->with('success', 'Mensagem enviada com sucesso!');
    }

    public function show($id)
    {
        $contact = ContactUs::findOrFail($id);
        return view('moderation.contact-us.show', compact('contact'));
    }

    public function markAsRead($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->is_processed = !$contact->is_processed;
        $contact->processed_by_id = $contact->is_processed ? auth()->id() : null;
        $contact->save();

        return redirect()->route('contact-us.index')
            ->with('success', $contact->is_processed ? 'Mensagem marcada como processada!' : 'Mensagem desmarcada como processada!');
    }

    public function ajaxIndex(Request $request)
    {
        $query = ContactUs::query()->with('processed_by');

        // Aplicar filtro
        if ($request->filled('filter')) {
            $filter = $request->input('filter');
            if ($filter === 'processed') {
                $query->where('is_processed', true);
            } elseif ($filter === 'not-processed') {
                $query->where('is_processed', false);
            }
        }

        // Aplicar busca
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->whereRaw("LOWER(CONCAT(first_name, ' ', last_name)) LIKE ?", ['%' . strtolower($search) . '%'])
                    ->orWhereRaw("LOWER(email) LIKE ?", ['%' . strtolower($search) . '%']);
            });
        }

        // Ordenar por data de criação (mais recentes primeiro)
        $query->orderBy('updated_at', 'desc');

        // Paginar resultados
        $contacts = $query->paginate(10);

        // Adicionar parâmetros à paginação
        $contacts->appends($request->except('page'));

        // Renderizar os links da paginação para HTML
        $links = $contacts->links()->toHtml();

        return response()->json([
            'contacts' => $contacts,
            'total' => $contacts->total(),
            'links' => $links
        ]);
    }

}
