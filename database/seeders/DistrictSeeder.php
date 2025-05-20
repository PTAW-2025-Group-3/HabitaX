<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districtData = [
            [
                'name' => 'Lisboa',
                'folder' => 'lisboa'
            ],
            [
                'name' => 'Porto',
                'folder' => 'porto'
            ],
            [
                'name' => 'Aveiro',
                'folder' => 'aveiro'
            ],
            [
                'name' => 'Coimbra',
                'folder' => 'coimbra'
            ],
//            [
//                'name' => 'Braga',
//                'folder' => 'braga'
//            ],
//            [
//                'name' => 'Setúbal',
//                'folder' => 'setubal'
//            ],
        ];

        foreach ($districtData as $data) {
            $district = District::updateOrCreate(
                ['name' => $data['name']],
                ['show_on_homepage' => true]
            );
            $this->attachImages($district, $data['folder']);
        }
    }

    public function attachImages($district, $folder)
    {
        $imagesPath = storage_path('seed/district-images' . '/' . $folder);
        $images = glob("{$imagesPath}/*.{jpg,jpeg,png,webp}", GLOB_BRACE);

        if (count($images) > 0) {
            foreach ($images as $image) {
                $district->addMedia($image)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
            }
        } else {
            throw new \Exception("No images found in {$imagesPath}");
        }
    }
}
