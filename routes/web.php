<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// La route pour accéder au générateur de mot de passe aléatoire
Route::view('/generateur', 'generateur')->name('generateur')->middleware('auth');

// La route pour voir les Combinaisons partagées avec nous et celles que l'on a partagé
Route::prefix('partage')->group(function(){
  Route::get('/', 'LiaisonController@getPartage')->name('partage')->middleware('auth');
  Route::get('/all', 'LiaisonController@sharedPassword')->name('partage.sharedPassword')->middleware('auth');
  Route::get('/all/{id}', 'LiaisonController@stopPartage')->name('partage.stopPartage')->middleware('auth');
});

// La route pour partager un mot de passe avec un partenaire
Route::get('/share/{id}', 'LiaisonController@getVueShareCombinaison')->name('share')->middleware('auth');
Route::post('/share/{id}', 'LiaisonController@postUserShareCombinaison')->name('share')->middleware("auth");

// La route pour afficher, modifier ou ajouter une combinaison
Route::prefix('combinaison')->group(function(){
  Route::match(["post", "get"],'/', 'CombinaisonController@index')->name('combinaison.index')->middleware('auth');
  Route::match(["post", "get"], "/edit/{id?}", "CombinaisonController@edit")->name('combinaison.edit')->middleware('auth');
  Route::get('/delete/{id}', 'CombinaisonController@remove')->name('combinaison.remove')->middleware('auth');
});
// Lors de la modification, vérifier que la combinaison appartient à l'utilisateur courant
// Ajouter un onglet pour voir les mots de passe que j'ai partagé avec d'autres
