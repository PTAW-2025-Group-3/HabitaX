<?php

namespace App\Http\Controllers;

use App\Enums\AttributeType;
use App\Models\PropertyAttribute;
use App\Models\PropertyAttributeOption;
use Illuminate\Http\Request;

class PropertyAttributeController extends Controller
{
    public function index(Request $request)
    {
        $attributes = PropertyAttribute::orderBy('updated_at', 'desc')->paginate(10);
        return view('attributes.index', compact('attributes'));
    }

    public function create()
    {
        $attributeTypes = AttributeType::cases();
        return view('attributes.create', compact('attributeTypes'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'is_required' => $request->has('is_required') ? 1 : 0,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        $request->validate([
            'name' => 'required|string|max:255|unique:property_attributes,name',
            'description' => 'nullable|string',
            'type' => 'required|string|in:' . implode(',', array_map(fn($type) => $type->value, AttributeType::cases())),
            'is_active' => 'required|boolean',
            'is_required' => 'required|boolean',
            'min_value' => 'nullable|numeric',
            'max_value' => 'nullable|numeric',
            'unit' => 'nullable|string|max:50',
            'min_length' => 'nullable|integer',
            'max_length' => 'nullable|integer',
            'min_date' => 'nullable|date_format:Y-m-d',
            'max_date' => 'nullable|date_format:Y-m-d',
            'min_options' => 'nullable|integer|less_than:max_options',
            'max_options' => 'nullable|integer|greater_than:min_options',
        ]);

        PropertyAttribute::create($request->all());

        return redirect()->route('attributes.index')->with('success', 'Property attribute created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $attribute = PropertyAttribute::findOrFail($id);
        $attributeTypes = AttributeType::cases();

        return view('attributes.edit', compact('attribute', 'attributeTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'is_required' => $request->has('is_required') ? 1 : 0,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        $request->validate([
            'name' => 'required|string|max:255|unique:property_attributes,name,' . $id,
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'is_required' => 'required|boolean',
            'min_value' => 'nullable|numeric',
            'max_value' => 'nullable|numeric',
            'unit' => 'nullable|string|max:50',
            'min_length' => 'nullable|integer',
            'max_length' => 'nullable|integer',
            'min_date' => 'nullable|date_format:Y-m-d',
            'max_date' => 'nullable|date_format:Y-m-d',
            'min_options' => 'nullable|integer',
            'max_options' => 'nullable|integer',
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
