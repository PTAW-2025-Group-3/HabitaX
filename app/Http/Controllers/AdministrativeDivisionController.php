<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Municipality;
use App\Models\Parish;
use Illuminate\Http\Request;

class AdministrativeDivisionController extends Controller
{
    // GET /districts
    public function districts()
    {
        return District::all();
    }

    // GET /districts/{id}/municipalities
    public function municipalitiesByDistrict(int $id)
    {
        return Municipality::where('district_id', $id)->get();
    }

    // GET /municipalities/{id}/parishes
    public function parishesByMunicipality(int $id)
    {
        return \App\Models\Parish::where('municipality_id', $id)->get();
    }

    // GET /search/parishes
    public function searchParishes(Request $request)
    {
        $query = $request->query('q', '');

        if (mb_strlen($query) < 2) {
            return response()->json([]);
        }

        $results = Parish::select('parishes.id as parish_id', 'parishes.name as parish_name',
            'municipalities.id as municipality_id', 'municipalities.name as municipality_name',
            'districts.name as district_name')
            ->join('municipalities', 'parishes.municipality_id', '=', 'municipalities.id')
            ->join('districts', 'municipalities.district_id', '=', 'districts.id')
            ->where('parishes.name', 'ILIKE', '%' . $query . '%')
            ->orderBy('municipalities.name')
            ->orderBy('parishes.name')
            ->get();

        // Group by municipality
        $grouped = [];

        foreach ($results as $row) {
            $mid = $row->municipality_id;

            if (!isset($grouped[$mid])) {
                $grouped[$mid] = [
                    'municipality' => [
                        'id' => $row->municipality_id,
                        'name' => $row->municipality_name,
                        'district' => [
                            'name' => $row->district_name,
                        ],
                    ],
                    'parishes' => [],
                ];
            }

            $grouped[$mid]['parishes'][] = [
                'id' => $row->parish_id,
                'name' => $row->parish_name,
            ];
        }

        return array_values($grouped);
    }
}
