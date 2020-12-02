<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\AuthController;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:api']], function() {
	Route::get('/todos', [TodoController::class, 'index']);
	Route::post('/todos', [TodoController::class, 'store']);
	Route::get('/todos/{id}', [TodoController::class, 'show']);
	Route::put('/todos/{id}', [TodoController::class, 'update']);
	Route::delete('/todos/{id}', [TodoController::class, 'destroy']);
	Route::put('todos/complete/{id}', [TodoController::class, 'markAsComplete']);
});