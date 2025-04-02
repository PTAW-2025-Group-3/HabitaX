<?php

namespace App\Http\Controllers;

class VerificationAdvertiserController extends Controller{

    public function show($id){
        return view('pages.moderation.partials.verification-advertisers.verification-advertiser');
    }
}
