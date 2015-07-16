<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/home', function () {
    return view('login');
});

Route::get('users', 'UsersController@index');
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::post('users/edit/{id}/{usernumber}', 'UsersController@update');
Route::post('users/delete', 'UsersController@delete');
Route::get('users/edit/{id}/{usernumber}', 'UsersController@edit');

Route::get('attendance/index', 'AttendanceController@index');
Route::post('attendance/index', 'AttendanceController@stop');
Route::post('attendance/verification-details', 'AttendanceController@show');
Route::post('attendance/verification-details/{usernumber}', 'AttendanceController@show');

Route::get('reports', 'ReportsController@index');