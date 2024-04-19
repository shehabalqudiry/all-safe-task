<?php

use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['2fa', 'auth', 'verified'])->name('dashboard');

Route::middleware(['2fa', 'auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/2fa', [TwoFactorController::class,'show'])->name('2fa');
Route::post('/2fa', [TwoFactorController::class,'verify'])->name('2fa.verify');
