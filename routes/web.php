<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::post('home-save','App\Http\Controllers\HomeController@addStudent' )->name('save');
Route::post('home-delete','App\Http\Controllers\HomeController@deleteStudent')->name('delete');
Route::post('home-project-save','App\Http\Controllers\HomeController@addNewProjets' )->name('saveProject');
Route::post('home-project-add-student','App\Http\Controllers\HomeController@addStudentToGroup' )->name('addStudent');

