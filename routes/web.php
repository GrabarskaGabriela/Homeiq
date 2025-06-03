<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('index');});
Route::get('/help', function () {return view('help');})->name('help');
Route::get('/contact', function () {return view('contact');})->name('contact');
Route::get('/buy', [PropertyController::class, 'forSale'])->name('properties.buy');
Route::get('/rent', [PropertyController::class, 'forRent'])->name('properties.rent');

Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create')->middleware('auth');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show.');

Route::middleware(['auth'])->group(function () {

    Route::get('/index', function () {return view('index');})->name('index');

    Route::get('/properties/{id}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{id}', [PropertyController::class, 'update'])->name('properties.update');
    Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');

    Route::delete('/offers/{offer}', [PropertyController::class, 'destroy'])->name('offers.destroy');
    Route::get('/my-offers', [PropertyController::class, 'myOffers'])->name('offers.my-offers');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {return view('admin.dashboard');})->name('admin.dashboard');
    Route::get('/properties', [AdminController::class, 'properties'])->name('admin.properties');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/offers', [AdminController::class, 'offers'])->name('admin.offers');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::get('/export-report', [AdminController::class, 'exportReport'])->name('admin.export-report');
});

require __DIR__.'/auth.php';
