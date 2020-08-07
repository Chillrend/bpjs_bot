<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/event', 'EventController@index');
Route::get('/event/create', 'EventController@create');
Route::post('/event/store', 'EventController@store');
Route::get('event/delete/{id}', 'EventController@delete');
Route::get('event/edit/{id}', 'EventController@edit');
Route::post('event/update/{id}', 'EventController@update');

Route::get('/colosseum', 'ColosseumController@index');
Route::get('/colosseum/create', 'ColosseumController@create');
Route::post('/colosseum/store', 'ColosseumController@store');
Route::get('/colosseum/delete/{id}', 'ColosseumController@delete');


Route::get('/home', 'HomeController@index')->name('home');
