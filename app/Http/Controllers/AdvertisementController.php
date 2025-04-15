<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\PriceHistory;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertisementController extends Controller
{
    public function index(Request $request)
    {
        $location = $request->input('location');
        /*
        $properties = [
            [
                'image' => 'images/properties/mesao-frio.jpg',
                'title' => 'Moradia em Zona Histórica de Aveiro',
                'location' => 'Beira-Mar, Glória e Vera Cruz',
                'price' => '275.000€',
                'details' => 'T4 · 192m² área bruta',
                'description' => 'Fantástica moradia T5, composta por 4 suítes, 1 quarto, sala de estar, sala de jantar, cozinha, lavandaria, varandas, terraço, piscina e ginásio.',
                'logo' => 'images/agents/img.png',
                'agency' => 'Home LUSA'
            ],
            [
                'image' => 'images/properties/espinho.jpg',
                'title' => 'Moradia T3 com Jardim Privado',
                'location' => 'Esgueira, Aveiro',
                'price' => '495.000€',
                'details' => 'T3 · 190m² área bruta',
                'description' => 'Situada na freguesia norte de Esgueira, esta moradia T3 oferece um refúgio perfeito para famílias...',
                'logo' => 'images/agents/img_2.png',
                'agency' => 'Arcada'
            ],
            [
                'image' => 'images/properties/braga.jpg',
                'title' => 'Moradia T4 Contemporânea com Piscina',
                'location' => 'Costa, Aveiro',
                'price' => '430.000€',
                'details' => 'T4 · 230m² área bruta',
                'description' => 'Esta impressionante moradia T4 combina design moderno e funcionalidade...',
                'logo' => 'images/agents/img_3.png',
                'agency' => 'ERA'
            ],
            [
                'image' => 'images/properties/vila-nova.jpg',
                'title' => 'Moradia T5 Minimalista com Vista Ria',
                'location' => 'Esgueira, Aveiro',
                'price' => '720.000€',
                'details' => 'T5 · 290m² área bruta',
                'description' => 'Esta elegante moradia T5 minimalista apresenta um design contemporâneo...',
                'logo' => 'images/agents/img.png',
                'agency' => 'Home LUSA'
            ]
        ];*/
        // esta mal mas por agora deixa estar
        $advertisements = Advertisement::where('state', 'active')
            ->when($location, function ($query) use ($location) {
                return $query->where('location', 'LIKE', "%{$location}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        foreach ($advertisements as $ad) {
            $ad->property = Property::find($ad->property_id);
        }
        $totalResults = $advertisements->total();

        return view('pages.advertisements.index', compact('advertisements', 'location', 'totalResults'));
    }

    public function show($id)
    {
        /*
        $ad = [
            'title' => 'Casa da Pedreira - Casa de Hóspedes Elegante C/Piscina Privada',
            'images' => ['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg', 'img5.jpg'],
            'type' => 'Alojamento Inteiro - Moradia',
            'location' => 'Gemeses, Portugal',
            'details' => 'Independente | T4 | 192m² área bruta | Garagem Incluída | Piscina Exterior | Jardim Interior | 3 WC',
            'price' => 495000,
            'description' => 'Descubra esta fantástica moradia T4 em Gemeses...',
            'equipments' => ['Sistema de ar condicionado', 'Painéis solares', 'Piscina exterior', 'Garagem'],
            'specs' => ['T4 | 192m² de área bruta', '3 casas de banho', 'Classe A', 'Aquecimento central', 'Jardim com área interior', 'Ano: 2023', 'Garagem: 3 lugares'],
            'months' => ['Jan', 'Fev', 'Mar'],
            'price_history' => [470000, 475000, 480000, 478000, 485000, 488000, 495000],
            'area_average' => 350000,
            'monthly_ads' => [22, 19, 25, 21, 35, 28],
        ];*/
        $ad = Advertisement::find($id);
        $property = Property::find($ad->property_id);
        $price_history = PriceHistory::where('advertisement_id', $ad->id)
            ->orderBy('register_date', 'desc')
            ->take(6)
            ->get()
            ->map(function ($item) {
                return [
                    'price' => $item->price,
                    'date' => $item->register_date->format('d/m/Y'),
                ];
            })
            ->toArray();

        return view('pages.advertisements.show', ['ad' => $ad, 'property' => $property, 'price_history' => $price_history]);
    }


    // Show the Create Announcement Form
    public function create()
    {
        return view('pages.createad.create');
    }

    // Handle the form submission and store the announcement
    public function store(Request $request)
    {
        // TODO: Validate and save the announcement here

        return redirect()->route('dashboard')->with('success', 'Announcement created successfully.');
    }
}
