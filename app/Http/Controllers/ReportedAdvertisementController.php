<?php

namespace App\Http\Controllers;

class ReportedAdvertisementController extends Controller
{
    public function show($id)
    {
        return view('pages.moderation.partials.reported-advertisements.reported-advertisement');
    }
}
