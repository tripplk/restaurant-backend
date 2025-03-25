<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


//Public Routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () {
    //Auth Routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Route::apiResource('users', UserController::class);
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);

    Route::post('location', [LocationController::class, 'createLocation']);
    Route::get('location', [LocationController::class, 'getLocations']);
    Route::get('location/{id}', [LocationController::class, 'getLocation']);
    Route::put('location/{id}', [LocationController::class, 'updateLocation']);
    Route::delete('location/{id}', [LocationController::class, 'deleteLocation']);

    Route::post('restaurant', [RestaurantController::class, 'createRestaurant']);
    Route::get('restaurant', [RestaurantController::class, 'getRestaurants']);
    Route::get('restaurant/{id}', [LocationController::class, 'getrestaurants']);
    Route::put('restaurant/{id}', [LocationController::class, 'updaterestaurants']);
    Route::delete('restaurant/{id}', [LocationController::class, 'deleterestaurants']);
 

    
    Route::post('role',  [rolecontroller::class, 'createRole']);
    Route::get('role', [RoleController::class, 'index']);
    Route::get('restaurant/{id}', [RoleController::class, 'getroles']);
    Route::Put('updateRole',  [RoleController::class,'updaterole']);

});
