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
Route::get('role/index', 'RoleController@index')
        ->middleware(['permission:role-list|role-create|role-edit|role-delete'])
        ->name('role.index');

Route::get('role/create', 'RoleController@getCreate')->name('role.getCreate')->middleware(['permission:role-create']);
Route::post('role/post-create', 'RoleController@postCreate')->name('role.postCreate')->middleware(['permission:role-create']);
Route::get('role/edit/{id}', 'RoleController@getEdit')->name('role.getEdit')->middleware(['permission:role-edit']);
Route::post('role/edit', 'RoleController@postEdit')->name('role.postEdit')->middleware(['permission:role-edit']);
Route::post('role/delete', 'RoleController@delete')->name('role.delete')->middleware(['permission:role-delete']);

//Organizations
Route::get('organization/index', 'OrganizationController@index')->name('organization.index')->middleware(['permission:organization-list|organization-create|organization-edit|organization-delete']);
Route::get('organization/create', 'OrganizationController@getCreate')->name('organization.getCreate')->middleware(['permission:organization-create']);
Route::post('organization/create', 'OrganizationController@postCreate')->name('organization.postCreate')->middleware(['permission:organization-create']);
Route::get('organization/edit/{id}', 'OrganizationController@getEdit')->name('organization.getEdit')->middleware(['permission:organization-edit']);
Route::post('organization/edit', 'OrganizationController@postEdit')->name('organization.postEdit')->middleware(['permission:organization-edit']);
Route::post('organization/delete', 'OrganizationController@delete')->name('organization.delete')->middleware(['permission:organization-delete']);

//Employee
Route::get('employee/index', 'EmployeeController@index')->name('employee.index')->middleware(['permission:employee-list|employee-create|employee-edit|employee-delete']);
Route::get('employee/create', 'EmployeeController@getCreate')->name('employee.getCreate')->middleware(['permission:employee-create']);
Route::post('employee/create', 'EmployeeController@postCreate')->name('employee.postCreate')->middleware(['permission:employee-create']);
Route::get('employee/edit/{id}', 'EmployeeController@getEdit')->name('employee.getEdit')->middleware(['permission:employee-edit']);
Route::post('employee/edit', 'EmployeeController@postEdit')->name('employee.postEdit')->middleware(['permission:employee-edit']);
Route::post('employee/delete', 'EmployeeController@delete')->name('employee.delete')->middleware(['permission:employee-delete']);

//Table
Route::get('table/index', 'TableController@index')->name('table.index')->middleware(['permission:table-list|table-create|table-edit|table-delete']);
Route::get('table/create', 'TableController@getCreate')->name('table.getCreate')->middleware(['permission:table-create']);
Route::post('table/create', 'TableController@postCreate')->name('table.postCreate')->middleware(['permission:table-create']);
Route::get('table/edit/{id}', 'TableController@getEdit')->name('table.getEdit')->middleware(['permission:table-edit']);
Route::post('table/edit', 'TableController@postEdit')->name('table.postEdit')->middleware(['permission:table-edit']);
Route::post('table/delete', 'TableController@delete')->name('table.delete')->middleware(['permission:table-delete']);

//Button
Route::get('button/index', 'ButtonController@index')->name('button.index')->middleware(['permission:button-list|button-create|button-edit|button-delete']);
Route::get('button/create', 'ButtonController@getCreate')->name('button.getCreate')->middleware(['permission:button-create']);
Route::post('button/create', 'ButtonController@postCreate')->name('button.postCreate')->middleware(['permission:button-create']);
Route::get('button/edit/{id}', 'ButtonController@getEdit')->name('button.getEdit')->middleware(['permission:button-edit']);
Route::post('button/edit', 'ButtonController@postEdit')->name('button.postEdit')->middleware(['permission:button-edit']);
Route::post('button/delete', 'ButtonController@delete')->name('button.delete')->middleware(['permission:button-delete']);