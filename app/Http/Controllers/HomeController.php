<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Property;
use App\Models\PropertyType;

class HomeController extends Controller
{
    public function index()
    {
        $featuredAds = Advertisement::with('property')
            ->take(8)
            ->get();
        $propertyTypes = PropertyType::where('is_active', true)
            ->withCount('properties')
            ->orderBy('id')
            ->get();

        return view('pages.home.home', compact('featuredAds', 'propertyTypes'));
    }
}
