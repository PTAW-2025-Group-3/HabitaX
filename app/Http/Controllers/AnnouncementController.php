<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    // Show the Create Announcement Form
    public function create()
    {
        return view('announcements.create');
    }

    // Handle the form submission and store the announcement
    public function store(Request $request)
    {
        // TODO: Validate and save the announcement here

        return redirect()->route('dashboard')->with('success', 'Announcement created successfully.');
    }
}
