<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::get('profile', [AuthController::class, 'profile']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
});

Route::middleware('auth:api')->group(function () {
    Route::get('/users', [UserController::class,'index']);
    Route::post('/users', [UserController::class,'store']); 
    Route::get('/users/{id}', [UserController::class,'show']);
    Route::put('/users/{id}', [UserController::class,'update']);
   Route::delete('/users/{id}', [UserController::class,'destroy']);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('roles', RoleController::class)->except(['create', 'edit']);
    Route::get('/permissions', [PermissionController::class, 'index']);
    Route::post('/permissions', [PermissionController::class, 'store']);
});