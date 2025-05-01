<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Property;
use App\Models\PropertyType;
use App\Services\PropertyAttributeService;
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
            'uploaded_images' => 'nullable|array',
            'uploaded_images.*' => 'image|max:2048',
        ]);

        $property = Property::create([
            'title' => $request->title,
            'description' => $request->description,
            'property_type_id' => $request->property_type_id,
            'parish_id' => $request->parish_id,
            'created_by' => auth()->id(),
        ]);

        $files = $request->input('uploaded_images', []);
        foreach ($files as $filename) {
            $filename = trim(basename($filename));
            $tempPath = storage_path('app/public/tmp/uploads/' . $filename);
            if (file_exists($tempPath)) {
                $property->addMedia($tempPath)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
                unlink($tempPath);
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
            'uploaded_images' => 'nullable|array',
            'uploaded_images.*' => 'string',
        ]);

        $property->update(array_merge($validated, ['updated_by' => auth()->id()]));

        $rawInput = $request->input('uploaded_images', []);
        Log::info('Raw uploaded_images from request:', $rawInput);

        $existingFilenames = collect($rawInput)
            ->map(fn($name) => trim(basename($name), "\"'"))
            ->unique()
            ->toArray();

        Log::info('Cleaned uploaded_images:', $existingFilenames);

        $existingMedia = $property->getMedia('images');
        Log::info('Current media in DB:', $existingMedia->pluck('file_name')->toArray());

        // Удалим файлы, которых больше нет в submitted списке
        $existingMedia->each(function ($media) use ($existingFilenames) {
            if (!in_array($media->file_name, $existingFilenames)) {
                Log::info('Deleting media: ' . $media->file_name);
                $media->delete();
            } else {
                Log::info('Keeping media: ' . $media->file_name);
            }
        });

        $existingMediaNames = $property->fresh()->getMedia('images')->pluck('file_name')->toArray();
        Log::info('🔁 Media after deletion:', $existingMediaNames);

        // 🔃 Обновление порядка изображений
        $orderedFilenames = $existingFilenames;
        $mediaItems = $property->getMedia('images');

        foreach ($orderedFilenames as $index => $filename) {
            $media = $mediaItems->firstWhere('file_name', $filename);
            if ($media) {
                $media->order_column = $index + 1;
                $media->save();
                Log::info("Set order for {$filename} → " . ($index + 1));
            } else {
                Log::warning("Could not find media for ordering: {$filename}");
            }
        }

        // Добавление новых изображений
        foreach ($existingFilenames as $filename) {
            if (in_array($filename, $existingMediaNames)) {
                Log::info('📎 Skipping already existing media: ' . $filename);
                continue;
            }

            $tempPath = storage_path('app/public/tmp/uploads/' . $filename);
            Log::info('📥 Checking tempPath for adding: ' . $tempPath);

            if (file_exists($tempPath)) {
                try {
                    $property->addMedia($tempPath)
                        ->preservingOriginal()
                        ->toMediaCollection('images');
                    unlink($tempPath);
                    Log::info('Added and removed temp file: ' . $filename);
                } catch (Exception $e) {
                    Log::error('Failed to add image: ' . $e->getMessage());
                }
            } else {
                Log::warning('Temp file not found: ' . $tempPath);
            }
        }

        app(PropertyAttributeService::class)->updateAttributes(
            $property,
            $request->input('attributes', [])
        );

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
