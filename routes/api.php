<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;
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

Route::post('/sanctum/token', TokenController::class);

Route::middleware(['auth:sanctum', 'apply_locale'])->group(function () {

    /**
     * Auth related
     */
    Route::get('/users/auth', AuthController::class);

    /**
     * Users
     */
    Route::put('/users/{user}/avatar', [UserController::class, 'updateAvatar']);
    Route::resource('users', UserController::class);

    /**
     * Product categories
     */
    Route::resource('categories', CategoryController::class);

    /**
     * Roles
     */
    Route::get('/roles/search', [RoleController::class, 'search'])->middleware('throttle:400,1');
});
