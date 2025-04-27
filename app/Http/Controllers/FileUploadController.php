<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function temp(Request $request): string
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid(). '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('temp', $filename);

            return response()->json([
                'id' => $path // FilePond expects some id
            ]);
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }

    public function revertTemp(Request $request)
    {
        $file = $request->getContent(); // FilePond sends the file name in the request body
        Storage::delete($file);

        return response('', 204);
    }
}
