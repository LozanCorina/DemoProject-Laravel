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
    return view('home');
})->name('home');

Route::get('/exception', function () {
    return view('exceptions');
})->name('exceptions');
//exp oracle
Route::get('/exception-oracle', function () {
    return view('oracle.exceptions');
})->name('exceptions.oracle');

Route::get('/anexa-oracle', function () {
    return view('oracle.anexa');
})->name('anexa');


Route::get('/connection','ConnectionController@index')->name('connection');
Route::post('/set-conn','ConnectionController@set')->name('set.conn');
Route::get('/test','ChartController@test');
Route::get('/chart','ChartController@index');
Route::get('/chartOracle','OracleController@chart');
//export
Route::get('/export-oracle', function () {
    return view('oracle.exportcsv');
})->name('export.oracle');
Route::get('/export-mysql', function () {
    return view('exportcsv');
})->name('export.mysql');

Route::post('/export-csv-oracle-action','ExportImportController@exportCsvOracle')->name('exportcsv.oracle.action');
Route::post('/export-csv-mysql-action','ExportImportController@exportCsvMysql')->name('exportcsv.mysql.action');
Route::post('/export-mysql-action','ExportImportController@exportMysql')->name('export_sql.action');
//banca
Route::post('/banca','BancaController@execute');
//storage download files
Route::get('/download/{file}', 'BancaController@getFile')->name('getfile');
//oracle worksheet
Route::match(array('get','post'),'/worksheet','OracleController@worksheet')->name('worksheet');
//mysql worksheet
Route::match(array('get','post'),'/worksheet-mysql','DataController@worksheet')->name('worksheet.sql');
Route::get('/object-browser','OracleController@obiectBrowse')->name('obiect.browser');
Route::get('/insert','StatmentController@insertRowsPrj1')->name('insert');
Route::get('/insert2','StatmentController@insertRowsMilestone')->name('insertPrj2');
//Oracle calendar
Route::get('/calendar-data','OracleController@index')->name('index');
Route::get('/modify-calendar','OracleController@calendar');
//calendar test bun
Route::get('/full-calender','CalendarController@index')->name('calendar');
Route::post('/full-calender/action','CalendarController@action');
//cal demo data
Route::get('/calendar','CalendarController@show');//nu e bun
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
//oracle crud proj
Route::get('/projects','OracleController@projects')->name('projects.o');
Route::post('/del-project/{id}','OracleController@delete_project')->name('project.o.destroy');
//teams
Route::get('/teams','OracleController@teams')->name('team.o');
Route::post('/del-teams/{id}','OracleController@destroy')->name('team.o.destroy');
//mile
Route::get('/milestones','OracleController@mile')->name('milestones.o');
Route::post('/del-mile/{id}','OracleController@del_mile')->name('mile.o.destroy');
//tasks
Route::get('/tasks','OracleController@tasks')->name('tasks.o');
Route::post('/del-task/{id}','OracleController@del_task')->name('task.o.destroy');
//test connection with oracle
//Route::get('/test','OracleController@index')->name('test');
//update data
Route::post('/update/{model}','DataController@update')->name('update');
Route::post('/update-data/{model}','OracleController@updateData')->name('update_data');
Route::post('/data/{table}','OracleController@data')->name('data');

