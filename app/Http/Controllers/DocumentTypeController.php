<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentType::orderBy('name')->paginate(10);
        return view('administration.document-types.index', compact('documentTypes'));
    }

    public function create()
    {
        return view('administration.document-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DocumentType::create($request->all());

        return redirect()->route('document-types.index')->with('success', 'Document type created successfully.');
    }

    public function edit($id)
    {
        $documentType = DocumentType::findOrFail($id);
        return view('administration.document-types.edit', compact('documentType'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $documentType = DocumentType::findOrFail($request->id);
        $documentType->update($request->all());

        return redirect()->route('document-types.index')->with('success', 'Document type updated successfully.');
    }

    public function destroy($id)
    {
        $documentType = DocumentType::findOrFail($id);
        $documentType->delete();

        return redirect()->route('document-types.index')->with('success', 'Document type deleted successfully.');
    }
}
