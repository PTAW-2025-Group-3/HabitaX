<?php

namespace App\Http\Controllers;

use App\Models\PropertyAttributeGroup;
use Illuminate\Http\Request;

class PropertyAttributeGroupController extends Controller
{
    public function index(Request $request)
    {
        $groups = PropertyAttributeGroup::orderBy('name')->paginate(10);
        return view('attribute-groups.index', compact('groups'));
    }

    public function create(Request $request)
    {
        return view('attribute-groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:property_attribute_groups,name',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
            'icon' => 'nullable|file|mimes:png,svg,webp|max:2048',
        ]);

        $iconPath = $request->file('icon') ? $request->file('icon')->store('icons', 'public') : null;

        PropertyAttributeGroup::create([
            'name' => $request->name,
            'description' => $request->description,
            'icon_path' => $iconPath,
            'is_active' => $request->is_active,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('attribute-groups.index')->with('success', 'Attribute group created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $group = PropertyAttributeGroup::findOrFail($id);
        return view('attribute-groups.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:property_attribute_groups,name,' . $id,
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
            'icon' => 'nullable|file|mimes:png,svg,webp|max:2048',
        ]);

        $iconPath = $request->file('icon') ? $request->file('icon')->store('icons', 'public') : null;

        PropertyAttributeGroup::findOrFail($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'icon_path' => $iconPath,
            'is_active' => $request->is_active,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('attribute-groups.index')->with('success', 'Attribute group updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $attributeGroup = PropertyAttributeGroup::findOrFail($id);
        $attributeGroup->delete();

        return redirect()->route('attribute-groups.index')->with('success', 'Attribute group deleted successfully.');
    }
}
