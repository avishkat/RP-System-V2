<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/student/profile', function () {
    return view('student.studentprofile');
});

Route::get('/supervisor/profile', function () {
    return view('supervisor.supervisorprofile');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');
Route::get('/supervisor', 'SupervisorController@index2')->name('supervisor')->middleware('supervisor');
Route::get('/student', 'StudentController@index')->name('student')->middleware('student');

Route::group(['middleware' => ['admin']], function() {
    Route::get('/admin/remove-admin/{userId}', 'AdminController@removeAdmin');
    
    Route::get('/admin/give-admin/{userId}', 'AdminController@giveAdmin');
    
    Route::get('/admin/remove-supervisor/{userId}', 'AdminController@removeSupervisor');
    
    Route::get('/admin/give-supervisor/{userId}', 'AdminController@giveSupervisor');
});


Route::get('/admin/userpermission', 'AdminController@displayUsers')->name('addrole');

Route::resource('/admin/researcharea', 'Admin\ResearchAreasController', ['as'=>'admin']);

Route::resource('/admin/projects', 'Admin\ProjectsController', ['as'=>'admin']);

Route::resource('/supervisor/projects', 'Supervisor\ProjectsController', ['as'=>'supervisor']);

Route::resource('/admin/constraints', 'Admin\ConstraintsController', ['as'=>'admin']);

Route::resource('/admin/supervisors', 'Admin\SupervisorsController', ['as'=>'admin']);

Route::resource('/admin/researchhistories', 'Admin\ResearchHistoriesController', ['as'=>'admin']);

Route::get('/admin/finalprojects/export-excel', 'Admin\FinalProjectsController@exportIntoExcel', ['as'=>'admin']);

Route::resource('/admin/finalprojects', 'Admin\FinalProjectsController', ['as'=>'admin']);

// Route::get('/student/projects/supervisor/{id}', 'Student\ProjectsController@showSupProject')->name('projectlist');
// Route::get('/student/projects/supervisor/{id}', 'Student\UserController@showSupProject')->name('projectlist');

Route::get('/student/projects/supervisor/{id}', 'Student\ProjectsController@showSupProject')->name('projectlist');

Route::get('/student/projects/area/{id}', 'Student\ProjectsController@showAreaProject')->name('projectlistarea');

Route::get('/student/projects/{id}', 'Student\ProjectsController@show')->name('projectshow');

Route::resource('/student/projects', 'Student\ProjectsController', ['as'=>'student']);

Route::post('/student/filter', 'Student\UserController@filter')->name('filter1');

Route::resource('/student/projects', 'Student\UserController', ['as'=>'student']);

Route::post('/student/researchgroups/filter', 'Student\ResearchGroupsController@filter')->name('filter');

Route::resource('/student/researchgroups', 'Student\ResearchGroupsController', ['as'=>'student']);

Route::resource('/student/projectbids', 'Student\ProjectBidsController', ['as'=>'student']);

Route::get('/student/supervisors/{id}', 'Student\SupervisorsController@show')->name('supervisorprofile');

Route::get('/student/supervisors/fetch_image/{id}', 'Student\SupervisorsController@fetch_image')->name('supervisorprofile');

Route::resource('/student/supervisors', 'Student\SupervisorsController', ['as'=>'student']);

Route::resource('/supervisor/supervisors', 'Supervisor\SupervisorsController', ['as'=>'supervisor']);

Route::resource('/supervisor/projectbids', 'Supervisor\ProjectBidsController', ['as'=>'supervisor']);

Route::resource('/student/researchareas', 'Student\ResearchAreasController', ['as'=>'student']);

