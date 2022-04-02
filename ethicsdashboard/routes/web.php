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

//resource for showing the ethical issues page of the dashboard and modifying issues and options
Route::resource('/ethicalissue','App\http\Controllers\EthicalIssueController');

//route for adding grades and comments to ethical issue section
Route::post('/ethicalissue/{ethicalissue}','App\http\Controllers\EthicalIssueController@comment')->name('ethicalissue.comment');

//resource helps with modifying stakeholders and their interests
Route::resource('/stakeholder','App\http\Controllers\StakeholderController');

//This resource contains the following routes in stakeholder section controller index, create, store, edit, update, destroy
Route::resource('/stakeholdersection','App\http\Controllers\StakeholderSectionController');

//route for adding grades and comments to stakeholder section
Route::post('/stakeholdersection/{stakeholdersection}','App\http\Controllers\StakeholderSectionController@comment')->name('stakeholdersection.comment');

//This resource contains the following routes in progress controller index, create, store, edit, update, destroy
Route::resource('/progress','App\http\Controllers\ProgressController');

//This resource contains the following routes in util section controller index, create, store, edit, update, destroy
Route::resource('/utilitarianismsection','App\http\Controllers\UtilitarianismSectionController');

//route for adding grades and comments to util section
Route::post('/utilitarianismsection/{utilitarianismsection}','App\http\Controllers\UtilitarianismSectionController@comment')->name('utilitarianismsection.comment');

//route for inputing final utilitarian decision
Route::post('/utilitarianismsection/{utilitarianismsection}/decision','App\http\Controllers\UtilitarianismSectionController@decision')->name('utilitarianismsection.decision');

//route for viewing impact section in util section
Route::get('/utilitarianismsection/{utilitarianismsection}/impact','App\http\Controllers\UtilitarianismSectionController@impact')->name('utilitarianismsection.impact');

//route for viewing aggregate page for util section
Route::get('/utilitarianismsection/{utilitarianismsection}/aggregate','App\http\Controllers\UtilitarianismSectionController@aggregate')->name('utilitarianismsection.aggregate');

//route for viewing summary of inputs in utilitarianism section
Route::get('/utilitarianismsection/{utilitarianismsection}/summary','App\http\Controllers\UtilitarianismSectionController@summary')->name('utilitarianismsection.summary');

//This resource contains the following routes in consequence controller index, create, store, edit, update, destroy
Route::resource('/consequence','App\http\Controllers\ConsequenceController');

//This resource contains the following routes in impact controller index, create, store, edit, update, destroy
Route::resource('/impact','App\http\Controllers\ImpactController');

//This resource contains the following routes in pleasure controller index, create, store, edit, update, destroy
Route::resource('/pleasure','App\http\Controllers\PleasureController');

//This resource contains the following routes in deontology section controller index, create, store, edit, update, destroy
Route::resource('/deontologysection','App\http\Controllers\DeontologySectionController');

//This resource contains the following routes in virtue section controller index, create, store, edit, update, destroy
Route::resource('/virtuesection','App\http\Controllers\VirtueSectionController');

//This resource contains the following routes in care section controller index, create, store, edit, update, destroy
Route::resource('/caresection','App\http\Controllers\CareSectionController');

//This resource contains the following routes in motivation controller index, create, store, edit, update, destroy
Route::resource('/motivation','App\http\Controllers\MotivationController');

//This resource contains the following routes in moral issue controller index, create, store, edit, update, destroy
Route::resource('/moralissue','App\http\Controllers\MoralIssueController');

//This resource contains the following routes in moral law controller index, create, store, edit, update, destroy
Route::resource('/morallaw','App\http\Controllers\MoralLawController');

//This resource contains the following routes in virtue controller index, create, store, edit, update, destroy
Route::resource('/virtue','App\http\Controllers\VirtueController');

//This resource contains the following routes in care controller index, create, store, edit, update, destroy
Route::resource('/care','App\http\Controllers\CareController');

//route for viewing summary of inputs in care ethics section
Route::get('/caresection/{caresection}/summary','App\http\Controllers\CareSectionController@summary')->name('caresection.summary');

//route for inputing final care ethics decision
Route::post('/caresection/{caresection}/decision','App\http\Controllers\CareSectionController@decision')->name('caresection.decision');

//route for adding grades and comments to care section
Route::post('/caresection/{caresection}','App\http\Controllers\CareSectionController@comment')->name('caresection.comment');

//route for viewing summary of inputs in virtue ethics section
Route::get('/virtuesection/{virtuesection}/summary','App\http\Controllers\VirtueSectionController@summary')->name('virtuesection.summary');

//route for viewing character section of inputs in virtue ethics section
Route::get('/virtuesection/{virtuesection}/character','App\http\Controllers\VirtueSectionController@character')->name('virtuesection.character');

//route for inputing final virtue ethics decision
Route::post('/virtuesection/{virtuesection}/decision','App\http\Controllers\VirtueSectionController@decision')->name('virtuesection.decision');

//route for adding grades and comments to virtue section
Route::post('/virtuesection/{virtuesection}','App\http\Controllers\VirtueSectionController@comment')->name('virtuesection.comment');

//This resource contains the following routes in the user controller index, create, store, edit, update, destroy
Route::resource('/user','App\http\Controllers\UserController');

//route for changing user password
Route::put('/user/{user}/password','App\http\Controllers\UserController@password')->name('user.password');

//Route::post('/tasks', 'App\http\Controllers\TaskController@exportCsv')->name('tasks');

Route::post('/tasks', [App\Http\Controllers\TaskController::class, 'exportCsv'])->name('tasks');

//route for pdf export
Route::post('/downloadPDF',[App\Http\Controllers\TaskController::class, 'downloadPDF'])->name('downloadPDF');

//route for viewing summary of inputs in deontology section
Route::get('/deontologysection/{deontologysection}/summary','App\http\Controllers\DeontologySectionController@summary')->name('deontologysection.summary');

//route for adding grades and comments to deontology section
Route::post('/deontologysection/{deontologysection}','App\http\Controllers\DeontologySectionController@comment')->name('deontologysection.comment');

//route for inputing deontology section decision
Route::post('/deontologysection/{deontologysection}/decision','App\http\Controllers\DeontologySectionController@decision')->name('deontologysection.decision');

//route for viewing moral issue section of inputs in deontology section
Route::get('/deontologysection/{deontologysection}/moralissue','App\http\Controllers\DeontologySectionController@moralissue')->name('deontologysection.moralissue');

//route for viewing universalizability section of inputs in deontology section
Route::get('/deontologysection/{deontologysection}/universalizability','App\http\Controllers\DeontologySectionController@universalizability')->name('deontologysection.universalizability');


