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
	return View::make('login');
});
Route::get('coba', function()
{
	return View::make('coba');
});
Route::get('signup', function()
{
	return View::make('signup');
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
Route::get('home',function()
{ 
	return View::make('user/dashboard');
});
Route::get('code',function()
{ 
	return View::make('user/code');
});
Route::get('supervisorList',function()
{ 
	return View::make('user/supervisorList');
});
Route::get('supervisor',function()
{ 
	return View::make('user/supervisor');
});
Route::get('report',function()
{ 
	return View::make('user/report');
});
Route::get('edit',function()
{ 
	return View::make('user/editProfile');
});
Route::get('profile',function()
{ 
	return View::make('user/profile');
});
Route::get('thesis',function()
{ 
	return View::make('user/thesis');
});
Route::get('timeline',function()
{ 
	return View::make('user/timeline');
});