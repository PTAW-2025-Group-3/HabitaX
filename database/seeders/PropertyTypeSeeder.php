<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Apartamentos', 'folder' => 'apartamentos',
                'description' => 'Unidade habitacional num edifício partilhado.',
                'show' => true
            ],
            [
                'name' => 'Moradias', 'folder' => 'moradias',
                'description' => 'Casa independente, muitas vezes com jardim.',
                'show' => true
            ],
            [
                'name' => 'Terrenos', 'folder' => 'terrenos',
                'description' => 'Parcela de terra para construção ou cultivo.',
                'show' => true],
            [
                'name' => 'Quintas', 'folder' => 'quintas',
                'description' => 'Propriedade rural com terreno e edifícios.',
                'show' => true],
            [
                'name' => 'Prédios', 'folder' => 'predios',
                'description' => 'Edifício completo composto por várias frações.',
                'show' => true
            ],
            [
                'name' => 'Escritórios', 'folder' => 'escritorios',
                'description' => 'Espaço para atividades profissionais e administrativas.',
                'show' => true
            ],
            [
                'name' => 'Lojas', 'folder' => 'lojas',
                'description' => 'Espaço comercial para venda a retalho.',
                'show' => true
            ],
            [
                'name' => 'Garagens', 'folder' => 'garagens',
                'description' => 'Espaço para estacionamento ou arrumação.',
                'show' => true
            ],
            [
                'name' => 'Estúdios', 'folder' => 'estudios',
                'description' => 'Espaço habitacional com divisão única.'
            ],
            [
                'name' => 'Quartos', 'folder' => 'quartos',
                'description' => 'Parte de um imóvel para arrendamento individual.'
            ],
            [
                'name' => 'Armazéns', 'folder' => 'armazens',
                'description' => 'Espaço para armazenamento ou logística.'
            ],
        ];

        foreach ($types as $type) {
            $propertyType = PropertyType::factory()
                ->create([
                    'name' => $type['name'],
                    'description' => $type['description'],
                    'is_active' => $type['show'] ?? false,
                    'show_on_homepage' => $type['show'] ?? false,
                ]);
            $this->attachImages($propertyType, $type['folder']);
        }
    }

    public function attachImages(PropertyType $propertyType, $folder)
    {
        $imageBaseFolder = storage_path('seed/property-type-images');
        $imagesPath = $imageBaseFolder . '/' . $folder;
        $images = glob("{$imagesPath}/*.{jpg,jpeg,png,webp}", GLOB_BRACE);

        if (count($images) > 0) {
            foreach ($images as $image) {
                $propertyType->addMedia($image)->preservingOriginal()->toMediaCollection('images');
            }
        }
    }
}
