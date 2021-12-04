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

Route::get('/admin', function () {
    return view('index');
})->middleware(['is_admin'])->name('index');

Route::resource('topic', 'Admin\TopicController')->middleware(['is_admin']);
Route::get('fetchTopics', 'Admin\TopicController@fetchTopics')->middleware(['is_admin']);

Route::resource('month', 'Admin\MonthController')->middleware(['is_admin']);
Route::get('fetchMonths', 'Admin\MonthController@fetchMonths')->middleware(['is_admin']);

Route::resource('day', 'Admin\DayController')->middleware(['is_admin']);
Route::get('fetchDays', 'Admin\DayController@fetchDays')->middleware(['is_admin']);
Route::get('fetchSpecificMonths/{topic}', 'Admin\DayController@fetchSpecificMonths')->middleware(['is_admin']);

Route::resource('challenge', 'Admin\ChallengeController')->middleware(['is_admin']);
Route::get('fetchChallenges', 'Admin\ChallengeController@fetchChallenges')->middleware(['is_admin']);
Route::get('fetchSpecificDays/{month}', 'Admin\ChallengeController@fetchSpecificDays')->middleware(['is_admin']);

Route::resource('meditation', 'Admin\MeditationController')->middleware(['is_admin']);
Route::get('fetchMeditations', 'Admin\MeditationController@fetchMeditations')->middleware(['is_admin']);

Route::resource('category', 'Admin\CategoryController')->middleware(['is_admin']);
Route::get('fetchCategories', 'Admin\CategoryController@fetchCategories')->middleware(['is_admin']);

Route::resource('fitness', 'Admin\FitnessController')->middleware(['is_admin']);
Route::get('fetchFitnesses', 'Admin\FitnessController@fetchFitnesses')->middleware(['is_admin']);

Route::resource('notification', 'Admin\NotificationController')->middleware(['is_admin']);
Route::get('fetchNotifications', 'Admin\NotificationController@fetchNotifications')->middleware(['is_admin']);

Route::resource('user', 'Admin\UserController')->middleware(['is_admin']);
Route::get('fetchUsers', 'Admin\UserController@fetchUsers')->middleware(['is_admin']);
require __DIR__.'/auth.php';
