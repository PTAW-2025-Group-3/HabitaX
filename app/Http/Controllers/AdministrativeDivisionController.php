<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Municipality;
use App\Models\Parish;
use Collator;
use Illuminate\Http\Request;

class AdministrativeDivisionController extends Controller
{
    // GET /districts
    public function districts()
    {
        return District::where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    // GET /districts/{id}/municipalities
    public function municipalitiesByDistrict(int $id)
    {
        return Municipality::where('district_id', $id)->get();
    }

    // GET /municipalities/{id}/parishes
    public function parishesByMunicipality(int $id)
    {
        return Parish::where('municipality_id', $id)->get();
    }

    // GET /search/locations
    public function searchLocations(Request $request)
    {
        $query = $request->query('q', '');

        if (mb_strlen($query) < 3) {
            return response()->json([]);
        }

        $normalized = mb_strtolower($query);

        $parishes = Parish::with('municipality.district')
            ->whereRaw("unaccent(lower(name)) LIKE unaccent(lower(?))", ["{$normalized}%"])
            ->orderBy('name')
            ->get();

        $grouped = [];

        foreach ($parishes as $parish) {
            $municipality = $parish->municipality;
            $mid = $municipality->id;

            if (!isset($grouped[$mid])) {
                $grouped[$mid] = [
                    'municipality' => [
                        'id' => $municipality->id,
                        'name' => $municipality->name,
                        'district' => ['name' => $municipality->district->name],
                    ],
                    'parishes' => [],
                ];
            }

            $grouped[$mid]['parishes'][] = [
                'id' => $parish->id,
                'name' => $parish->name,
                'municipality_id' => $mid,
                'district_id' => $parish->municipality->district->id,
            ];
        }

        $collator = new Collator('pt_PT');
        usort($grouped, fn($a, $b) =>
        $collator->compare($a['municipality']['name'], $b['municipality']['name'])
        );

        foreach ($grouped as &$entry) {
            usort($entry['parishes'], fn($a, $b) =>
            $collator->compare($a['name'], $b['name'])
            );
        }

        return array_values($grouped);
    }
}
