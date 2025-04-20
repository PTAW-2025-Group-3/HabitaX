<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    public function index(Request $request)
    {
        $ads = Advertisement::where('created_by', auth()->user()->id)
            ->whereHas('requests')
            ->orderBy('created_at', 'desc')
            ->get();
        $messages = ContactRequest::whereHas('advertisement', function ($query) {
                $query->where('created_by', auth()->user()->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('contact-requests.index', compact('messages', 'ads'));
//        return view('account.contact-requests', compact('messages')); // reservado para comparar com a versão inicial
    }
}
