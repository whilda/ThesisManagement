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
Route::get('signup', 'AuthController@Signup');
Route::post('signup/student', 'AuthController@SignupStudent');
Route::post('signup/supervisor', 'AuthController@SignupSupervisor');

Route::get('test', function(){ 
	return 'testRoute!';
});

Route::pattern('id', '[0-9]+');
Route::get('users/{id}','UserController@ShowProfile');

Route::get('users',function()
{ 
	return View::make('users');
});
	Route::get('student/home',function()
	{ 
		return View::make('student/dashboard');
	});
	Route::get('student/code',function()
	{ 
		return View::make('student/code');
	});
	Route::get('student/supervisorList',function()
	{ 
		return View::make('student/supervisorList');
	});
	Route::get('student/supervisor',function()
	{ 
		return View::make('student/supervisor');
	});
	Route::get('student/report',function()
	{ 
		return View::make('student/report');
	});
	Route::get('student/edit',function()
	{ 
		return View::make('student/editProfile');
	});
	Route::get('student/profile',function()
	{ 
		return View::make('student/profile');
	});
	Route::get('student/thesis',function()
	{ 
		return View::make('student/thesis');
	});
	Route::get('student/timeline',function()
	{ 
		return View::make('student/timeline');
	});
	
	Route::get('student/{name}/',function($name)
	{ 
		return Redirect::to('student/'.$name.'/profile')->with('name',$name);
	});
	Route::get('student/{name}/tasks',function($name)
	{ 
		return View::make('supervisor/student/tasks')->with('name',$name);
	});
	Route::get('student/{name}/addTask',function($name)
	{ 
		return View::make('supervisor/student/addTask')->with('name',$name);
	});
	Route::get('student/{name}/thesis',function($name)
	{ 
		return View::make('supervisor/student/thesis')->with('name',$name);
	});
	Route::get('student/{name}/timeline',function($name)
	{ 
		return View::make('supervisor/student/timeline')->with('name',$name);
	});
	Route::get('student/{name}/report',function($name)
	{ 
		return View::make('supervisor/student/report')->with('name',$name);
	});
	Route::get('student/{name}/profile',function($name)
	{ 
		return View::make('supervisor/student/profile')->with('name',$name);
	});
	Route::get('student/{name}/view/{taskname}',function($name)
	{ 
		return View::make('supervisor/student/viewTask')->with('name',$name);
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
	Route::get('supervisor/student',function()
	{ 
		return View::make('supervisor/student');
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
	Route::get('supervisor/template/{name}/edit',function($name)
	{ 
		return View::make('supervisor/editTemplate');
	});
	Route::get('supervisor/field',function()
	{ 
		return View::make('supervisor/field');
	});
	
	