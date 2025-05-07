<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PropertyAttributeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'name' => 'Geral',
                'description' => 'Atributos gerais do imóvel',
                'is_active' => true,
            ],
            [
                'name' => 'Estrutura',
                'description' => 'Atributos relacionados à estrutura do imóvel',
                'is_active' => true,
            ],
            [
                'name' => 'Acabamento',
                'description' => 'Atributos relacionados ao acabamento do imóvel',
                'is_active' => true,
            ],
            [
                'name' => 'Instalações',
                'description' => 'Atributos relacionados às instalações do imóvel',
                'is_active' => true,
            ],
            [
                'name' => 'Segurança',
                'description' => 'Atributos relacionados à segurança do imóvel',
                'is_active' => true,
            ],
            [
                'name' => 'Sustentabilidade',
                'description' => 'Atributos relacionados à sustentabilidade do imóvel',
                'is_active' => true,
            ],
            [
                'name' => 'Tecnologia',
                'description' => 'Atributos relacionados à tecnologia do imóvel',
                'is_active' => true,
            ],
            [
                'name' => 'Conectividade',
                'description' => 'Atributos relacionados à conectividade do imóvel',
                'is_active' => true,
            ],
            [
                'name' => 'Conforto',
                'description' => 'Atributos relacionados ao conforto do imóvel',
                'is_active' => true,
            ],
            [
                'name' => 'Acessibilidade',
                'description' => 'Atributos relacionados à acessibilidade do imóvel',
                'is_active' => true,
            ],
            [
                'name' => 'Espaço Externo',
                'description' => 'Atributos relacionados ao espaço externo do imóvel',
                'is_active' => true,
            ],
            [
                'name' => 'Espaço Interno',
                'description' => 'Atributos relacionados ao espaço interno do imóvel',
                'is_active' => true,
            ],
            [
                'name' => 'Localização',
                'description' => 'Atributos relacionados à localização do imóvel',
                'is_active' => true,
            ],
            [
                'name' => 'Infraestrutura',
                'description' => 'Atributos relacionados à infraestrutura do imóvel',
                'is_active' => true,
            ]
        ];
        foreach ($groups as $group) {
            \App\Models\PropertyAttributeGroup::factory()->create([
                'name' => $group['name'],
                'description' => $group['description'],
                'is_active' => $group['is_active'],
            ]);
        }
    }
}
