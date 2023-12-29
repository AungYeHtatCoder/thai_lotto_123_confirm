<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//publish routes
Route::get('/login', [AuthController::class, 'loginData']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

//protected routes
Route::group(["middleware" => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    
    //profile management
    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::post('/profile', [ProfileController::class, 'updateProfile']);


    
    
});