<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AndroidController;

Route::get('/test', fn() => response()->json(['message' => 'API jalan!']));

// auth
Route::post('/sign-up', [AndroidController::class, 'signUp']);
Route::post('/login', [AndroidController::class, 'login']);

// get data master
Route::get('/afdeling', [AndroidController::class, 'getAfdeling']);
Route::get('/kebun', [AndroidController::class, 'getKebun']);
Route::get('/pks', [AndroidController::class, 'getPks']);

// insert data
Route::post('/insert-kebun', [AndroidController::class, 'insertKebun']);
Route::post('/insert-pks', [AndroidController::class, 'insertPks']);

//history
Route::get('/history/{user_id}', [AndroidController::class, 'getHistory']);

