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

//get the peoples page for courses
Route::get('/courses/{course}/people','App\http\Controllers\CourseController@people')->name('courses.people');

//get the grades page for courses
Route::get('/courses/{course}/grade','App\http\Controllers\CourseController@grade')->name('courses.grade');

//This resource contains the following routes in case study controller index, create, store, edit, update, destroy
Route::resource('/casestudy','App\http\Controllers\CaseStudyController');

//This resource contains the following routes in dashboard controller index, create, store, edit, update, destroy
Route::resource('/dashboard','App\http\Controllers\DashboardController');

//This route helps with registering ta's and students to course
Route::post('/courses/courseuser','App\http\Controllers\CourseUserController@store')->name('courseuser.store');

//This route helps with deleting students from a course
Route::delete('/courses/courseuser/{course}/{user}','App\http\Controllers\CourseUserController@destroy')->name('courseuser.destroy');

//route for showing the ethical issues page of the dashboard and modifying issues and options
Route::resource('/ethicalissue','App\http\Controllers\EthicalIssueController');

//route for adding grades and comments to ethical issue section
Route::post('/ethicalissue/{ethicalissue}','App\http\Controllers\EthicalIssueController@comment')->name('ethicalissue.comment');

//route helps with modifying stakeholders and their interests
Route::resource('/stakeholder','App\http\Controllers\StakeholderController');

//route helps with showing the stakeholder section on the dashboard
Route::resource('/stakeholdersection','App\http\Controllers\StakeholderSectionController');

//route for adding grades and comments to stakeholder section
Route::post('/stakeholdersection/{stakeholdersection}','App\http\Controllers\StakeholderSectionController@comment')->name('stakeholdersection.comment');

//route for accessing the my progress section of the dashboard
Route::resource('/progress','App\http\Controllers\ProgressController');

//route helps with showing the stakeholder section on the dashboard
Route::resource('/utilitarianismsection','App\http\Controllers\UtilitarianismSectionController');

//route for adding grades and comments to stakeholder section
Route::post('/utilitarianismsection/{utilitarianismsection}','App\http\Controllers\UtilitarianismSectionController@comment')->name('utilitarianismsection.comment');

//route for adding grades and comments to stakeholder section
Route::post('/utilitarianismsection/{utilitarianismsection}/decision','App\http\Controllers\UtilitarianismSectionController@decision')->name('utilitarianismsection.decision');

//route for adding grades and comments to stakeholder section
Route::get('/utilitarianismsection/{utilitarianismsection}/impact','App\http\Controllers\UtilitarianismSectionController@impact')->name('utilitarianismsection.impact');

//route for adding grades and comments to stakeholder section
Route::get('/utilitarianismsection/{utilitarianismsection}/aggregate','App\http\Controllers\UtilitarianismSectionController@aggregate')->name('utilitarianismsection.aggregate');

//route for adding grades and comments to stakeholder section
Route::get('/utilitarianismsection/{utilitarianismsection}/summary','App\http\Controllers\UtilitarianismSectionController@summary')->name('utilitarianismsection.summary');

//route helps with showing the stakeholder section on the dashboard
Route::resource('/consequence','App\http\Controllers\ConsequenceController');

//route helps with showing the stakeholder section on the dashboard
Route::resource('/impact','App\http\Controllers\ImpactController');

//route helps with showing the stakeholder section on the dashboard
Route::resource('/pleasure','App\http\Controllers\PleasureController');