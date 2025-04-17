<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyType;
use App\Models\PropertyAttribute;
use App\Models\PropertyTypeAttribute;

class PropertyTypeAttributeSeeder extends Seeder
{
    public function run(): void
    {
        // Exemplo de atributos existentes
        $attrs = PropertyAttribute::pluck('id', 'name')->toArray();
        $types = PropertyType::pluck('id', 'name')->toArray();

        // Associação para "Apartamento"
        if (isset($types['Apartamento'])) {
            PropertyTypeAttribute::create([
                'property_type' => $types['Apartamento'],
                'attribute_id' => $attrs['Número de Quartos'] ?? null,
                'required' => true,
            ]);

            PropertyTypeAttribute::create([
                'property_type' => $types['Apartamento'],
                'attribute_id' => $attrs['Tem Elevador'] ?? null,
                'required' => false,
            ]);
        }

        // Associação para "Moradia"
        if (isset($types['Moradia'])) {
            PropertyTypeAttribute::create([
                'property_type' => $types['Moradia'],
                'attribute_id' => $attrs['Número de Quartos'] ?? null,
                'required' => true,
            ]);

            PropertyTypeAttribute::create([
                'property_type' => $types['Moradia'],
                'attribute_id' => $attrs['Vista'] ?? null,
                'required' => false,
            ]);
        }
    }
}
