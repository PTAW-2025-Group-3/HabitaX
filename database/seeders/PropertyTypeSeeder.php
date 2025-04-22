<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Apartamento', 'description' => 'Unidade habitacional num edifício partilhado.'],
            ['name' => 'Moradia', 'description' => 'Casa independente, muitas vezes com jardim.'],
            ['name' => 'Estúdio', 'description' => 'Espaço habitacional com divisão única.'],
            ['name' => 'Quarto', 'description' => 'Parte de um imóvel para arrendamento individual.'],
            ['name' => 'Terreno', 'description' => 'Parcela de terra para construção ou cultivo.'],
            ['name' => 'Armazém', 'description' => 'Espaço para armazenamento ou logística.'],
            ['name' => 'Loja', 'description' => 'Espaço comercial para venda a retalho.'],
            ['name' => 'Escritório', 'description' => 'Espaço para atividades profissionais e administrativas.'],
            ['name' => 'Garagem', 'description' => 'Espaço para estacionamento ou arrumação.'],
            ['name' => 'Prédio', 'description' => 'Edifício completo composto por várias frações.'],
        ];

        foreach ($types as $type) {
            PropertyType::factory()
                ->create([
                    'name' => $type['name'],
                    'description' => $type['description'],
                    'is_active' => true,
                ]);
        }
    }
}

