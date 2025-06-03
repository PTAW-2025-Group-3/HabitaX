<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Property;
use App\Models\PropertyType;
use App\Services\PropertyAttributeService;
use App\Services\MediaSyncService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            ->whereHas('property_type', function($query) {
                $query->where('is_active', true);
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(9);

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
            'uploaded_images' => 'nullable|array',
            'uploaded_images.*' => 'string',
        ]);

        $property = Property::create([
            'title' => $request->title,
            'description' => $request->description,
            'property_type_id' => $request->property_type_id,
            'parish_id' => $request->parish_id,
            'created_by' => auth()->id(),
        ]);

        app(MediaSyncService::class)
            ->addImages($property, $request->input('uploaded_images', []), 'images');

        return redirect()->route('properties.my', $property->id)
            ->with('success', 'A propriedade foi criada com sucesso!');
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
            'parameters.options'
        );

        $attributes = $property->type->attributes()
            ->with('options')
            ->orderBy('name')
            ->get();

        $parameters = $property->parameters()->get();

        $parameterMap = $parameters->keyBy('attribute_id');

        $parameterOptionMap = $parameters->mapWithKeys(fn($p) => [
            $p->attribute_id => $p->options->pluck('option_id')->toArray()
        ]);

        return view('properties.edit', compact(
            'property',
            'attributes',
            'parameters',
            'parameterMap',
            'parameterOptionMap'
        ));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if (auth()->id() !== $property->created_by) {
            return redirect()->route('properties.index')
                ->with('error', 'You are not authorized to update this property.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'property_type_id' => 'required|exists:property_types,id',
            'parish_id' => 'nullable|exists:parishes,id',
            'uploaded_images' => 'nullable|array',
            'uploaded_images.*' => 'string',
        ]);

        $property->update(array_merge($validated, ['updated_by' => auth()->id()]));

        app(MediaSyncService::class)
            ->syncImages($property, $request->input('uploaded_images', []), 'images');

        app(PropertyAttributeService::class)->updateAttributes(
            $property,
            $request->input('attributes', [])
        );

        return redirect()->route('properties.my', $property->id)
            ->with('success', 'A propriedade foi atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        if(auth()->id() != $property->created_by) {
            return redirect()->route('properties.my')
                ->with('error', 'You are not authorized to delete this property.');
        }

        $property->delete();

        return redirect()->route('properties.my')
            ->with('success', 'A propriedade foi removida com sucesso!');
    }
}
