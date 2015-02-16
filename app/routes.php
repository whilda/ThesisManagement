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


Route::pattern('number', '[0-9]+');
//grup non-login
Route::group(array('before'=>'guest'), function(){
	Route::get('/', 'AuthController@logIn');
	Route::get('signup', 'AuthController@Signup');
	Route::post('signup/student', 'AuthController@SignupStudent');
	Route::post('signup/supervisor', 'AuthController@SignupSupervisor');
	Route::post('doAuth','AuthController@Auth');
	Route::post('exist','AuthController@isExist');
});
Route::group(array('before'=>'auth'), function(){
	Route::get('logout','AuthController@logOut');
	Route::get('field/get/{search?}', 'GeneralController@getField');
});

//khusus student
Route::group(array('before'=>'student'), function(){
	Route::get('student/home',"StudentController@home");
	Route::get('student/code',function()
	{ 
		return View::make('student/code');
	});
	Route::get('student/supervisorList/field/{field}/{number?}',"StudentController@SupervisorByField");
	Route::get('student/supervisorList/{number?}',"StudentController@SupervisorList");
	Route::get('student/supervisor/{username}',"StudentController@SupervisorView");
	Route::get('student/supervisor/select/{username}',"StudentController@SelectSupervisor");
	Route::get('student/report',function()
	{ 
		return View::make('student/report');
	});
	Route::get('student/profile/edit',"StudentController@EditProfile");
	Route::post('student/profile/save',"StudentController@SaveProfile");
	Route::get('student/profile',"StudentController@Profile");
	Route::get('student/thesis',"StudentController@EditThesis");
	Route::post('student/thesis/save',"StudentController@SaveThesis");
	Route::get('student/timeline',function()
	{ 
		return View::make('student/timeline');
	});
});

//khusus supervisor
Route::group(array('before'=>'supervisor'), function(){
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
	
	Route::post('supervisor/field/add', 'SupervisorController@addField');
	Route::post('supervisor/field/del', 'SupervisorController@delField');
	
	Route::get('supervisor/home',function()
	{ 
		return View::make('supervisor/dashboard');
	});
	Route::get('supervisor/proposal/accept/{username}','SupervisorController@AcceptPropose');
	Route::get('supervisor/proposal/decline/{username}','SupervisorController@DeclinePropose');
	Route::get('supervisor/proposal/{number?}','SupervisorController@ProposalList');
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
	Route::get('supervisor/profile/edit',"SupervisorController@EditProfile");
	Route::post('supervisor/profile/save',"SupervisorController@SaveProfile");
	Route::get('supervisor/profile',"SupervisorController@Profile");
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
});