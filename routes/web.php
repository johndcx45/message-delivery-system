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
    return redirect('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/homepage', function () {
    return view('homepage');
})->middleware('auth:api');

Route::get('/backoffice', function () {
    return view('homepage');
})->middleware('auth:api');

Route::get('/regular', function () {
    return view('homepage');
})->middleware('auth:api');