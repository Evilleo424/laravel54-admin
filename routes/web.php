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

Route::get('/login','LoginController@index');
Route::post('/login','LoginController@login');
Route::get('/logout','LoginController@logout');

Route::group(['middleware' => 'permissionCheck'],function(){
    Route::get('/home','HomeController@index');
    Route::resource('users','UserController');
    Route::resource('roles','RoleController');
    Route::resource('permissions','PermissionController');
    Route::get('/roles/{role}/permission','RoleController@permission');
    Route::post('/roles/{role}/permission','RoleController@storePermission');
    Route::get('/users/{user}/role','UserController@role');
    Route::post('/users/{user}/role','UserController@storeRole');

});



