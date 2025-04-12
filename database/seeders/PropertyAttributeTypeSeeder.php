<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeProperty;
use App\Models\PropertyAttribute;
use App\Models\PropertyAttributeType;

class PropertyAttributeTypeSeeder extends Seeder
{
    public function run(): void
    {
        // Exemplo de atributos existentes
        $attrs = PropertyAttribute::pluck('id', 'name')->toArray();
        $types = TypeProperty::pluck('id', 'name')->toArray();

        // Associação para "Apartamento"
        if (isset($types['Apartamento'])) {
            PropertyAttributeType::create([
                'property_type' => $types['Apartamento'],
                'attribute_id' => $attrs['Número de Quartos'] ?? null,
                'required' => true,
            ]);

            PropertyAttributeType::create([
                'property_type' => $types['Apartamento'],
                'attribute_id' => $attrs['Tem Elevador'] ?? null,
                'required' => false,
            ]);
        }

        // Associação para "Moradia"
        if (isset($types['Moradia'])) {
            PropertyAttributeType::create([
                'property_type' => $types['Moradia'],
                'attribute_id' => $attrs['Número de Quartos'] ?? null,
                'required' => true,
            ]);

            PropertyAttributeType::create([
                'property_type' => $types['Moradia'],
                'attribute_id' => $attrs['Vista'] ?? null,
                'required' => false,
            ]);
        }
    }
}
