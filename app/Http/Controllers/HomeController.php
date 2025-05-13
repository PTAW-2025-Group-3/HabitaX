<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\PropertyType;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $featuredAds = Advertisement::with('property')
            ->where('is_published', true)
            ->where('is_suspended', false)
            ->take(8)
            ->get();

        $propertyTypes = PropertyType::where('is_active', true)
            ->where('show_on_homepage', true)
            ->orderBy('name')
            ->get();

        foreach ($propertyTypes as $type) {
            $type->active_ads_count = Advertisement::join('properties', 'advertisements.property_id', '=', 'properties.id')
                ->where('properties.property_type_id', $type->id)
                ->where('advertisements.is_published', true)
                ->where('advertisements.is_suspended', false)
                ->count();
        }

        $transactionType = request('transaction_type', 'sale');
        $selectedType = request('property_type');

        $adsPerDistrict = DB::table('advertisements')
            ->join('properties', 'advertisements.property_id', '=', 'properties.id')
            ->join('property_types', 'properties.property_type_id', '=', 'property_types.id')
            ->join('parishes', 'properties.parish_id', '=', 'parishes.id')
            ->join('municipalities', 'parishes.municipality_id', '=', 'municipalities.id')
            ->join('districts', 'municipalities.district_id', '=', 'districts.id')
            ->where('advertisements.is_published', true)
            ->where('advertisements.is_suspended', false)
            ->where('property_types.is_active', true)
            ->select('districts.id as district_id', 'districts.name as district_name', DB::raw('count(*) as total'))
            ->groupBy('districts.id', 'districts.name')
            ->orderBy('total', 'desc')
            ->get();

        $newsController = new NewsController();
        $newsView = $newsController->index();
        $news = $newsView->getData()['noticias'] ?? ['items' => []];

        return view('pages.home.home', [
            'adsPerDistrict' => $adsPerDistrict,
            'propertyTypes' => $propertyTypes,
            'selectedType' => $selectedType,
            'transactionType' => $transactionType,
            'featuredAds' => $featuredAds,
            'news' => $news,
        ]);
    }
}
