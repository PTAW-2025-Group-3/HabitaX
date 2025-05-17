<?php

namespace Database\Seeders;

use App\Models\Municipality;
use App\Models\Parish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParishSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Lisboa' => ['Santa Maria Maior', 'Campo de Ourique', 'Benfica'],
            'Sintra' => ['Algueirão-Mem Martins', 'Rio de Mouro'],
            'Porto' => ['Cedofeita', 'Bonfim', 'Paranhos'],
//            'Braga' => ['Sé', 'São Vítor'],
        ];

        foreach ($data as $municipalityName => $parishes) {
            $municipality = Municipality::where('name', $municipalityName)->first();

            foreach ($parishes as $name) {
                Parish::firstOrCreate([
                    'name' => $name,
                    'municipality_id' => $municipality->id
                ]);
            }
        }
    }
}
