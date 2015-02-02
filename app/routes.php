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
		return View::make('student/dashboard');
	});
	Route::get('code',function()
	{ 
		return View::make('student/code');
	});
	Route::get('supervisorList',function()
	{ 
		return View::make('student/supervisorList');
	});
	Route::get('supervisor',function()
	{ 
		return View::make('student/supervisor');
	});
	Route::get('report',function()
	{ 
		return View::make('student/report');
	});
	Route::get('edit',function()
	{ 
		return View::make('student/editProfile');
	});
	Route::get('profile',function()
	{ 
		return View::make('student/profile');
	});
	Route::get('thesis',function()
	{ 
		return View::make('student/thesis');
	});
	Route::get('timeline',function()
	{ 
		return View::make('student/timeline');
	});
	
	Route::get('supervisor/home',function()
	{ 
		return View::make('supervisor/dashboard');
	});
	Route::get('supervisor/proposal',function()
	{ 
		return View::make('supervisor/proposal');
	});
	Route::get('supervisor/studentList',function()
	{ 
		return View::make('supervisor/studentList');
	});
	Route::get('supervisor/supervisor',function()
	{ 
		return View::make('supervisor/supervisor');
	});
	Route::get('supervisor/report',function()
	{ 
		return View::make('supervisor/report');
	});
	Route::get('supervisor/edit',function()
	{ 
		return View::make('supervisor/editProfile');
	});
	Route::get('supervisor/detail',function()
	{ 
		return View::make('supervisor/detail');
	});
	Route::get('supervisor/template',function()
	{ 
		return View::make('supervisor/taskTemplate');
	});
	Route::get('supervisor/addTemplate',function()
	{ 
		return View::make('supervisor/insertTemplate');
	});
	Route::get('supervisor/editTemplate',function()
	{ 
		return View::make('supervisor/insertTemplate');
	});
	Route::get('supervisor/field',function()
	{ 
		return View::make('supervisor/field');
	});