<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function listing(Request $request)
    {
        $location = $request->input('location');
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
        ];

        return view('listing', compact('properties', 'location'));
    }


}
