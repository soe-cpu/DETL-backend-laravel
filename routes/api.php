<?php

use App\Http\Controllers\Api\CategoryController;
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

Route::group(["middleware" => 'auth:sanctum'], function () {

    // Category
    Route::get('categories', [CategoryController::class, 'index']);
    Route::post('categories/create', [CategoryController::class, 'create']);
    Route::post('categories/update/{id}', [CategoryController::class, 'update']);
    Route::delete('categories/delete/{id}', [CategoryController::class, 'delete']);
});
