<?php

// use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;


Route::resource('categories', CategoryController::class);

// Api routes for authentication
Route::prefix("auth")->group(function () {
    Route::post("login", [AuthController::class, "login"]);
    Route::post("register", [AuthController::class, "register"]);
    Route::post("refresh", [AuthController::class, "refresh"]);
    Route::get("me", [AuthController::class, "me"]);
});