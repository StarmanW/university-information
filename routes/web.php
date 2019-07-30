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

Route::get('/programme', 'ProgrammeController@index');
Route::get('/programme/add', 'ProgrammeController@create');
Route::post('/programme/add', 'ProgrammeController@store');

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'RedirectAdmin']], function () {
    Route::get('/home', 'AdminControllers\AdminController@index');
});