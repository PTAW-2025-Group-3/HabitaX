<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Property;
use App\Models\PropertyType;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Obter os 8 anúncios em destaque com imagens
        $featuredAds = Advertisement::with('property')
            ->take(8)
            ->get();

        // 2. Buscar dinamicamente todos os tipos ativos
        $propertyTypes = PropertyType::where('is_active', true)
            ->withCount('properties')
            ->orderBy('id')
            ->get();

        // 3. Enviar para a view
        return view('pages.home.home', [
            'featuredAds' => $featuredAds,
            'propertyTypes' => $propertyTypes,
        ]);
    }

}
