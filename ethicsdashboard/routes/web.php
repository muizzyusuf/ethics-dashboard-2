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

// course post page is now redundant due to model
// Route::post('/coursePost', [App\Http\Controllers\CourseController::class, 'store'])->name('coursePost');

// Route::get('/course', function(){   REDUNDANT
//     return view('/courseCreate');
// });
Route::get('/csCreate/{course_id}', [
    'as'=>'csCreate',
    'uses' => 'App\Http\Controllers\CaseStudyController@show'
]);


Route::get('/casestudy/{course_id}', [
    'as' => 'casestudy', 
    'uses' => 'App\Http\Controllers\CaseStudyController@index'
]);

Route::post('/caseStudyPost/{course_id}', [
    'as' => 'caseStudyPost', 
    'uses' => 'App\Http\Controllers\CaseStudyController@store'
]);

Route::get('/casestudyInstr/{id}', [
    'as' => 'casestudyInstr', 
    'uses' => 'App\Http\Controllers\CaseStudyController@instructions'
]);

Route::get('/dashboard/{case_study_id}', [
    'as' => 'dashboard', 
    'uses' => 'App\Http\Controllers\DashboardController@index'
]);

Route::post('/dashboardPost/{case_study_id}', [
    'as' => 'dashboardPost', 
    'uses' => 'App\Http\Controllers\DashboardController@store'
]);



//This resource contains the following routes in course controller index, create, store, edit, update, destroy
Route::resource('/courses','App\http\Controllers\CourseController');

