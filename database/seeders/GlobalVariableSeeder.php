<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GlobalVariableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variables = [
            [
                'name' => 'Maximo de atributos em filtros',
                'code' => 'max_attributes_filter',
                'value' => 10,
                'description' => 'Numero maximo de atributos permitidos nos filtros por tipo da propriedade.',
            ],
            [
                'name' => 'Maximo de atributos em listagem',
                'code' => 'max_attributes_list',
                'value' => 5,
                'description' => 'Numero maximo de atributos permitidos em listagem de anúncios.',
            ],
        ];

        foreach ($variables as $variable) {
            \App\Models\GlobalVariable::create([
                'name' => $variable['name'],
                'code' => $variable['code'],
                'value' => $variable['value'],
                'description' => $variable['description'],
            ]);
        }
    }
}
