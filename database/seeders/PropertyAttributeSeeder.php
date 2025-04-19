<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyAttribute;

class PropertyAttributeSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [
            [
                'name' => 'Número de Quartos',
                'type' => 'number',
                'minimal' => 0,
                'maximal' => 10,
            ],
            [
                'name' => 'Número de Casas de Banho',
                'type' => 'number',
                'minimal' => 0,
                'maximal' => 5,
            ],
            [
                'name' => 'Tem Elevador',
                'type' => 'boolean',
            ],
            [
                'name' => 'Vista',
                'type' => 'select',
            ],
            [
                'name' => 'Notas Adicionais',
                'type' => 'text',
                'minimal' => 10,
                'maximal' => 255,
            ],
        ];

        foreach ($attributes as $attr) {
            PropertyAttribute::firstOrCreate(
                ['name' => $attr['name']],
                array_merge([
                    'is_active' => true,
                ], $attr)
            );
        }
    }
}
