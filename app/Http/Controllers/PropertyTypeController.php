<?php

namespace App\Http\Controllers;

use App\Models\PropertyAttribute;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function index()
    {
        $propertyTypes = PropertyType::all();

        return view('pages.property-types.index', compact('propertyTypes'));
    }

    public function create()
    {
        return view('pages.property-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        PropertyType::create($request->all());

        return redirect()->route('property-types.index')->with('success', 'Property type created successfully.');
    }

    public function edit($id)
    {
        $propertyType = PropertyType::findOrFail($id);

        return view('pages.property-types.edit', compact('propertyType'));
    }

    public function editAttributes(Request $request, $id)
    {
        $propertyType = PropertyType::findOrFail($id);
        $allAttributes = PropertyAttribute::all();
        $propertyTypeAttributes = $propertyType->attributes()->pluck('property_attribute_id')->toArray();

        return view('pages.property-types.attributes', compact('propertyType', 'allAttributes', 'propertyTypeAttributes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $propertyType = PropertyType::findOrFail($id);
        $propertyType->update($request->all());

        return redirect()->route('property-types.index')->with('success', 'Property type updated successfully.');
    }

    public function updateAttributes(Request $request, $id)
    {
        $propertyType = PropertyType::findOrFail($id);
        $attributes = $request->input('attributes', []);

        // Sync the attributes with the property type
        $propertyType->attributes()->sync($attributes);

        return redirect()->route('property-types.index')->with('success', 'Property type attributes updated successfully.');
    }

    public function destroy($id)
    {
        $propertyType = PropertyType::findOrFail($id);
        $propertyType->delete();

        return redirect()->route('property-types.index')->with('success', 'Property type deleted successfully.');
    }
}
