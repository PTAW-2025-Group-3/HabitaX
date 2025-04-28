<?php

namespace App\Http\Controllers;

use App\Models\Property;
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

        return view('properties.create', compact('propertyTypes'));
    }

    public function store(Request $request)
    {
        // TODO: Validate and save the announcement here

        return redirect()->route('properties.my')
            ->with('success', 'Property created successfully!');
    }
}
