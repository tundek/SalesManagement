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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard-panel', ['as' => 'user.dashboard', 'uses' => 'backend\DashboardController@index']);

Route::get('/user-register', ['as' => 'user.register', 'uses' => 'backend\UserController@create']);
Route::post('/user-save', ['as' => 'user.store', 'uses' => 'backend\UserController@store']);

Route::get('/', ['as' => 'user.login', 'uses' => 'backend\UserController@index']);
Route::post('/admin-panel', ['as' => 'user.check', 'uses' => 'backend\UserController@login']);
Route::get('/logout', ['as' => 'user.logout', 'uses' => 'backend\UserController@logout']);

Route::get('/module-create', ['as' => 'module.create', 'uses' => 'backend\ModuleController@create']);
Route::post('/module-store', ['as' => 'module.store', 'uses' => 'backend\ModuleController@store']);
Route::get('/module-list', ['as' => 'module.list', 'uses' => 'backend\ModuleController@index']);

Route::get('/role-create', ['as' => 'role.create', 'uses' => 'backend\RoleController@create']);
Route::post('/role-store', ['as' => 'role.store', 'uses' => 'backend\RoleController@store']);
Route::get('/role-list', ['as' => 'role.list', 'uses' => 'backend\RoleController@index']);

Route::get('/permission-create', ['as' => 'permission.create', 'uses' => 'backend\PermissionController@create']);
Route::post('/permission-store', ['as' => 'permission.store', 'uses' => 'backend\PermissionController@store']);
Route::get('/permission-list', ['as' => 'permission.list', 'uses' => 'backend\PermissionController@index']);
Route::delete('/permission-delete/{id}', ['as' => 'permission.delete', 'uses' => 'backend\PermissionController@destroy']);
Route::get('/permission-edit/{id}', ['as' => 'permission.edit', 'uses' => 'backend\PermissionController@edit']);
Route::post('/permission-update/{id}', ['as' => 'permission.update', 'uses' => 'backend\PermissionController@update']);

Route::get('/permission/asign/{id}', ['as' => 'permission.asign', 'uses' => 'backend\PermissionController@asign']);
Route::post('/permission/permissionasign/{id}', ['as' => 'permission.permissionasign', 'uses' => 'backend\PermissionController@permissionasign']);


