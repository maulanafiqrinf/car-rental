<?php
// routes/web.php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes for car management
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('cars', CarController::class);
    Route::post('rentals/return', [RentalController::class, 'return'])->name('rentals.return');
});

// User routes for rentals
Route::middleware('auth')->group(function () {
    Route::resource('rentals', RentalController::class);
    Route::post('rentals/return', [RentalController::class, 'return'])->name('rentals.return');
});

require __DIR__ . '/auth.php';
