<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\District;
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

        $transactionType = request('transaction_type', 'sale');
        $selectedType = request('property_type');

        $districts = District::all();

        $newsController = new NewsController();
        $newsView = $newsController->index();
        $news = $newsView->getData()['noticias'] ?? ['items' => []];

        return view('pages.home.home', [
            'districts' => $districts,
            'propertyTypes' => $propertyTypes,
            'selectedType' => $selectedType,
            'transactionType' => $transactionType,
            'featuredAds' => $featuredAds,
            'news' => $news,
        ]);
    }
}
