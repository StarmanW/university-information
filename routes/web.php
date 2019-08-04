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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/login', function () {
//    return view('login');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Programme routes
Route::get('/programme', 'ProgrammeController@index');
Route::get('/programme/add', 'ProgrammeController@create');
Route::post('/programme/add', 'ProgrammeController@store');
Route::get('/programme/{id}/view', 'ProgrammeController@show');
Route::get('/programme/{id}/edit', 'ProgrammeController@edit');
Route::post('/programme/{id}/edit', 'ProgrammeController@update');
Route::post('/programme/{id}/delete', 'ProgrammeController@delete');

// Programme courses routes
Route::get('/programme/{id}/courses', 'CourseController@courses');
Route::post('/programme/{id}/add_prog_courses', 'CourseController@addProgCourses');
Route::post('/programme/{id}/remove_prog_courses', 'CourseController@removeProgCourses');

Route::get('/programme/{id}/elective_courses', 'CourseController@electiveCourses');
Route::post('/programme/{id}/add_prog_elective_courses', 'CourseController@addProgElectiveCourses');
Route::post('/programme/{id}/remove_prog_elective_courses', 'CourseController@removeProgElectiveCourses');

// Programme certificates routes
Route::get('/certificates', 'CertificateController@index');
Route::get('/certificates/add', 'CertificateController@create');
Route::post('/certificates/add', 'CertificateController@store');
Route::get('/certificates/{id}/edit', 'CertificateController@edit');
Route::post('/certificates/{id}/edit', 'CertificateController@update');
Route::post('/certificates/{id}/delete', 'CertificateController@delete');

// Course routes
Route::get('/courses', 'CourseController@index');
Route::get('/courses/add', 'CourseController@create');
Route::post('/courses/add', 'CourseController@store');
Route::get('/courses/{id}/edit', 'CourseController@edit');
Route::post('/courses/{id}/edit', 'CourseController@update');
Route::post('/courses/{id}/delete', 'CourseController@delete');

//admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'RedirectAdmin']], function () {
    Route::get('/home', 'AdminControllers\AdminController@index');
    Route::get('/user/{id}/edit', 'AdminControllers\EditController@create');
    Route::post('/user/{id}/edit', 'AdminControllers\EditController@edit');
});