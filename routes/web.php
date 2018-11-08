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

Route::get('/', function () {
    return view('pages/home');
});
Route::get('employee', 'EmployeeController@index')->name('employee.index');
Route::get('employee/create', 'EmployeeController@getCreate')->name('employee.create');
Route::post('/employee/create', 'EmployeeController@postCreate')->name('employee.postCreate');
Route::get('/employee/edit', 'EmployeeController@index')->name('employee.edit');
Route::get('/employee/search', 'EmployeeController@search')->name('employee.search');
Route::get('/employee/index', 'EmployeeController@index')->name('employee.index');