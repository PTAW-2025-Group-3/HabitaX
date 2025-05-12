<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentTypes = [
            [
                'name' => 'CC',
                'description' => 'Cartão de Cidadão',
                'is_active' => true,
            ],
            [
                'name' => 'BI',
                'description' => 'Bilhete de Identidade',
                'is_active' => true,
            ],
            [
                'name' => 'NIF',
                'description' => 'Número de Identificação Fiscal',
                'is_active' => true,
            ],
            [
                'name' => 'Titulo de Residência',
                'description' => 'Título de Residência',
                'is_active' => true,
            ],
            [
                'name' => 'Carta de Condução',
                'description' => 'Carta de Condução',
                'is_active' => true,
            ],
            [
                'name' => 'Passaporte',
                'description' => 'Passaporte',
                'is_active' => true,
            ],
            [
                'name' => 'Outro',
                'description' => 'Outro',
                'is_active' => true,
            ],
        ];

        foreach ($documentTypes as $documentType) {
            \App\Models\DocumentType::create($documentType);
        }
    }
}
