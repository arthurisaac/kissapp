<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\AccueilController::class, 'index']);
Route::get('/login', [\App\Http\Controllers\AccueilController::class, 'login']);
Route::get('/deconnexion', [\App\Http\Controllers\AccueilController::class, 'deconnexion']);
Route::post('auth', [\App\Http\Controllers\UserController::class, 'auth']);

Route::resource('/utilisateurs', \App\Http\Controllers\UserController::class);
Route::get('authorisation', [\App\Http\Controllers\UserController::class, 'updateAuthorization']);

Route::resource('/roles', \App\Http\Controllers\RoleController::class);
Route::resource('/boutiques', \App\Http\Controllers\BoutiqueController::class);
Route::resource('/produits', \App\Http\Controllers\ProduitController::class);
Route::resource('/categories', \App\Http\Controllers\CategorieController::class);
Route::resource('/produit-boutique', \App\Http\Controllers\ProduitBoutiqueController::class);
Route::resource('/ventes', \App\Http\Controllers\VenteController::class);

/*Route::prefix('Eleves')->group(function (){
    Route::get('/','EleveController@index')->name('eleves');
    Route::match(['get', 'post'],'create','EleveController@create')->name('eleves.post');
    Route::post('/{id}/update','EleveController@update')->name('eleves.update');
    Route::post('/{id}/destroy','EleveController@destroy')->name('eleves.destroy');
});*/
