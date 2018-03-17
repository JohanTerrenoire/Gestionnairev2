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

Route::view('/generateur', 'generateur')->name('generateur')->middleware('auth');

Route::get('/partage', 'LiaisonController@getPartage')->name('partage')->middleware('auth');

Route::prefix('combinaison')->group(function(){
  Route::match(["post", "get"],'/', 'CombinaisonController@index')->name('combinaison.index')->middleware('auth');
  Route::match(["post", "get"], "/edit/{id?}", "CombinaisonController@edit")->name('combinaison.edit')->middleware('auth');
  Route::get('/delete/{id}', 'CombinaisonController@remove')->name('combinaison.remove')->middleware('auth');
});
// Lors de la modification que la combinaison appartient à l'utilisateur courant
// Récupérer les catégories de l'utilisateur uniquement
