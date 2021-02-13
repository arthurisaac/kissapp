<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [\App\Http\Controllers\AccueilController::class, 'index']);

Route::resource('/boutiques', \App\Http\Controllers\BoutiqueController::class);
Route::resource('/produits', \App\Http\Controllers\ProduitController::class);
Route::resource('/categories', \App\Http\Controllers\CategorieController::class);
Route::resource('/produit-boutique', \App\Http\Controllers\ProduitBoutiqueController::class);
Route::resource('/ventes', \App\Http\Controllers\VenteController::class);
