<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PreferencesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[NewsController::class, 'fetchNewsArticles'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/preferences', [PreferencesController::class, 'showPreferencesForm'])->name('preferences.save');
    Route::post('/preferences', [PreferencesController::class, 'savePreferences'])->name('preferences.show');
    Route::get('/article/{hash}', [NewsController::class, 'show'])->name('news.show')->where('hash', '.*');
});

require __DIR__.'/auth.php';
