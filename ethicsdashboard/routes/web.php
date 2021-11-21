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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//This resource contains the following routes in course controller index, create, store, edit, update, destroy
Route::resource('/courses','App\http\Controllers\CourseController');

//This resource contains the following routes in case study controller index, create, store, edit, update, destroy
Route::resource('/casestudy','App\http\Controllers\CaseStudyController');

//This resource contains the following routes in dashboard controller index, create, store, edit, update, destroy
Route::resource('/dashboard','App\http\Controllers\DashboardController');


Route::get('/stakeholders/{id}', [
    'as' => 'stakeholders', 
    'uses' => 'App\Http\Controllers\StakeholderController@index'
]);

Route::post('/stakeholders/{id}', [
    'as' => 'stakeholders', 
    'uses' => 'App\Http\Controllers\StakeholderController@store'
]);

Route::get('/ethicalissues/{id}', [
    'as' => 'ethicalissues', 
    'uses' => 'App\Http\Controllers\EthicalIssueController@index'
]);

Route::post('/ethicalissues/{id}', [
    'as' => 'ethicalissues', 
    'uses' => 'App\Http\Controllers\EthicalIssueController@store'
]);

Route::get('/options/{id}', [
    'as' => 'options', 
    'uses' => 'App\Http\Controllers\OptionController@index'
]);

Route::post('/options/{id}', [
    'as' => 'options', 
    'uses' => 'App\Http\Controllers\OptionController@store'
]);
