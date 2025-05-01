<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function process(Request $request)
    {
       if (!$request->hasFile('file')) {
           return response()->json(['error' => 'No file uploaded'], 400);
       }

       $file = $request->file('file');
       $storedPath = $file->store('tmp/uploads');

       return response()->json($storedPath);
    }

    public function revert(Request $request)
    {
        $filename = $request->getContent();
        Storage::delete('temp/' . $filename);
        return response('', 204);
    }

}
