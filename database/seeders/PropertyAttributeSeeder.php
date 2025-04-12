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
                'minimal_value' => 0,
                'maximal_value' => 10,
            ],
            [
                'name' => 'Número de Casas de Banho',
                'type' => 'number',
                'minimal_value' => 0,
                'maximal_value' => 5,
            ],
            [
                'name' => 'Tem Elevador',
                'type' => 'boolean',
            ],
            [
                'name' => 'Vista',
                'type' => 'select',
                'options' => ['Rio', 'Montanha', 'Cidade'],
            ],
            [
                'name' => 'Notas Adicionais',
                'type' => 'text',
                'min_char' => 10,
                'max_char' => 255,
            ],
        ];

        foreach ($attributes as $attr) {
            PropertyAttribute::firstOrCreate(
                ['name' => $attr['name']],
                array_merge([
                    'isActive' => true,
                ], $attr)
            );
        }
    }
}
