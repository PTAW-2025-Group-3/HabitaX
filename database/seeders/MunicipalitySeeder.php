<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Municipality;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Lisboa' => ['Lisboa', 'Sintra', 'Oeiras'],
            'Porto' => ['Porto', 'Matosinhos', 'Vila Nova de Gaia'],
//            'Braga' => ['Braga', 'Guimarães', 'Barcelos'],
        ];

        foreach ($data as $districtName => $municipalities) {
            $district = District::where('name', $districtName)->first();

            foreach ($municipalities as $name) {
                Municipality::firstOrCreate([
                    'name' => $name,
                    'district_id' => $district->id
                ]);
            }
        }
    }
}
