<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DenunciationController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\GlobalVariableController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModerationController;
use App\Http\Controllers\PropertyAttributeController;
use App\Http\Controllers\PropertyAttributeGroupController;
use App\Http\Controllers\PropertyAttributeOptionController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\ReportedAdvertisementController;
use App\Http\Controllers\AdvertiserVerificationController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ModeratorMiddleware;
use App\Models\User;
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
Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact-us.store');

Route::get('/about', function () {
    return view('pages.about.about');
})->name('about');

// Advertisement Routes
Route::get('/advertisements/help', [AdvertisementController::class, 'help'])->name('advertisements.help');
Route::get('/advertisements', [AdvertisementController::class, 'index'])->name('advertisements.index');
Route::get('/advertiser/{id}/phone', function ($id) {
    $user = User::find($id);
    return response()->json([
        'telephone' => $user ? $user->telephone : null
    ]);
});

Route::middleware('auth')->controller(AdvertisementController::class)->group(function () {
    // create, edit, delete
    Route::get('/advertisements/my', 'my')->name('advertisements.my');
    Route::get('/advertisements/favorites', 'favorites')->name('advertisements.favorites');

    Route::get('/advertisements/create', 'create')->name('advertisements.create');
    Route::post('/advertisements', 'store')->name('advertisements.store');

    Route::get('/advertisements/{id}/edit', 'edit')->name('advertisements.edit');
    Route::put('/advertisements/{id}', 'update')->name('advertisements.update');
    Route::delete('/advertisements/{id}', 'destroy')->name('advertisements.destroy');

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
    Route::post('/uploads/process', [FileUploadController::class, 'process'])->name('uploads.process');
    Route::delete('/uploads/revert', [FileUploadController::class, 'revert'])->name('uploads.revert');
});

// Property Routes
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::middleware('auth')->controller(PropertyController::class)->group(function () {
    Route::get('/properties/my', 'my')->name('properties.my');
    Route::get('/properties/create', 'create')->name('properties.create');
    Route::post('/properties', 'store')->name('properties.store');
    Route::get('/properties/{id}', 'show')->name('properties.show');
    Route::get('/properties/{id}/edit', 'edit')->name('properties.edit');
    Route::put('/properties/{id}', 'update')->name('properties.update');
    Route::delete('/properties/{id}', 'destroy')->name('properties.destroy');
});
Route::get('/property-type/{id}/attributes', [PropertyTypeController::class, 'getAttributes'])
    ->name('property-type.attributes');
Route::get('/property-type/{id}/attributes/html', [PropertyTypeController::class, 'loadAttributes']);

