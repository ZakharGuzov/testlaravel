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

Route::get('/', 'Grid@home');

Route::get('/department', 'Department@show');
Route::get('/department/add', 'Department@add');
Route::get('/department/edit/{id}', 'Department@edit');
Route::get('/department/delete/{id}', 'Department@delete');
Route::post('/department/store', 'Department@store');
Route::post('/department/update/{id}', 'Department@update');

Route::get('/employee', 'Employee@show');
Route::get('/employee/add', 'Employee@add');
Route::get('/employee/delete/{id}', 'Employee@delete');
Route::get('/employee/edit/{id}', 'Employee@edit');
Route::post('/employee/store', 'Employee@store');
Route::post('/employee/update/{id}', 'Employee@update');
