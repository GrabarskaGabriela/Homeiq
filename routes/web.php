<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('index');
});

Route::get('/event', function () {
    return view('event');
});

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/buy', function () {
    return view('buy');
})->name('buy');
Route::get('/rent', function () {
    return view('rent');
})->name('rent');
Route::get('/offers.create', function () {
    return view('offers.create');
})->name('offers.create');
Route::get('/my.offers', function () {
    return view('my.offers');
})->name('my.offers');

Route::get('/help', function () {
    return view('help');
})->name('help');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes (from default Laravel)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Settings routes
    Route::prefix('/settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.index');

        // Password confirmation required for sensitive changes
        Route::middleware('password.confirm')->group(function () {
            Route::put('/data', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
            Route::put('/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
            Route::put('/notifications', [SettingsController::class, 'updateNotifications'])->name('settings.notifications.update');
        });
    });

    // Password confirmation
    Route::get('/confirm-haslo', function () {
        return view('auth.confirm-password');
    })->name('password.confirm');
});

// Authentication routes (from auth.php)
require __DIR__.'/auth.php';
