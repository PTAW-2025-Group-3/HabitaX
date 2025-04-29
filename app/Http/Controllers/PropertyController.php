<?php

namespace App\Http\Controllers;

use App\Enums\AttributeType;
use App\Models\District;
use App\Models\Property;
use App\Models\PropertyAttribute;
use App\Models\PropertyParameter;
use App\Models\PropertyParameterOption;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request) {
        $properties = Property::orderBy('created_at', 'desc')->paginate(10);
        return view('properties.index', compact('properties'));
    }

    public function my(Request $request) {
        $properties = auth()->user()->properties()
            ->with('property_type')
            ->with('parish')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('properties.my', compact('properties'));
    }

    public function show(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        return view('properties.show', compact('property'));
    }

    public function create(Request $request)
    {
        $propertyTypes = PropertyType::where('is_active', true)
            ->with('attributes')
            ->with('attributes.options')
            ->orderBy('name')
            ->get();

        $districts = District::orderBy('name')->get();

        return view('properties.create', compact('propertyTypes', 'districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'property_type_id' => 'required|exists:property_types,id',
            'parish_id' => 'nullable|exists:parishes,id',
            'images.*' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $property = Property::create([
            'title' => $request->title,
            'description' => $request->description,
            'property_type_id' => $request->property_type_id,
            'parish_id' => $request->parish_id,
            'created_by' => auth()->id(),
        ]);

        if ($request->hasFile('images')) {
            //
        }

//        if ($request->has('parameters')) {
//            foreach ($request->parameters as $attributeId => $optionId) {
//                $property->attributes()->attach($attributeId, ['option_id' => $optionId]);
//            }
//        }

        return redirect()->route('properties.edit', $property->id)
            ->with('success', 'Property created successfully!');
    }

    public function edit(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if (auth()->id() != $property->created_by) {
            return redirect()->route('properties.index')
                ->with('error', 'You are not authorized to update this property.');
        }

        $property->load(
            'property_type',
            'property_type.attributes.options',
            'parish',
            'parameters'
        );

        $attributes = $property->type->attributes()
            ->with('options')
            ->orderBy('name')
            ->get();

        $parameters = $property->parameters()->get();

        return view('properties.edit', compact('property', 'attributes', 'parameters'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if (auth()->id() != $property->created_by) {
            return redirect()->route('properties.index')
                ->with('error', 'You are not authorized to update this property.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'property_type_id' => 'required|exists:property_types,id',
            'parish_id' => 'nullable|exists:parishes,id',
            'images.*' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $property->update([
            'title' => $request->title,
            'description' => $request->description,
            'property_type_id' => $request->property_type_id,
            'parish_id' => $request->parish_id,
            'updated_by' => auth()->id(),
        ]);

        if ($request->hasFile('images')) {
            // implement later with laravel media library
        }

        //        // Handle the attributes
        $attributesData = $request->input('attributes', []);

        foreach ($attributesData as $attributeId => $value) {
            $attribute = PropertyAttribute::find($attributeId);

            if (!$attribute) {
                continue;
            }

            if ($attribute->type === AttributeType::SELECT_MULTIPLE) {
                // 1. Delete existing options
                PropertyParameterOption::where('property_id', $property->id)
                    ->where('attribute_id', $attributeId)
                    ->delete();

                if (is_array($value)) {
                    // 2. Save new options
                    foreach ($value as $optionId) {
                        PropertyParameterOption::create([
                            'property_id' => $property->id,
                            'attribute_id' => $attributeId,
                            'option_id' => $optionId,
                        ]);
                    }
                }
            } else {
                PropertyParameter::updateOrCreate(
                    [
                        'property_id' => $property->id,
                        'attribute_id' => $attributeId,
                    ],
                    [
                        'value' => is_array($value) ? json_encode($value) : $value,
                    ]
                );
            }
        }

        return redirect()->route('properties.edit', $property->id)
            ->with('success', 'Property updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if(auth()->id() == $property->created_by) {
            $property->delete();
        } else {
            return redirect()->route('properties.index')
                ->with('error', 'You are not authorized to delete this property.');
        }

        return redirect()->route('properties.index')
            ->with('success', 'Property deleted successfully!');
    }
}
