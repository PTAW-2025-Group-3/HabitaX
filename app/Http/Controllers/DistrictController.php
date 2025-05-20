<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::query()
            ->with('municipalities')
            ->orderBy('name')
            ->paginate(10);

        return view('administration.districts.index', compact('districts'));
    }

    public function edit($id)
    {
        $district = District::findOrFail($id);

        return view('administration.districts.edit', compact('district'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
            'show_on_homepage' => 'boolean',
        ]);

        $district = District::findOrFail($id);
        $district->update($request->all());

        return redirect()->route('districts.index')->with('success', 'District updated successfully.');
    }

    public function destroy($id)
    {
        $district = District::findOrFail($id);
        $district->delete();

        return redirect()->route('districts.index')->with('success', 'District deleted successfully.');
    }
}
