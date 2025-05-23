<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Parish;
use Illuminate\Support\Facades\File;

class AdministrativeDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districtsJson = File::get(storage_path('seed/division/distritos.json'));
        $parishesJson = File::get(storage_path('seed/division/freguesias.json'));

        $districtsData = json_decode($districtsJson, true);
        $parishesData = json_decode($parishesJson, true);

        // Build a quick lookup of parishes by municipality name
        $parishesMap = [];
        foreach ($parishesData as $entry) {
            $parishesMap[mb_strtolower($entry['nome'])] = $entry['freguesias'];
        }

        foreach ($districtsData as $districtEntry) {
            $district = District::create([
                'name' => $districtEntry['distrito'],
                'is_active' => false,
            ]);

            foreach ($districtEntry['municipios'] as $municipalityName) {
                $municipality = Municipality::create([
                    'name' => $municipalityName,
                    'district_id' => $district->id,
                ]);

                $key = mb_strtolower($municipalityName);
                if (isset($parishesMap[$key])) {
                    foreach ($parishesMap[$key] as $parishName) {
                        Parish::create([
                            'name' => $parishName,
                            'municipality_id' => $municipality->id,
                        ]);
                    }
                }
            }
        }
    }
}
