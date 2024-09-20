<?php

use App\Http\Controllers\Api\Drivecontroller;
use App\Http\Controllers\authApi\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





Route::post("register", [AuthController::class,"register"]);

Route::post("login", [AuthController::class,"login"]);



Route::middleware("auth:sanctum")->group(function(){




    Route::get("drives", [Drivecontroller::class,"index"]);
    Route::post("drives", [Drivecontroller::class,"store"]);
    Route::post("drives/{id}", [Drivecontroller::class,"update"]);
    Route::delete("drives/{id}", [Drivecontroller::class,"destroy"]);


    Route::get("logout", [AuthController::class,"logout"]);

});





