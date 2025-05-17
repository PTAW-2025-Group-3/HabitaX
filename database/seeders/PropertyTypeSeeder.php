<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Apartamento', 'description' => 'Unidade habitacional num edifício partilhado.', 'show_on_homepage' => true],
            ['name' => 'Quinta', 'description' => 'Propriedade rural com terreno e edifícios.', 'show_on_homepage' => true],
            ['name' => 'Moradia', 'description' => 'Casa independente, muitas vezes com jardim.', 'show_on_homepage' => true],
            ['name' => 'Estúdio', 'description' => 'Espaço habitacional com divisão única.', 'show_on_homepage' => true],
            ['name' => 'Quarto', 'description' => 'Parte de um imóvel para arrendamento individual.'],
            ['name' => 'Terreno', 'description' => 'Parcela de terra para construção ou cultivo.', 'show_on_homepage' => true],
            ['name' => 'Armazém', 'description' => 'Espaço para armazenamento ou logística.'],
            ['name' => 'Loja', 'description' => 'Espaço comercial para venda a retalho.', 'show_on_homepage' => true],
            ['name' => 'Escritório', 'description' => 'Espaço para atividades profissionais e administrativas.'],
            ['name' => 'Garagem', 'description' => 'Espaço para estacionamento ou arrumação.'],
            ['name' => 'Prédio', 'description' => 'Edifício completo composto por várias frações.'],
        ];

        foreach ($types as $type) {
            $propertyType = PropertyType::factory()
                ->create([
                    'name' => $type['name'],
                    'description' => $type['description'],
                    'is_active' => $type['show_on_homepage'] ?? false,
                    'show_on_homepage' => $type['show_on_homepage'] ?? false,
                ]);
            $this->attachIcon($propertyType);
        }
    }

    private function attachIcon(PropertyType $propertyType): void
    {
        $iconsPath = 'icons/';
        $icons = Storage::disk('public')->files($iconsPath);

        if (count($icons) > 50) {
            // Select a random icon from the existing ones
            $fileName = $icons[array_rand($icons)];
        } else {
            // Fetch a new icon from the URL
            $seed = fake()->uuid;
            $fileName = $iconsPath . 'icon_' . $seed . '.svg';
            $url = "https://api.dicebear.com/7.x/icons/svg?seed={$seed}";

            $response = Http::get($url);

            if ($response->ok()) {
                Storage::disk('public')->put($fileName, $response->body());
            }
        }

        $propertyType->addMedia(storage_path('app/public/' . $fileName))
            ->preservingOriginal()
            ->toMediaCollection('icon');
    }
}
