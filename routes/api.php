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

Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('me', [App\Http\Controllers\Api\AuthController::class, 'me']); 
    Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::get('user', [App\Http\Controllers\Api\UserController::class, 'index']);
Route::get('user/{id}', [App\Http\Controllers\Api\UserController::class, 'show']);
Route::post('user/{id}', [App\Http\Controllers\Api\UserController::class, 'update']);
Route::delete('user/{id}', [App\Http\Controllers\Api\UserController::class, 'destroy']);

Route::get('post', [App\Http\Controllers\Api\PostController::class, 'index']);
Route::get('post/{url}', [App\Http\Controllers\Api\PostController::class, 'show']);
Route::post('post', [App\Http\Controllers\Api\PostController::class, 'store']);
Route::post('post/{url}', [App\Http\Controllers\Api\PostController::class, 'update']);
Route::delete('post/{url}', [App\Http\Controllers\Api\PostController::class, 'destroy']);

Route::get('category', [App\Http\Controllers\Api\CategoryController::class, 'index']);
Route::get('category/{id}', [App\Http\Controllers\Api\CategoryController::class, 'show']);
Route::post('category', [App\Http\Controllers\Api\CategoryController::class, 'store']);
Route::post('category/{id}', [App\Http\Controllers\Api\CategoryController::class, 'update']);
Route::delete('category/{id}', [App\Http\Controllers\Api\CategoryController::class, 'destroy']);
Route::get('category/search/{key}', [App\Http\Controllers\Api\CategoryController::class, 'search']);
