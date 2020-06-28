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

Route::get('articles','ArticleController@index');
Route::get('articles/create','ArticleController@create');
Route::post('articles','ArticleController@store');
Route::get('articles/{id}/edit','ArticleController@edit');
Route::put('articles/{id}','ArticleController@update');
Route::get('articles/{id}','ArticleController@show');
Route::delete('articles/{id}','ArticleController@destroy');
Route::get('/getData/{id}','ArticleController@getData');
//Route Experiences
Route::post('/addExperience','ArticleController@addExperience');
Route::put('/updateExperience','ArticleController@updateExperience');
Route::delete('/deleteExperience/{id}','ArticleController@deleteExperience');
//Route Formations
Route::post('/addFormation','ArticleController@addFormation');
Route::put('/updateFormation','ArticleController@updateFormation');
Route::delete('/deleteFormation/{id}','ArticleController@deleteFormation');
//Route Competences
Route::post('/addCompetence','ArticleController@addCompetence');
Route::put('/updateCompetence','ArticleController@updateCompetence');
Route::delete('/deleteCompetence/{id}','ArticleController@deleteCompetence');
//Route Projets
Route::post('/addProjet','ArticleController@addProjet');
Route::put('/updateProjet','ArticleController@updateProjet');
Route::delete('/deleteProjet/{id}','ArticleController@deleteProjet');
//Guests users
Route::get('acceuil','ArticleController@acceuil');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
