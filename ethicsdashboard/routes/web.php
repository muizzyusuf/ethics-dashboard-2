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

Route::get('/courses/{course}/people','App\http\Controllers\CourseController@people')->name('courses.people');

Route::get('/courses/{course}/grade','App\http\Controllers\CourseController@grade')->name('courses.grade');

//This resource contains the following routes in case study controller index, create, store, edit, update, destroy
Route::resource('/casestudy','App\http\Controllers\CaseStudyController');

//This resource contains the following routes in dashboard controller index, create, store, edit, update, destroy
Route::resource('/dashboard','App\http\Controllers\DashboardController');

//This resource contains the following routes in courseuser controller index, create, store, edit, update, destroy
//Route::resource('/courseuser','App\http\Controllers\CourseUserController');

Route::post('/courses/courseuser','App\http\Controllers\CourseUserController@store')->name('courseuser.store');

Route::delete('/courses/courseuser/{course}/{user}','App\http\Controllers\CourseUserController@destroy')->name('courseuser.destroy');
