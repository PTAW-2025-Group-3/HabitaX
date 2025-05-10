<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::orderBy('updated_at', 'desc')
            ->with('processed_by')
            ->paginate(10);
        return view('contact-us.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'required|string|min:9',
            'message' => 'required|string|min:10',
        ]);

        ContactUs::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'message' => $request->message,
        ]);

        return redirect()->route('home')->with('success', 'Mensagem enviada com sucesso!');
    }

    public function show($id)
    {
        $contact = ContactUs::findOrFail($id);
        return view('contact-us.show', compact('contact'));
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
}
