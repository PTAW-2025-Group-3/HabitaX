<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Property;
use App\Models\PropertyType;
use App\Services\PropertyAttributeService;
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
            'cover' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'images' => 'nullable|array|max:20',
            'images.*' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $property = Property::create([
            'title' => $request->title,
            'description' => $request->description,
            'property_type_id' => $request->property_type_id,
            'parish_id' => $request->parish_id,
            'created_by' => auth()->id(),
        ]);

        if ($request->hasFile('cover')) {
            $property->addMediaFromRequest('cover')->toMediaCollection('cover');
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $property->addMedia($image)->toMediaCollection('images');
            }
        }

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
            'images.*' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $property->update(array_merge($validated, ['updated_by' => auth()->id()]));

        // Удаление старых
        $deleted = json_decode($request->input('deleted_images', '[]'));
        if (is_array($deleted)) {
            foreach ($deleted as $mediaId) {
                $media = $property->getMedia('images')->firstWhere('id', $mediaId);
                if ($media) {
                    $media->delete();
                }
            }
        }

        // Порядок (опционально)
        $imageOrder = json_decode($request->input('image_order', '[]'));
        if (is_array($imageOrder)) {
            foreach ($imageOrder as $index => $entry) {
                if (!empty($entry->id)) {
                    $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($entry->id);
                    if ($media) {
                        $media->order_column = $index + 1;
                        $media->save();
                    }
                }
            }
        }

        // Добавление новых
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $property->addMedia($image)->toMediaCollection('images');
            }
        }


        app(PropertyAttributeService::class)->updateAttributes($property, $request->input('attributes', []));

        return redirect()->route('properties.edit', $property->id)
            ->with('success', 'Property updated successfully!');
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
            ->with('success', 'Property deleted successfully!');
    }
}
