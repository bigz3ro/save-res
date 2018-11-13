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
    return view('pages.home');
});


//Employee route
Route::get('employee', 'EmployeeController@index')->name('employee.index');
Route::get('employee/create', 'EmployeeController@getCreate')->name('employee.create');
Route::post('/employee/create', 'EmployeeController@postCreate')->name('employee.postCreate');
Route::get('/employee/edit', 'EmployeeController@index')->name('employee.edit');
Route::get('/employee/search', 'EmployeeController@search')->name('employee.search');
Route::get('/employee/index', 'EmployeeController@index')->name('employee.index');
// ---------------


//Auth route
// Route::get('register', 'Auth\RegisterController@getRegister');
// Route::post('register', 'Auth\RegisterController@postRegister');
Route::get('login', [ 'as' => 'login', 'uses' => 'AuthController@getLogin']);
Route::post('post-login', ['as' => 'auth.postLogin', 'uses' => 'AuthController@postLogin']);
Route::get('logout', [ 'as' => 'logout', 'uses' => 'AuthController@logout'])->middleware('auth');
// Route::get('forgot-password', ['as' => 'forgotPassword', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
// Route::post('reset/send-email', ['as' => 'send-email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);

// ---------------

//User route
Route::get('user', 'UserController@index')->name('user.index');
Route::get('user/index', 'UserController@index')->name('user.index');
Route::get('user/search', 'UserController@search')->name('user.search');
Route::get('user/create', 'UserController@getCreate')->name('user.getCreate');
Route::post('user/create', 'UserController@postCreate')->name('user.postCreate');
Route::get('user/edit', 'UserController@getEdit')->name('user.getEdit');
Route::post('user/edit', 'UserController@postEdit')->name('user.postEdit');
Route::post('user/delete', 'UserController@delete')->name('user.delete');
// ---------------

//role
Route::get('role/index', 'RoleController@index')->name('role.index');
Route::get('role/create', 'RoleController@getCreate')->name('role.getCreate');
Route::post('role/post-create', 'RoleController@postCreate')->name('role.postCreate');
Route::get('role/edit/{id}', 'RoleController@getEdit')->name('role.getEdit');
Route::post('role/edit', 'RoleController@postEdit')->name('role.postEdit');
Route::post('role/delete', 'RoleController@delete')->name('role.delete');

