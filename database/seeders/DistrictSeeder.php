<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districts = ['Lisboa', 'Porto', 'Braga'];

        foreach ($districts as $name) {
            District::firstOrCreate(['name' => $name]);
        }
    }
}
