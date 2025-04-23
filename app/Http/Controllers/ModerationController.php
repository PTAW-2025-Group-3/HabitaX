<?php

namespace App\Http\Controllers;

class ModerationController extends Controller
{
    public function index()
    {
        $reportedController = new ReportedAdvertisementController();
        $data = $reportedController->index();

        // Make both the array and individual items available
        return view('pages.moderation.index', [
            'denunciationData' => $data,
            'presented' => $data['presented'],
            'denunciations' => $data['paginator']
        ]);
    }
}
