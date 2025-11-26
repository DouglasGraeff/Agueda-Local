<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

// Health check
Route::get('/health', function() { 
    return response()->json(['ok' => true]); 
});

// Auth routes (public)
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// User public routes
Route::get('/users/{user}', [UserController::class, 'show']);

// Auth routes (protected with JWT)
Route::middleware('auth:jwt')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    
    // User routes
    Route::get('/users/me', [UserController::class, 'me']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
});
