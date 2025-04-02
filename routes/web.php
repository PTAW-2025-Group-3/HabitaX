<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

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

// Authenticated Routes (User must be logged in)
Route::middleware('auth')->group(function () {

    // User Account Routes
    Route::get('/account', [ProfileController::class, 'edit'])->name('account');
    Route::get('/account/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/account/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/account/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::put('/account/notifications', [ProfileController::class, 'updateNotifications'])->name('profile.notifications');
    Route::put('/account/privacy', [ProfileController::class, 'updatePrivacy'])->name('profile.privacy');
    Route::delete('/account', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/account/favorites', function () {
        return view('pages.account.sections.favorites');
    })->name('favorites');

    Route::get('/account/my-properties', function () {
        return view('pages.account.sections.my-properties');
    })->name('my-properties');

    Route::get('/account/settings', function () {
        return view('pages.account.sections.settings');
    })->name('settings');

});

// Registration Routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
// Auth (login, logout, etc.)
require __DIR__ . '/auth.php';