// Moderation Route
Route::middleware(['auth', ModeratorMiddleware::class])->group(function () {
    Route::get('/moderation', [ModerationController::class, 'index'])->name('moderation');
    Route::get('/moderation/reported-advertisement/{id}', [ReportedAdvertisementController::class, 'show'])
        ->name('reported-advertisement.show');
    Route::post('/moderation/reported-advertisement/{id}/approve', [ReportedAdvertisementController::class, 'approve'])
        ->name('reported-advertisement.approve');
    Route::post('/moderation/reported-advertisement/{id}/reject', [ReportedAdvertisementController::class, 'reject'])
        ->name('reported-advertisement.reject');
    Route::get('/moderation/advertisement/{advertisementId}/history', [ReportedAdvertisementController::class, 'history'])
        ->name('reported-advertisement.history');
    Route::get('/moderation/denunciations/ajax', [App\Http\Controllers\ReportedAdvertisementController::class, 'ajaxDenunciations'])->name('moderation.denunciations.ajax');
    Route::get('/moderation/suspended-users', [ModerationController::class, 'suspendedUsers'])->name('moderation.suspended-users');
    Route::post('/moderation/users/{userId}/update-state', [ModerationController::class, 'updateUserState'])->name('moderation.update-user-state');
    Route::get('/moderation/suspended-users/ajax', [ModerationController::class, 'ajaxSuspendedUsers'])
        ->name('moderation.suspended-users.ajax');

    Route::get('/moderation/verification-advertisers', [AdvertiserVerificationController::class, 'index'])
        ->name('verification-advertiser.index');
    Route::get('/moderation/verification-advertisers/ajax', [AdvertiserVerificationController::class, 'ajaxVerifications'])
        ->name('verification-advertiser.ajax');
    Route::get('/moderation/verification-advertisers/{id}', [AdvertiserVerificationController::class, 'show'])
        ->name('verification-advertiser.show');
    Route::post('/moderation/verification-advertisers/{id}/update-state', [AdvertiserVerificationController::class, 'updateState'])
        ->name('verification-advertiser.update-state');

    Route::get('/moderation/contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
    Route::get('/moderation/contact-us/data', [ContactUsController::class, 'ajaxIndex'])->name('contact-us.ajax');
    Route::get('/moderation/contact-us/{id}', [ContactUsController::class, 'show'])->name('contact-us.show');
    Route::put('/moderation/contact-us/{id}/mark-as-read', [ContactUsController::class, 'markAsRead'])->name('contact-us.mark-as-read');
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

    Route::get('/admin/attribute-groups', [PropertyAttributeGroupController::class, 'index'])
        ->name('attribute-groups.index');
    Route::get('/admin/attribute-groups/create', [PropertyAttributeGroupController::class, 'create'])
        ->name('attribute-groups.create');
    Route::post('/admin/attribute-groups', [PropertyAttributeGroupController::class, 'store'])
        ->name('attribute-groups.store');
    Route::get('/admin/attribute-groups/{id}/edit', [PropertyAttributeGroupController::class, 'edit'])
        ->name('attribute-groups.edit');
    Route::put('/admin/attribute-groups/{id}', [PropertyAttributeGroupController::class, 'update'])
        ->name('attribute-groups.update');
    Route::get('/admin/attribute-groups/{id}/attributes', [PropertyAttributeGroupController::class, 'editAttributes'])
        ->name('attribute-groups.attributes.edit');
    Route::post('/admin/attribute-groups/{id}/attributes', [PropertyAttributeGroupController::class, 'updateAttributes'])
        ->name('attribute-groups.attributes.update');
    Route::delete('/admin/attribute-groups/{id}', [PropertyAttributeGroupController::class, 'destroy'])
        ->name('attribute-groups.destroy');

    Route::get('/admin/global-variables', [GlobalVariableController::class, 'index'])->name('global-variables.index');
    Route::put('/admin/global-variables/{id}', [GlobalVariableController::class, 'updateValue'])->name('global-variables.update-value');

    Route::get('/admin/document-types', [DocumentTypeController::class, 'index'])->name('document-types.index');
    Route::get('/admin/document-types/create', [DocumentTypeController::class, 'create'])->name('document-types.create');
    Route::post('/admin/document-types', [DocumentTypeController::class, 'store'])->name('document-types.store');
    Route::get('/admin/document-types/{id}/edit', [DocumentTypeController::class, 'edit'])->name('document-types.edit');
    Route::put('/admin/document-types/{id}', [DocumentTypeController::class, 'update'])->name('document-types.update');
    Route::delete('/admin/document-types/{id}', [DocumentTypeController::class, 'destroy'])->name('document-types.destroy');

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
    // Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
    // Route::put('/settings/password', [ProfileController::class, 'updatePassword'])->name('settings.password');
    // Route::put('/settings/notifications', [ProfileController::class, 'updateNotifications'])->name('settings.notifications');
    // Route::put('/settings/privacy', [ProfileController::class, 'updatePrivacy'])->name('settings.privacy');

    Route::get('/advertiser-verification', [AdvertiserVerificationController::class, 'create'])->name('advertiser-verification.create');
    Route::post('/advertiser-verification', [AdvertiserVerificationController::class, 'store'])->name('advertiser-verification.store');

    Route::get('/contact-requests', [ContactRequestController::class, 'index'])
            ->name('contact-requests.index');
    Route::patch('/contact-requests/{contactRequest}/status', [ContactRequestController::class, 'updateStatus'])
            ->name('contact-requests.update-status');
});

Route::post('/share/email', [App\Http\Controllers\ShareController::class, 'shareByEmail'])->name('share.email');

Route::view('/politica-de-privacidade', 'pages.legal.privacy-policy')->name('privacy.policy');
Route::view('/condicoes-gerais', 'pages.legal.terms-and-conditions')->name('terms.conditions');
Route::get('/noticias', [\App\Http\Controllers\NewsController::class, 'index']);


Route::middleware('auth')->group(function () {
    Route::get('/settings', [AccountController::class, 'settings'])->name('settings');
    Route::put('/settings/privacy', [AccountController::class, 'updatePrivacy'])->name('account.updatePrivacy');
    Route::put('/settings/password', [AccountController::class, 'updatePassword'])->name('account.updatePassword');
    Route::delete('/settings', [AccountController::class, 'deleteAccount'])->name('account.delete');
});


// Auth (login, logout, etc.)
require __DIR__ . '/auth.php';
