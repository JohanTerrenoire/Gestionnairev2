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

Route::view('/generateur', 'generateur')->name('generateur');

Route::get('/partage', 'LiaisonController@getPartage')->name('partage');

Route::prefix('combinaison')->group(function(){
  Route::match(["post", "get"],'/', 'CombinaisonController@index')->name('combinaison.index');
  Route::match(["post", "get"], "/edit/{id?}", "CombinaisonController@edit")->name('combinaison.edit');
  Route::get('/delete/{id}', 'CombinaisonController@remove')->name('combinaison.remove');
});
