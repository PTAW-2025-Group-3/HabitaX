<?php

namespace App\Http\Controllers;

use App\Models\GlobalVariable;
use App\Models\PropertyAttribute;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function index()
    {
        $propertyTypes = PropertyType::with('attributes')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('property-types.index', compact('propertyTypes'));
    }

    public function getAttributes($id)
    {
        $propertyType = PropertyType::with('attributes.options')->find($id);

        if (!$propertyType) {
            return response()->json(['success' => false, 'message' => 'Property type not found'], 404);
        }

        return response()->json(['success' => true, 'attributes' => $propertyType->attributes]);
    }

    public function loadAttributes($typeId)
    {
        $attributes = PropertyType::find($typeId)
            ->attributes()
            ->with('options')
            ->orderBy('name')
            ->get();

        return view('properties.create.partials.attributes', compact('attributes'));
    }

    public function create()
    {
        return view('property-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:property_types,name',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
            'show_on_homepage' => 'boolean',
            'uploaded_icon' => 'nullable|string',
        ]);

        $propertyType = PropertyType::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->is_active,
            'show_on_homepage' => $request->show_on_homepage,
        ]);

        $this->attachMedia($request, $propertyType);


        return redirect()->route('property-types.index')->with('success', 'Property type created successfully.');
    }

    public function edit($id)
    {
        $propertyType = PropertyType::findOrFail($id);

        return view('property-types.edit', compact('propertyType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:property_types,name,' . $id,
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
            'show_on_homepage' => 'boolean',
            'uploaded_icon' => 'nullable|string',
        ]);

        $propertyType = PropertyType::findOrFail($id);

        $propertyType->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->is_active,
            'show_on_homepage' => $request->show_on_homepage,
        ]);

        $this->attachMedia($request, $propertyType);


        return redirect()->route('property-types.index')->with('success', 'Property type updated successfully.');
    }

    public function editAttributes(Request $request, $id)
    {
        $maxFilter = GlobalVariable::where('code', 'max_attributes_filter')->value('value');
        $maxList = GlobalVariable::where('code', 'max_attributes_list')->value('value');
        $propertyType = PropertyType::with('typeAttributes')->findOrFail($id);
        $allAttributes = PropertyAttribute::orderBy('type')->get();
        $propertyTypeAttributes = $propertyType->typeAttributes
            ->keyBy('attribute_id')
            ->map(fn($pta) => [
                'show_in_list' => $pta->show_in_list,
                'show_in_filter' => $pta->show_in_filter
            ])
            ->toArray();

        return view('property-types.attributes', compact(
            'maxFilter', 'maxList', 'propertyType', 'allAttributes', 'propertyTypeAttributes'
        ));
    }

    public function updateAttributes(Request $request, $id)
    {
        $propertyType = PropertyType::findOrFail($id);

        if ($request->has('attributes')) {
            $this->syncAttributes($propertyType, $request->input('attributes'));
        }

        return redirect()->route('property-types.index')
            ->with('success', 'Attributes updated successfully.');
    }

    protected function syncAttributes(PropertyType $propertyType, array $attributesData)
    {
        $syncData = [];

        foreach ($attributesData as $attrId => $settings) {
            if (!isset($settings['selected'])) continue;

            $syncData[$attrId] = [
                'show_in_list' => isset($settings['show_in_list']),
                'show_in_filter' => isset($settings['show_in_filter']),
            ];
        }

        $propertyType->attributes()->sync($syncData);
    }

    public function destroy($id)
    {
        $propertyType = PropertyType::findOrFail($id);
        $propertyType->delete();

        return redirect()->route('property-types.index')->with('success', 'Property type deleted successfully.');
    }

    /**
     * @param Request $request
     * @param $type
     * @return void
     */
    public function attachMedia(Request $request, $type): void
    {
        if ($request->has('uploaded_icon')) {
            $filename = trim(basename($request->uploaded_icon), "\"'");

            if ($filename == '') {
                $type->clearMediaCollection('icon');
            } else {
                $tempPath = storage_path('app/public/tmp/uploads/' . $filename);
                if (file_exists($tempPath)) {
                    $type->clearMediaCollection('icon');
                    $type->addMedia($tempPath)
                        ->preservingOriginal()
                        ->toMediaCollection('icon');
                    unlink($tempPath);
                }
            }
        }
    }
}
