<?php

use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\ProduitController;
use App\Http\Controllers\Api\AcheteurController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategorieController::class);
Route::apiResource('produits', ProduitController::class);
Route::apiResource('acheteurs', AcheteurController::class);

Route::post('/acheteurs/{acheteur}/acheter', [AcheteurController::class, 'acheter']);