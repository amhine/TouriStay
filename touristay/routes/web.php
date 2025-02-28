<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TouristeDashboardController;
use App\Http\Controllers\ProprietaireDashboardController;
use App\Http\Controllers\annoncecontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/touriste/dashboard', [TouristeDashboardController::class, 'index'])->middleware('role')->name('touriste.dashboard');
    Route::get('/proprietaire/dashboard', [ProprietaireDashboardController::class, 'index'])->middleware('role')->name('proprietaire.dashboard');


    Route::get('/editprf', [ProfileController::class, 'formedit'])->name('profile');
    Route::get('/changepassword', [ProfileController::class, 'formepasswrd'])->name('prassword');


    // Route::get('/annonce', [annoncecontroller::class, 'index'])->name('annonce');

    Route::get('/annonce/touriste', [AnnonceController::class, 'search'])->name('annonce');
    
    Route::get('/annonce/proprietaire', [AnnonceController::class, 'index'])->name('annonce.proprietaire');
    
    Route::put('/profile/password', [ProfileController::class, 'updatee'])->name('password.updatee');
    }

);


require __DIR__.'/auth.php';
