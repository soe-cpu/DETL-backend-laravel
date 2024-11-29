<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'Auth', 'prefix' => 'auth/'], function () {
    Route::post('sign-up', [ApiAuthController::class, 'signUp']);   
    Route::post('sign-in', [ApiAuthController::class, 'signIn']);
});

