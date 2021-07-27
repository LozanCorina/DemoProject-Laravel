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
})->name('home');

Route::get('/test','ChartController@test');
Route::get('/chart','ChartController@index');
Route::get('/insert','StatmentController@insertRowsPrj1')->name('insert');
Route::get('/insert2','StatmentController@insertRowsMilestone')->name('insertPrj2');
//calendar test
Route::get('/full-calender','CalendarController@index')->name('calendar');
Route::post('/full-calender/action','CalendarController@action');
//cal demo data
Route::get('/calendar','CalendarController@show');
Route::post('/calendar/statment','CalendarController@statment');
Route::get('/crud','DataController@index')->name('crud');
//crud team
Route::get('/show-team','DataController@team')->name('team');
Route::post('/store-team','DataController@store_team')->name('store.team');
Route::post('/detele-team/{id}','DataController@delete_team')->name('team.destroy');
Route::post('/update-team','DataController@update_team')->name('team.update');
//crud projects
Route::get('/show-prj','DataController@projects')->name('projects');
Route::post('/store-project','DataController@store_project')->name('store.project');
Route::post('/detele-project/{id}','DataController@delete_project')->name('project.destroy');
Route::post('/update-project','DataController@update_project')->name('project.update');
//crud tasks 
Route::get('/show-tasks','DataController@tasks')->name('tasks');
Route::post('/store-task','DataController@store_task')->name('store.task');
Route::post('/detele-task/{id}','DataController@delete_task')->name('task.destroy');
Route::post('/update-task','DataController@update_task')->name('update.task');
//crud milestones
Route::get('/show-mile','DataController@milestones')->name('milestones');
Route::post('/store-milestone','DataController@store_mile')->name('store.milestone');
Route::post('/detele-milestone/{id}','DataController@delete_mile')->name('mile.destroy');
Route::post('/update-mile','DataController@update_mile')->name('update.mile');

//test connection with oracle 
//Route::get('/test','OracleController@index')->name('test');
//update data
Route::post('/update/{model}','DataController@update')->name('update');
