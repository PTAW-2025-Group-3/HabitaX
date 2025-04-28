<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\DenunciationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModerationController;
use App\Http\Controllers\PropertyAttributeController;
use App\Http\Controllers\PropertyAttributeOptionController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\ReportedAdvertisementController;
use App\Http\Controllers\VerificationAdvertiserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ModeratorMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdvertisementController;

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard
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
Route::get('/advertisements/help', [AdvertisementController::class, 'help'])->name('advertisements.help');
Route::get('/advertisements', [AdvertisementController::class, 'index'])->name('advertisements.index');

Route::middleware('auth')->controller(AdvertisementController::class)->group(function () {
    // create, edit, delete
    Route::get('/advertisements/my', 'my')->name('advertisements.my');
    Route::get('/advertisements/favorites', 'favorites')->name('advertisements.favorites');
});
Route::get('/advertisements/{id}', [AdvertisementController::class, 'show'])->name('advertisements.show');

Route::middleware('auth')->group(function () {
    Route::post('/denunciations', [DenunciationController::class, 'store'])->name('denunciations.store');

    // Favorites routes
    Route::post('/advertisements/{advertisement}/favorite', [FavoriteController::class, 'toggle'])
        ->name('advertisements.favorite.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    // File Upload
    Route::post('uploads/temp', [FileUploadController::class, 'temp'])->name('uploads.temp');
    Route::delete('/upload/revert', [FileUploadController::class, 'revertTemp'])->name('uploads.revert');
});

// Property Routes
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::middleware('auth')->controller(PropertyController::class)->group(function () {
    Route::get('/properties/my', 'my')->name('properties.my');
    Route::get('/properties/create', 'create')->name('properties.create');
    Route::post('/properties/create/store', 'store')->name('properties.store');
    Route::get('/properties/{id}', 'show')->name('properties.show');
});
Route::get('/property-type/{id}/attributes', [PropertyTypeController::class, 'getAttributes'])
    ->name('property-type.attributes');
Route::get('/property-type/{id}/attributes/html', [PropertyTypeController::class, 'loadAttributes']);

// Moderation Route
Route::middleware(['auth', ModeratorMiddleware::class])->group(function () {
    Route::get('/mod', [ModerationController::class, 'index'])->name('moderation');
    Route::get('/mod/reported-advertisement/{id}', [ReportedAdvertisementController::class, 'show'])
        ->name('reported-advertisement.show');
    Route::get('/mod/verification-advertiser/{id}', [VerificationAdvertiserController::class, 'show'])
        ->name('verification-advertiser.show');
    Route::post('/mod/reported-advertisement/{id}/approve', [ReportedAdvertisementController::class, 'approve'])
        ->name('reported-advertisement.approve');
    Route::post('/mod/reported-advertisement/{id}/reject', [ReportedAdvertisementController::class, 'reject'])
        ->name('reported-advertisement.reject');
    Route::get('/mod/advertisement/{advertisementId}/history', [ReportedAdvertisementController::class, 'history'])
        ->name('reported-advertisement.history');
});

// Administration Route
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdministrationController::class, 'index'])->name('admin.index');
    Route::get('/admin/users', [AdministrationController::class, 'getUsers'])->name('admin.users');
    Route::post('/admin/users/{user}/toggle-status', [AdministrationController::class, 'toggleStatus'])
        ->name('admin.users.toggle-status');
    Route::post('/admin/users/{user}/update-role', [AdministrationController::class, 'updateRole'])
        ->name('admin.users.update-role');
    Route::get('/admin/user-roles-data', [AdministrationController::class, 'getUserRolesData'])
        ->name('admin.user-roles-data');

    Route::get('/admin/attributes', [PropertyAttributeController::class, 'index'])->name('attributes.index');
    Route::get('/admin/attributes/create', [PropertyAttributeController::class, 'create'])->name('attributes.create');
    Route::post('/admin/attributes', [PropertyAttributeController::class, 'store'])->name('attributes.store');
    Route::get('/admin/attributes/{id}/edit', [PropertyAttributeController::class, 'edit'])->name('attributes.edit');
    Route::put('/admin/attributes/{id}', [PropertyAttributeController::class, 'update'])->name('attributes.update');
    Route::delete('/admin/attributes/{id}', [PropertyAttributeController::class, 'destroy'])->name('attributes.destroy');

    Route::get('/admin/attributes/{id}/options', [PropertyAttributeOptionController::class, 'index'])
        ->name('attribute-options.index');
    Route::get('/admin/attributes/{id}/options/create', [PropertyAttributeOptionController::class, 'create'])
        ->name('attribute-options.create');
    Route::post('/admin/attributes/{id}/options', [PropertyAttributeOptionController::class, 'store'])
        ->name('attribute-options.store');
    Route::get('/admin/attribute-options/{id}/edit', [PropertyAttributeOptionController::class, 'edit'])
        ->name('attribute-options.edit');
    Route::put('/admin/attribute-options/{id}', [PropertyAttributeOptionController::class, 'update'])
        ->name('attribute-options.update');
    Route::delete('/admin/attribute-options/{id}', [PropertyAttributeOptionController::class, 'destroy'])
        ->name('attribute-options.destroy');

    Route::get('/admin/property-types', [PropertyTypeController::class, 'index'])->name('property-types.index');
    Route::get('/admin/property-types/create', [PropertyTypeController::class, 'create'])->name('property-types.create');
    Route::post('/admin/property-types', [PropertyTypeController::class, 'store'])->name('property-types.store');
    Route::get('/admin/property-types/{id}/edit', [PropertyTypeController::class, 'edit'])->name('property-types.edit');
    Route::put('/admin/property-types/{id}', [PropertyTypeController::class, 'update'])->name('property-types.update');
    Route::delete('/admin/property-types/{id}', [PropertyTypeController::class, 'destroy'])->name('property-types.destroy');
    Route::get('/admin/property-types/{id}/attributes', [PropertyTypeController::class, 'editAttributes'])
        ->name('property-types.attributes.edit');
    Route::post('/admin/property-types/{id}/attributes', [PropertyTypeController::class, 'updateAttributes'])
        ->name('property-types.attributes.update');

    // Distritos, Municípios e Freguesias
});

// This route should be accessible to guests for contact request
Route::post('/contact-requests', [ContactRequestController::class, 'store'])
    ->name('contact-requests.store');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Account Routes
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
    Route::put('/settings/password', [ProfileController::class, 'updatePassword'])->name('settings.password');
    Route::put('/settings/notifications', [ProfileController::class, 'updateNotifications'])->name('settings.notifications');
    Route::put('/settings/privacy', [ProfileController::class, 'updatePrivacy'])->name('settings.privacy');

    Route::get('/advertiser-verification', function () {
        return view('account.advertiser-verification');
    })->name('advertiser-verification');

    Route::get('/contact-requests', [ContactRequestController::class, 'index'])
            ->name('contact-requests.index');
    Route::patch('/contact-requests/{contactRequest}/status', [ContactRequestController::class, 'updateStatus'])
            ->name('contact-requests.update-status');
});

// Auth (login, logout, etc.)
require __DIR__ . '/auth.php';
