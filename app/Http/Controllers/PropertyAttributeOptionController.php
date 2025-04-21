<?php

namespace App\Http\Controllers;

use App\Models\PropertyAttributeOption;
use Illuminate\Http\Request;

class PropertyAttributeOptionController extends Controller
{
    public function index(Request $request)
    {
        $options = PropertyAttributeOption::where('property_attribute_id', $request->input('attribute_id'))
            ->orderBy('created_at', 'desc');
        return view('attribute-options.index', compact('options'));
    }

    public function create()
    {
        // Logic to show form for creating a new property attribute option
    }

    public function store(Request $request)
    {
        // Logic to store a new property attribute option
    }

    public function edit($id)
    {
        // Logic to show form for editing an existing property attribute option
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing property attribute option
    }

    public function destroy($id)
    {
        // Logic to delete a property attribute option
    }
}
