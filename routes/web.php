<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\AcheteurController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // Écriture : accessible seulement à gestionnaire et admin
    Route::resource('categories', CategorieController::class)
        ->middleware('role:gestionnaire,admin')
        ->only(['create', 'store', 'edit', 'update', 'destroy']);

    // Lecture : accessible à employe, gestionnaire, admin
    Route::resource('categories', CategorieController::class)
        ->middleware('role:employe,gestionnaire,admin')
        ->only(['index', 'show']);

        Route::middleware('auth')->group(function () {
    Route::resource('produits', ProduitController::class)
        ->middleware('role:gestionnaire,admin')
        ->only(['create', 'store', 'edit', 'update', 'destroy']);

    Route::resource('produits', ProduitController::class)
        ->middleware('role:employe,gestionnaire,admin')
        ->only(['index', 'show']);
});

Route::middleware('auth')->group(function () {
    Route::resource('acheteurs', AcheteurController::class)
        ->middleware('role:gestionnaire,admin')
        ->only(['create', 'store', 'edit', 'update', 'destroy']);

    Route::resource('acheteurs', AcheteurController::class)
        ->middleware('role:employe,gestionnaire,admin')
        ->only(['index', 'show']);

    // Enregistrer un achat : accessible à employe, gestionnaire, admin (voir tableau des rôles)
    Route::post('/acheteurs/{acheteur}/acheter', [AcheteurController::class, 'acheter'])
        ->middleware('role:employe,gestionnaire,admin')
        ->name('acheteurs.acheter');
});
});
require __DIR__.'/auth.php';