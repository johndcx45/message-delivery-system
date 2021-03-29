<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AuthController;

Route::group(['middleware' => ['cors', 'json.response']], function() {
    Route::post('/login', [AuthController::class, 'login'])->name('login.api');
});

// Get all messages
Route::get('/messages', [MessageController::class, 'index'])->middleware(['authenticate:admin,backoffice', 'authorize:backoffice,admin']);

// Store the message
Route::post('/messages', [MessageController::class, 'store'])->middleware(['authenticate:admin,backoffice', 'authorize:backoffice,admin']);

// Retrieve an specific message by user id
Route::get('/messages/user/{id}', [MessageController::class, 'getMessagesByUserId'])->middleware(['authenticate:admin,backoffice', 'authorize:backoffice,admin']);

// Create the message
Route::put('/messages/create', [MessageController::class, 'create'])->middleware(['authenticate:admin,backoffice', 'authorize:backoffice,admin']);

// Show an specific message
Route::get('/messages/{message}', [MessageController::class, 'show'])->middleware(['authenticate:admin,backoffice', 'authorize:backoffice,admin']);

// Delete the message 
Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->middleware(['authenticate:admin,backoffice', 'authorize:backoffice,admin']);

// Get all users
Route::get('/users', [UserController::class, 'index'])->middleware('authenticate:admin', 'authorize:admin');

// Register an user
Route::post('/users', [UserController::class, 'store'])->middleware('authenticate:admin', 'authorize:admin');

// User read endpoint
Route::post('read', [MessageController::class, 'userRead'])->middleware('authenticate:admin', 'authorize:admin');