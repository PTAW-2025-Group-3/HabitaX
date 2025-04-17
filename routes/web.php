<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReportedAdvertisementController;
use App\Http\Controllers\VerificationAdvertiserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdvertisementController;

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
Route::get('/advertisements/my', [AdvertisementController::class, 'my'])->name('advertisements.my');
Route::get('/advertisements/{id}', [AdvertisementController::class, 'show'])->name('advertisements.show');

// Property Routes
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/my', [PropertyController::class, 'my'])->name('properties.my');
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
Route::post('/properties/create/store', [PropertyController::class, 'store'])->name('properties.store');

// Administrative Division Routes
// Distritos, Municípios e Freguesias
//Route::get

// Moderation Route
Route::get('/mod', function () {
    return view('pages.moderation.moderation-dashboard');
})->name('moderation');
Route::get('/mod/reported-advertisement/{id}', [ReportedAdvertisementController::class, 'show'])->name('reported-advertisement.show');
Route::get('/mod/verification-advertiser/{id}', [VerificationAdvertiserController::class, 'show'])->name('verification-advertiser.show');

// Administration Route
Route::get('/admin', function () {
    return view('pages.administration.index');
})->name('administration');

// Authenticated Routes (User must be logged in)
Route::middleware('auth')->group(function () {

    // User Account Page
    Route::get('/account', function () {
        return view('pages.account.account');
    })->name('account');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Account Routes
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
    Route::put('/settings/password', [ProfileController::class, 'updatePassword'])->name('settings.password');
    Route::put('/settings/notifications', [ProfileController::class, 'updateNotifications'])->name('settings.notifications');
    Route::put('/settings/privacy', [ProfileController::class, 'updatePrivacy'])->name('settings.privacy');

    Route::get('/favorites', function () {
        return view('pages.account.sections.favorites');
    })->name('favorites');

    Route::get('/advertiser-verification', function () {
        return view('pages.account.sections.advertiser-verification');
    })->name('advertiser-verification');

    Route::get('/contact-requests', function () {
        return view('pages.account.sections.contact-requests');
    })->name('contact-requests');

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
