<?php

namespace App\Http\Controllers;

use App\Models\SearchFilter;
use Illuminate\Http\Request;

class SearchFilterController extends Controller
{
    public function index()
    {
        // Fetch all search filters
        $searchFilters = SearchFilter::all();

        return view('search_filters.index', compact('searchFilters'));
    }

    public function store(Request $request)
    {
        // Validate and store the new search filter
        $request->validate([
            'name' => 'required|string|max:255',
            'property_type_id' => 'required|exists:property_types,id',
        ]);

        SearchFilter::create(
            $request->all(),
            ['created_by' => auth()->id()]
        );

        return redirect()->route('advertisements.index')->with('success', 'Search filter created successfully.');
    }
}
