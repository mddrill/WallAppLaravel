<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

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

Route::get('/post', 'PostController@index');
Route::get('/post/{id}', 'PostController@show');
Route::post('/post', 'PostController@create')->middleware('auth:api');
Route::put('/post/{id}', 'PostController@update')->middleware('auth:api');
Route::delete('/post/{id}', 'PostController@destroy')->middleware('auth:api');
Route::post('/register', 'Auth\RegisterController@create');
