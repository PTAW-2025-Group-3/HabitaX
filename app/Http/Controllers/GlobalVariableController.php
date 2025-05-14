<?php

namespace App\Http\Controllers;

use App\Models\GlobalVariable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GlobalVariableController extends Controller
{
    public function index()
    {
        $globalVariables = GlobalVariable::orderBy('updated_at', 'desc')->paginate(10);

        return view('administration.global-variables', compact('globalVariables'));
    }

    public function updateValue(Request $request, $id)
    {
        $request->validate([
            'value' => 'required|string|max:255',
        ]);

        $globalVariable = GlobalVariable::findOrFail($id);
        $globalVariable->value = $request->value;
        Log::info('Valor atualizado', [
            'global_variable_id' => $globalVariable->id,
            'new_value' => $request->value,
            'updated_by_id' => auth()->user()->id,
        ]);
        $globalVariable->updated_by_id = auth()->user()->id;
        $globalVariable->save();

        return response()->json(['message' => 'Valor atualizado com sucesso!']);
    }
}
