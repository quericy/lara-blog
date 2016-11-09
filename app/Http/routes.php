<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', 'PostController@index');
Route::get('/blog/{id}', 'PostController@show');

Route::get('/category/{id}', 'CategoryController@show')->name('category.show')->where('id', '[0-9]+');
Route::get('/tag/{id}', 'TagController@show')->name('tag.show')->where('id', '[0-9]+');
