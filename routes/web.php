<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\TransportsController;
use App\Http\Controllers\HotelsController;
use App\Http\Controllers\PaketsController;

Route::get('/', function () {
    return redirect()->route('pakets.index'); // Mengarahkan ke rute 'pakets.index'
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute yang aman
    Route::resource('destinations', DestinationsController::class);
    Route::resource('transports', TransportsController::class);
    Route::resource('hotels', HotelsController::class);
    Route::resource('pakets', PaketsController::class);
});

require __DIR__ . '/auth.php';
