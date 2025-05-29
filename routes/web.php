<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OfferPictureController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {return view('index');});
Route::get('/help', function () {return view('help');})->name('help');
Route::get('/contact', function () {return view('contact');})->name('contact');
Route::get('/buy', [PropertyController::class, 'forSale'])->name('properties.buy');
Route::get('/rent', [PropertyController::class, 'forRent'])->name('properties.rent');

// Public property details - accessible to everyone
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/offers/{offer}', [PropertyController::class, 'showOffer'])->name('offers.show');

// Authenticated routes
Route::middleware(['auth'])->group(function () {

    Route::get('/index', function () {return view('index');})->name('index');
    //Route::get('/index', function () {$offerts = Offer::all();return view('index', compact('offerts'));})->name('index');

    // Property management routes (require authentication)
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');

    // Offer management routes
    Route::delete('/offers/{offer}', [PropertyController::class, 'destroy'])->name('offers.destroy');
    Route::get('/my-offers', [PropertyController::class, 'myOffers'])->name('offers.my-offers');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Settings routes
    Route::prefix('/settings')->group(function () {
        Route::middleware('password.confirm')->group(function () {
            Route::put('/data', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
            Route::put('/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
            Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('settings.notifications.update');
        });
    });
});

// Admin routes
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Authentication routes (from auth.php)
require __DIR__.'/auth.php';
