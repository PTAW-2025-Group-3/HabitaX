<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request) {
        $properties = Property::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.properties.index', compact('properties'));
    }

    public function my(Request $request) {
        $properties = auth()->user()->properties()
            ->with('property_type')
            ->with('parish')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pages.properties.my', compact('properties'));
    }

    public function show(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        return view('pages.properties.show', compact('property'));
    }

    public function create(Request $request)
    {
        return view('pages.properties.create');
    }

    public function store(Request $request)
    {
        // TODO: Validate and save the announcement here

        return redirect()->route('dashboard')->with('success', 'Announcement created successfully.');
    }
}
