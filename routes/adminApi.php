<?php

use Illuminate\Support\Facades\Route;

// controllers
use App\Http\Controllers\AdminApi\BrandController;
use App\Http\Controllers\AdminApi\AuthController;



Route::prefix("admin")->group(function () {

    Route::controller(AuthController::class)->prefix("auth")->group(function () {
        Route::post("login", "login");
        Route::post("create-admin", "createAdmin");
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::controller(BrandController::class)->prefix("brands")->group(function () {
            Route::get("/", "get");
            Route::post("create-brand", "store");
            Route::delete("destroy-brand", "delete");
            Route::get("edit-brand", "edit");
            Route::put("update-brand", "update");
        });
    });

});



