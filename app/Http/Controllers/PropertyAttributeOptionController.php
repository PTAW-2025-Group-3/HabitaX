<?php

namespace App\Http\Controllers;

use App\Models\PropertyAttribute;
use App\Models\PropertyAttributeOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyAttributeOptionController extends Controller
{
    public function index($id)
    {
        $attribute = PropertyAttribute::findOrFail($id);
        $options = $attribute->options()->orderBy('created_at', 'desc');
        return view('attribute-options.index', compact('attribute', 'options'));
    }

    public function create($id)
    {
        $attribute = PropertyAttribute::findOrFail($id);
        return view('attribute-options.create', compact('attribute'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        PropertyAttributeOption::create([
            'name' => $request->name,
            'order' => $request->order,
            'attribute_id' => $request->id,
        ]);

        return redirect()->route('attribute-options.index', $request->id)
            ->with('success', 'Option created successfully.');
    }

    public function edit($id)
    {
        $option = PropertyAttributeOption::findOrFail($id);
        return view('attribute-options.edit', compact('option'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $option = PropertyAttributeOption::findOrFail($id);

        $option->update([
            'name' => $request->name,
            'order' => $request->order,
        ]);

        return redirect()->route('attribute-options.index', $option->attribute_id)
            ->with('success', 'Option updated successfully.');
    }

    public function destroy($id)
    {
        $option = PropertyAttributeOption::findOrFail($id);
        $attributeId = $option->attribute_id;
        $option->delete();

        return redirect()->route('attribute-options.index', $attributeId)
            ->with('success', 'Option deleted successfully.');
    }
}
