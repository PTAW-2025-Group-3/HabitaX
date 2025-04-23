<?php

namespace App\Http\Controllers;

use App\Models\Denunciation;
use Illuminate\Http\Request;

class DenunciationController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'advertisement_id' => 'required|exists:advertisements,id',
            'reason_id' => 'required|exists:denunciation_reasons,id',
            'description' => 'nullable|string|max:1000',
        ]);

        $denunciation = Denunciation::create([
            'advertisement_id' => $validated['advertisement_id'],
            'reason_id' => $validated['reason_id'],
            'desc' => $validated['description'],
            'report_state' => 0,
            'created_by' => auth()->id(),
            'submitted_at' => now(),
        ]);

        return response()->json([
            'message' => 'Denunciation submitted successfully.',
            'denunciation' => $denunciation,
        ], 201);
    }
}
