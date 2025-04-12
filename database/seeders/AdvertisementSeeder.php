<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Advertisement;
use App\Models\Property;

class AdvertisementSeeder extends Seeder
{
    public function run(): void
    {
        // Verifica se há propriedades disponíveis
        $properties = Property::all();

        if ($properties->isEmpty()) {
            $this->command->warn('Nenhuma propriedade encontrada. Corre o PropertySeeder primeiro.');
            return;
        }

        // Cria 10 anúncios com propriedades existentes
        foreach ($properties->take(10) as $property) {
            Advertisement::create([
                'reference' => fake()->unique()->numberBetween(100000, 999999),
                'description' => fake()->paragraph(3),
                'transaction_type' => fake()->randomElement(['sale', 'rent']),
                'price' => fake()->randomFloat(2, 10000, 750000),
                'state' => fake()->randomElement(['pending', 'active', 'archived']),
                'property_id' => $property->id,
            ]);
        }
    }
}
