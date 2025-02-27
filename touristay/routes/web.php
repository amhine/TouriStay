<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TouristeDashboardController;
use App\Http\Controllers\ProprietaireDashboardController;


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

Route::get('/dashboard/touriste', [TouristeDashboardController::class, 'index'])->middleware('role')->name('dashboard.touriste');
Route::get('/dashboard/proprietaire', [ProprietaireDashboardController::class, 'index'])->middleware('role')->name('dashboard.proprietaire');


Route::get('/editprf', [ProfileController::class, 'formedit'])->name('profile');
Route::get('/changepassword', [ProfileController::class, 'formepasswrd'])->name('prassword');

    
Route::put('/profile/password', [ProfileController::class, 'updatee'])->name('password.updatee');
}
);


require __DIR__.'/auth.php';
