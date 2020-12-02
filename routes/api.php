<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup', 'UserController@register')->name('signup');
Route::post('/login', 'UserController@login')->name('login');
Route::get('/user', 'UserController@getCurrentUser')->name('user');
Route::post('/update', 'UserController@update')->name('user.update');
Route::get('/logout', 'UserController@logout')->name('logout');


Route::get('/task/create', 'UserController@logout')->name('task.create');
Route::get('/tasks', 'UserController@logout')->name('task.view');


