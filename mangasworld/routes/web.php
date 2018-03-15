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
    return view('home');
});

Route::get('/getLogin', 'UtilisateurController@getLogin');
Route::post('/signIn', 'UtilisateurController@signIn');
Route::post('/signOut', 'UtilisateurController@signOut');
Route::get('/listerMangas', 'MangaController@getMangas');
Route::get('/listerGenres', 'GenreController@getGenres');
Route::post('/listerMangasGenre', 'MangaController@getMangasGenre');
Route::get('/modifierManga/{id}', 'MangaController@updateManga');
Route::post('/validerManga', 'MangaController@validateManga');