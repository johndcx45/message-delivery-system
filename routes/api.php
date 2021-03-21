<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'login']);

Route::resource('user', UserController::class)->middleware('auth:api');

Route::resource('message', MessageController::class)->middleware('auth:api');

Route::get('/message/{id}', [MessageController::class, 'getMessageById']);

Route::post('read', [MessageController::class, 'userRead']);
/* 
Route::get('authuser', [UserController::class, 'getAuthenticatedUser'])->middleware('auth:api');;

Route::get('bearertoken', [UserController::class, 'getBearerToken']); 
*/