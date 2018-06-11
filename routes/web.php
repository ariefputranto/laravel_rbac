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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('menu', 'MenuController');
Route::resource('permission', 'PermissionController');
Route::resource('role', 'RoleController');
Route::resource('assignment', 'AssignmentController');
Route::resource('user', 'UserController');
Route::get('/transaction', 'TransactionController@index')->name('transaction.index');
Route::get('/transaction/create', 'TransactionController@create')->name('transaction.create');
Route::get('/transaction/dashboard', 'TransactionController@dashboard')->name('transaction.dashboard');
Route::post('/transaction', 'TransactionController@store')->name('transaction.store');
Route::get('/transaction/{transaction}', 'TransactionController@show')->name('transaction.show');
Route::delete('/transaction/{transaction}', 'TransactionController@destroy')->name('transaction.destroy');
