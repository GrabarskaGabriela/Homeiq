<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {return view('index');});
Route::get('/terms', function () {return view('terms');})->name('terms');
Route::get('/help', function () {return view('help');})->name('help');
Route::get('/contact', function () {return view('contact');})->name('contact');
Route::get('/buy', function () {return view('buy');})->name('buy');
Route::get('/rent', function () {return view('rent');})->name('rent');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {

   // Route::get('/index', function () {return view('index');})->name('index');
    Route::get('/index', function () {$offerts = Offer::all();return view('index', compact('offerts'));})->name('index');

    Route::get('/profile/dashboard', function () {return view('profile.dashboard');})->name('profile.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/offers.create', function () {return view('offers.create');})->name('offers.create');
    Route::get('/offers.my_offers', function () {return view('offers.my_offers');})->name('offers.my_offers');
    // Settings routes
    Route::prefix('/settings')->group(function ()
    {
        Route::middleware('password.confirm')->group(function () {
            Route::put('/data', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
            Route::put('/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
            Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('settings.notifications.update');
        });
    });
});
// Authentication routes (from auth.php)
require __DIR__.'/auth.php';
