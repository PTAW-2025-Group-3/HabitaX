<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\PropertyAttributeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\ReportedAdvertisementController;
use App\Http\Controllers\VerificationAdvertiserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdvertisementController;

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
Route::middleware('auth')->controller(AdvertisementController::class)->group(function () {
    Route::get('/advertisements/my', 'my')->name('advertisements.my');
    // create, edit, delete
});
Route::get('/advertisements/{id}', [AdvertisementController::class, 'show'])->name('advertisements.show');

// Property Routes
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::middleware('auth')->controller(PropertyController::class)->group(function () {
    Route::get('/properties/my', 'my')->name('properties.my');
    Route::get('/properties/create', 'create')->name('properties.create');
    Route::post('/properties', 'store')->name('properties.store');
    Route::get('/properties/{id}', 'show')->name('properties.show');
});

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
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdministrationController::class, 'index'])->name('admin.index');
    Route::get('/admin/users', [AdministrationController::class, 'getUsers'])->name('admin.users');
    Route::post('/admin/users/{user}/toggle-suspension', [AdministrationController::class, 'toggleSuspension'])
        ->name('admin.users.toggle-suspension');
    Route::post('/admin/users/{user}/update-role', [AdministrationController::class, 'updateRole'])
        ->name('admin.users.update-role');

    Route::get('/admin/attributes', [PropertyAttributeController::class, 'index'])->name('attributes.index');
    Route::get('/admin/attributes/create', [PropertyAttributeController::class, 'create'])->name('attributes.create');
    Route::post('/admin/attributes', [PropertyAttributeController::class, 'store'])->name('attributes.store');
    Route::get('/admin/attributes/{id}/edit', [PropertyAttributeController::class, 'edit'])->name('attributes.edit');
    Route::put('/admin/attributes/{id}', [PropertyAttributeController::class, 'update'])->name('attributes.update');
    Route::delete('/admin/attributes/{id}', [PropertyAttributeController::class, 'destroy'])->name('attributes.destroy');

    Route::get('/admin/property-types', [PropertyTypeController::class, 'index'])->name('property-types.index');
    Route::get('/admin/property-types/create', [PropertyTypeController::class, 'create'])->name('property-types.create');
    Route::post('/admin/property-types', [PropertyTypeController::class, 'store'])->name('property-types.store');
    Route::get('/admin/property-types/{id}/edit', [PropertyTypeController::class, 'edit'])->name('property-types.edit');
    Route::put('/admin/property-types/{id}', [PropertyTypeController::class, 'update'])->name('property-types.update');
    Route::delete('/admin/property-types/{id}', [PropertyTypeController::class, 'destroy'])->name('property-types.destroy');
});

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

// Auth (login, logout, etc.)
require __DIR__ . '/auth.php';
