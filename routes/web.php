<?php

use App\Http\Controllers\ReportedAdvertisementController;
use App\Http\Controllers\VerificationAdvertiserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Auth;

// Home Page
Route::get('/', function () {
    return view('pages.home.home');
})->name('home');

// Dashboard (after login)
Route::get('/dashboard', function () {
    return view('auth.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Contact Page
Route::get('/contact', function () {
    return view('pages.contact.contact');
})->name('contact');

Route::get('/about', function () {
    return view('pages.about.about');
})->name('about');

// Advertisement Routes
Route::get('/advertisements', [AdvertisementController::class, 'index'])->name('advertisements.index');
Route::get('/create', [AdvertisementController::class, 'create'])->name('pages.createad.create');
Route::post('/create/store', [AdvertisementController::class, 'store'])->name('pages.createad.store');
Route::get('/advertisements/{id}', [AdvertisementController::class, 'show'])->name('advertisements.show');

// Moderation Route
Route::get('/moderation', function () {
    return view('pages.moderation.moderation-dashboard');
})->name('moderation');
Route::get('/moderation/reported-advertisement/{id}', [ReportedAdvertisementController::class, 'show'])->name('reported-advertisement.show');
Route::get('/moderation/verification-advertiser/{id}', [VerificationAdvertiserController::class, 'show'])->name('verification-advertiser.show');


// Authenticated Routes (User must be logged in)
Route::middleware('auth')->group(function () {

    // User Account Page
    Route::get('/account', function () {
        return view('profile.account', [
            'user' => Auth::user()
        ]);
    })->name('account');

});

// Registration Routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth (login, logout, etc.)
require __DIR__ . '/auth.php';
