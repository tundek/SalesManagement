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
Route::get('/module-edit/{id}', ['as' => 'module.edit', 'uses' => 'backend\ModuleController@edit']);
Route::post('/module-update/{id}', ['as' => 'module.update', 'uses' => 'backend\ModuleController@update']);

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


Route::get('/productcategory-create',['as'=>'productcategory.create', 'uses'=>'backend\ProductcategoryController@create']);
Route::get('/productcategory-list',['as'=>'productcategory.list', 'uses'=>'backend\ProductcategoryController@index']);
Route::post('/productcategory-save',['as'=>'productcategory.store', 'uses'=>'backend\ProductcategoryController@store']);
Route::delete('/productcategory-delete/{id}', ['as' => 'productcategory.delete', 'uses' => 'backend\ProductcategoryController@destroy']);
Route::get('/productcategory-edit/{id}/edit', ['as' => 'productcategory.edit', 'uses' => 'backend\ProductcategoryController@edit']);
Route::post('/productcategory-update/{id}', ['as' => 'productcategory.update', 'uses' => 'backend\ProductcategoryController@update']);


Route::get('/product-create',['as'=>'product.create', 'uses'=>'backend\ProductController@create']);
Route::get('/product-list',['as'=>'product.list', 'uses'=>'backend\ProductController@index']);
Route::post('/product-save',['as'=>'product.store', 'uses'=>'backend\ProductController@store']);
Route::delete('/product-delete/{id}', ['as' => 'product.delete', 'uses' => 'backend\ProductController@destroy']);
Route::get('/product-edit/{id}/edit', ['as' => 'product.edit', 'uses' => 'backend\ProductController@edit']);
Route::post('/product-update/{id}', ['as' => 'product.update', 'uses' => 'backend\ProductController@update']);

Route::get('/product-sales',['as'=>'sales.create', 'uses'=>'backend\SalesController@create']);
Route::post('/sales-store',['as'=>'sales.store', 'uses'=>'backend\SalesController@store']);
Route::get('/sales-list',['as'=>'sales.list', 'uses'=>'backend\SalesController@index']);
Route::get('/sales-pdf/{id}',['as'=>'sales.print', 'uses'=>'backend\SalesController@getpdf']);
Route::get('/sales-allpdf',['as'=>'sales.printall', 'uses'=>'backend\SalesController@getallpdf']);

Route::post('/getproduct',['as'=>'sales.getproduct', 'uses'=>'backend\SalesController@getproduct']);
Route::post('/getquantity',['as'=>'sales.getquantity', 'uses'=>'backend\SalesController@getquantity']);
Route::post('/getprice',['as'=>'sales.getprice', 'uses'=>'backend\SalesController@getprice']);
Route::post('/gettotalprice',['as'=>'sales.gettotalprice', 'uses'=>'backend\SalesController@gettotalprice']);
Route::post('/getproductname',['as'=>'sales.getproductname', 'uses'=>'backend\SalesController@getproductname']);