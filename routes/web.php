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

//Organizations
Route::get('organization/index', 'OrganizationController@index')->name('organization.index');
Route::get('organization/create', 'OrganizationController@getCreate')->name('organization.getCreate');
Route::post('organization/create', 'OrganizationController@postCreate')->name('organization.postCreate');
Route::get('organization/edit/{id}', 'OrganizationController@getEdit')->name('organization.getEdit');
Route::post('organization/edit', 'OrganizationController@postEdit')->name('organization.postEdit');
Route::post('organization/delete', 'OrganizationController@delete')->name('organization.delete');

//Employee
Route::get('employee/index', 'EmployeeController@index')->name('employee.index');
Route::get('employee/create', 'EmployeeController@getCreate')->name('employee.getCreate');
Route::post('employee/create', 'EmployeeController@postCreate')->name('employee.postCreate');
Route::get('employee/edit/{id}', 'EmployeeController@getEdit')->name('employee.getEdit');
Route::post('employee/edit', 'EmployeeController@postEdit')->name('employee.postEdit');
Route::post('employee/delete', 'EmployeeController@delete')->name('employee.delete');

//Table
Route::get('table/index', 'TableController@index')->name('table.index');
Route::get('table/create', 'TableController@getCreate')->name('table.getCreate');
Route::post('table/create', 'TableController@postCreate')->name('table.postCreate');
Route::get('table/edit/{id}', 'TableController@getEdit')->name('table.getEdit');
Route::post('table/edit', 'TableController@postEdit')->name('table.postEdit');
Route::post('table/delete', 'TableController@delete')->name('table.delete');


//Button
Route::get('button/index', 'ButtonController@index')->name('button.index');
Route::get('button/create', 'ButtonController@getCreate')->name('button.getCreate');
Route::post('button/create', 'ButtonController@postCreate')->name('button.postCreate');
Route::get('button/edit/{id}', 'ButtonController@getEdit')->name('button.getEdit');
Route::post('button/edit', 'ButtonController@postEdit')->name('button.postEdit');
Route::post('button/delete', 'ButtonController@delete')->name('button.delete');