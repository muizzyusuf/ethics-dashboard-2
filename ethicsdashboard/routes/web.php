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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/coursePost', [App\Http\Controllers\CourseController::class, 'store'])->name('coursePost');

Route::get('/casestudy/{course_id}', [
    'as' => 'casestudy', 
    'uses' => 'App\Http\Controllers\CaseStudyController@index'
]);

Route::get('/course', function(){
    return view('/courseCreate');
});


