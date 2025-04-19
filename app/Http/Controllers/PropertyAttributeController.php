<?php

namespace App\Http\Controllers;

use App\AttributeType;
use App\Models\PropertyAttribute;
use Illuminate\Http\Request;

class PropertyAttributeController extends Controller
{
    public function index(Request $request)
    {
        $attributes = PropertyAttribute::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.attributes.index', compact('attributes'));
    }

    public function create()
    {
        $attributeTypes = AttributeType::cases();
        return view('pages.attributes.create', compact('attributeTypes'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'is_required' => $request->has('is_required') ? 1 : 0,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:text,number,boolean,select',
            'is_active' => 'required|boolean',
            'is_required' => 'required|boolean',
            'minimal' => 'nullable|numeric',
            'maximal' => 'nullable|numeric',
            'unit' => 'nullable|string|max:50',
        ]);

        PropertyAttribute::create($request->all());

        return redirect()->route('attributes.index')->with('success', 'Property attribute created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $attribute = PropertyAttribute::findOrFail($id);
        $attributeTypes = AttributeType::cases();

        return view('pages.attributes.edit', compact('attribute', 'attributeTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'is_required' => $request->has('is_required') ? 1 : 0,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:text,number,boolean,select',
            'is_active' => 'required|boolean',
            'is_required' => 'required|boolean',
            'minimal' => 'nullable|numeric',
            'maximal' => 'nullable|numeric',
            'unit' => 'nullable|string|max:50',
        ]);

        $attribute = PropertyAttribute::findOrFail($id);
        $attribute->update($request->all());

        return redirect()->route('attributes.index')->with('success', 'Property attribute updated successfully.');
    }

    public function destroy($id)
    {
        $attribute = PropertyAttribute::findOrFail($id);
        $attribute->delete();

        return redirect()->route('attributes.index')->with('success', 'Property attribute deleted successfully.');
    }
}
