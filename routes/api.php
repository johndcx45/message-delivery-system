<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AuthController;


Route::post('/login', [AuthController::class, 'login'])->name('login.api');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.api');

// Authenticaded routes
Route::group(['middleware' => ['authenticate']], function() {


    #region Messages
        Route::get('/message', [MessageController::class, 'index'])->middleware(['authorize:admin,backoffice,regular']);
        Route::post('/message', [MessageController::class, 'store'])->middleware(['authorize:backoffice,admin']);
        Route::get('/message/user/{id}', [MessageController::class, 'getMessagesByUserId'])->middleware(['authorize:backoffice,admin']);
        Route::put('/message/{message}', [MessageController::class, 'update'])->middleware(['authorize:backoffice,admin']);
        Route::delete('/message/{message}', [MessageController::class, 'destroy'])->middleware(['authorize:backoffice,admin']);
        Route::get('/message/{message}', [MessageController::class, 'show'])->middleware(['authorize:backoffice,admin,regular']);
        Route::get('/viewedby', [MessageController::class, 'getUsersWhoReadTheMessage'])->middleware('authorize:admin,backoffice,regular');
        Route::post('read', [MessageController::class, 'userRead'])->middleware('authorize:admin,backoffice,regular');
    #endregion

    #region Users
        Route::get('/user', [UserController::class, 'index'])->middleware('authorize:admin');
        Route::post('/user', [UserController::class, 'store'])->middleware('authorize:admin');
        Route::get('/userid', [UserController::class, 'getUserId']);
    #endregion
});
