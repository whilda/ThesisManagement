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


Route::get('supervisor/laporan','PlagiasiController@getLaporan');
Route::get('plagiasi/{file}','PlagiasiController@cekPlagiasi');

//grup non-login
Route::group(array('before'=>'guest'), function(){
	Route::get('/', 'AuthController@logIn');
	Route::get('signup', 'AuthController@Signup');
	Route::post('signup/student', 'AuthController@SignupStudent');
	Route::post('signup/supervisor', 'AuthController@SignupSupervisor');
	Route::post('doAuth','AuthController@Auth');
	Route::post('exist','AuthController@isExist');
});

//grup login
Route::group(array('before'=>'auth'), function(){
	Route::get('logout','AuthController@logOut');
	Route::post('password/save',"GeneralController@ChangePassword");
	Route::get('field/get/{search?}', 'GeneralController@getField');
    Route::get('reference/get/{search?}', 'GeneralController@getReference');
	Route::get('download/{id}','GeneralController@getFile');
});

//khusus student
Route::group(array('before'=>'student'), function(){
	Route::get('student/home',"StudentController@home");
	Route::get('student/code',"StudentController@Code");
	Route::post('student/code/save',"StudentController@saveCode");
	Route::get('student/supervisorList/field/{field}/{number?}',"StudentController@SupervisorByField");
	Route::get('student/supervisorList/{number?}',"StudentController@SupervisorList");
	Route::get('student/supervisor/{username}',"StudentController@SupervisorView");
	Route::get('student/supervisor/select/{username}',"StudentController@SelectSupervisor");
	Route::get('student/report',"StudentController@finalReport");
	Route::post('student/report/upload',"StudentController@uploadReport");
	Route::get('student/profile/edit',"StudentController@EditProfile");
	Route::post('student/profile/save',"StudentController@SaveProfile");
	Route::get('student/profile/password',"StudentController@Password");
	Route::get('student/profile',"StudentController@Profile");
	Route::get('student/thesis',"StudentController@EditThesis");
	Route::post('student/thesis/save',"StudentController@SaveThesis");
	Route::get('student/timeline',function()
	{ 
		return View::make('student/timeline');
	});
	Route::get('student/task/{id}',"StudentController@viewTask");
	Route::post('student/task/{id}/creatework',"StudentController@createWork");
	Route::post('student/task/{id}/comment',"StudentController@addComment");
    Route::get('student/library',function()
	{ 
		return View::make('student/library');
	});
    Route::get('student/library/reccomendation',function()
	{ 
		return View::make('student/reccomendation');
	});
    Route::get('student/mylibrary',function()
	{ 
		return View::make('student/mylibrary');
	});
    Route::post('student/reference/add', 'StudentController@addReference');
    Route::get('student/reference/get/{search?}', 'StudentController@getAllReference');
    Route::get('student/reference/reccomendation', 'StudentController@getRefReccomendation');
    Route::post('student/reference/del', 'StudentController@delReference');
    Route::post('student/reference/create', 'StudentController@createReference');
    Route::get('student/reference/view/{id}', 'StudentController@getReference');
});

//khusus supervisor
Route::group(array('before'=>'supervisor'), function(){
	Route::get('student/{username}',"ViewStudentController@profile");
	Route::get('student/{username}/tasks',"ViewStudentController@tasks");
	Route::get('student/{username}/addTask',function($name)
	{ 
		return View::make('supervisor/student/addTask')->with('name',$name);
	});
	Route::get('student/{username}/thesis',"ViewStudentController@thesis");
	Route::get('student/{username}/timeline',"ViewStudentController@timeline");
	Route::get('student/{username}/report',"ViewStudentController@report");
	Route::get('student/{username}/report/{response}',"SupervisorController@responseFinal");
	Route::get('student/{username}/profile',"ViewStudentController@profile");
	Route::get('student/{username}/view/{taskname}',"ViewStudentController@viewTask");
	Route::get('student/{username}/getTasks',"ViewStudentController@getAllTasks");
	Route::get('student/{username}/task/{id}',"ViewStudentController@getTask");
	Route::post('student/{username}/task/add',"SupervisorController@addTask");
	Route::post('student/{username}/task/del',"SupervisorController@delTask");
	Route::post('student/{username}/task/validation',"SupervisorController@validateTask");
	Route::post('student/{username}/task/{id}/creatework',"SupervisorController@createWork");
	Route::post('student/{username}/task/{id}/edit',"SupervisorController@updateTask");
	Route::post('student/{username}/task/{id}/comment',"SupervisorController@addComment");
	
	Route::post('supervisor/field/add', 'SupervisorController@addField');
	Route::post('supervisor/field/del', 'SupervisorController@delField');
	
	Route::get('supervisor/home', 'SupervisorController@home');
	Route::get('supervisor/proposal/accept/{username}','SupervisorController@AcceptPropose');
	Route::get('supervisor/proposal/decline/{username}','SupervisorController@DeclinePropose');
	Route::get('supervisor/proposal/{number?}','SupervisorController@ProposalList');
	Route::get('supervisor/studentList/{number?}','SupervisorController@StudentList');
	Route::get('supervisor/profile/password',"SupervisorController@Password");
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
	Route::get('supervisor/template/get',"SupervisorController@getTemplates");
	Route::post('supervisor/template/create',"SupervisorController@createTemplate");
	Route::get('supervisor/template/delete/{code}',"SupervisorController@deleteTemplate");
	Route::get('supervisor/template/{code}',"SupervisorController@editTemplate");
	Route::post('supervisor/template/{code}/save',"SupervisorController@updateTemplate");
	Route::post('supervisor/template/{code}/task/add',"SupervisorController@addTaskTemplate");
	Route::post('supervisor/template/{code}/task/{name}/edit',"SupervisorController@updateTaskTemplate");
	Route::get('supervisor/template/{code}/task/{name}/delete',"SupervisorController@deleteTaskTemplate");
	Route::get('supervisor/template/{code}/tasks',"SupervisorController@getTaskTemplate");
	Route::get('supervisor/field',function()
	{ 
		return View::make('supervisor/field');
	});
    Route::get('supervisor/library',function()
	{ 
		return View::make('supervisor/library');
	});
    Route::post('supervisor/reference/create', 'SupervisorController@createReference');
    Route::post('supervisor/reference/del', 'SupervisorController@delReference');
    Route::get('supervisor/reference/edit/{id}', 'SupervisorController@getReference');
    Route::post('supervisor/reference/edit/{id}/save', 'SupervisorController@updateReference');
});