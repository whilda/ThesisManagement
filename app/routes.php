<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('bootstrap');
});

Route::get('test', function(){ 
	return 'testRoute!';
});

Route::pattern('id', '[0-9]+');
Route::get('users/{id}','UserController@ShowProfile');

Route::get('users',function()
{ 
	return View::make('users');
});