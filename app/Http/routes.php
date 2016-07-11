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

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Auth Routes
Route::get('auth/login', 'AuthController@getLogin');
Route::post('auth/login', 'AuthController@postLogin');
Route::get('auth/logout', 'AuthController@Logout');
Route::get('auth/register', 'AuthController@getRegister');
Route::post('auth/register', 'AuthController@postRegister');
Route::get('auth/confirmation', 'AuthController@getConfirmation');
Route::get('auth/confirm/{user_id}', 'AuthController@getConfirm');

//Tasks Roytes
Route::get('/', 'TaskController@read');
Route::get('/change/{task_id}', 'TaskController@state');
Route::get('task/{task_id}/edit', 'TaskController@edit');
Route::put('task/{task_id}/update', 'TaskController@update');
Route::delete('task/{task_id}/delete', 'TaskController@delete');
Route::post('/new', 'TaskController@create');

//Users routes
Route::get('user/{user_id}/edit', 'UserController@edit');
Route::put('user/{user_id}/update', 'UserController@update');
Route::delete('user/{user_id}/delete', 'UserController@delete');
Route::get('user/export/csv', 'UserController@exportcsv');
Route::get('user/export/xml', 'UserController@exportxml');