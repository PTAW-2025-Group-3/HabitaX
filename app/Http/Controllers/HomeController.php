<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Support\Facades\DB;

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


        $transactionType = request('transaction_type', 'sale');
        $selectedType = request('property_type'); // ex: 2

        $adsPerDistrict = DB::table('advertisements')
            ->join('properties', 'advertisements.property_id', '=', 'properties.id')
            ->join('parishes', 'properties.parish_id', '=', 'parishes.id')
            ->join('municipalities', 'parishes.municipality_id', '=', 'municipalities.id')
            ->join('districts', 'municipalities.district_id', '=', 'districts.id')
            ->where('advertisements.state', 'active')
            ->select('districts.id as district_id', 'districts.name as district_name', DB::raw('count(*) as total'))
            ->groupBy('districts.id', 'districts.name')
            ->orderBy('total', 'desc')
            ->get();

        return view('pages.home.home', [
            'adsPerDistrict' => $adsPerDistrict,
            'propertyTypes' => $propertyTypes,
            'selectedType' => $selectedType,
            'transactionType' => $transactionType,
            'featuredAds' => $featuredAds,
        ]);
    }
}
