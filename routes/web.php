<?php

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
Route::middleware(['access'])->group(function () {
	Route::get('/', function () {
	    return view('welcome');
	});
	Route::post('/add', 'ClassroomController@handleAddClassroom')->name('handleAddClassroom');
	Route::get('/delete/{id}', 'ClassroomController@handleDeleteClassroom')->name('handleDeleteClassroom');
	Route::get('/list', 'ClassroomController@showClassrooms')->name('showClassrooms');
	Route::get('/show/{id}', 'ClassroomController@handleShowClassroom')->name('handleShowClassroom');
	Route::post('/update', 'ClassroomController@handleUpdate')->name('handleUpdate');

	Route::get('/user/register', 'ClassroomController@showRegister')->name('showRegister');
	Route::get('/user/logout', 'ClassroomController@logout')->name('logout');
	Route::get('/showstudents/{id}', 'ClassroomController@showStudents')->name('showStudents');
	Route::get('/deletestudent/{id}', 'ClassroomController@handleDeletestudent')->name('handleDeletestudent'); 
	Route::post('/user/register', 'ClassroomController@handleRegister')->name('handleRegister');
});

Route::get('/user/login', 'ClassroomController@showLogin')->name('showLogin');

Route::post('/user/login', 'ClassroomController@handleLogin')->name('handleLogin');





