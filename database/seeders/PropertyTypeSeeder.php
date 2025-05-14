<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyType;

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
            PropertyType::factory()
                ->create([
                    'name' => $type['name'],
                    'description' => $type['description'],
                    'is_active' => $type['show_on_homepage'] ?? false,
                    'show_on_homepage' => $type['show_on_homepage'] ?? false,
                ]);
        }
    }
}
