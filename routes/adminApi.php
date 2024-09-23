<?php

use Illuminate\Support\Facades\Route;

// controllers
use App\Http\Controllers\AdminApi\AuthController;
use App\Http\Controllers\AdminApi\BrandController;
use App\Http\Controllers\AdminApi\CategoryController;
use App\Http\Controllers\AdminApi\ProductController;



Route::prefix("admin")->group(function () {

    Route::controller(AuthController::class)->prefix("auth")->group(function () {
        Route::post("login", "login");
        Route::post("create-admin", "createAdmin");
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::controller(BrandController::class)->prefix("brands")->group(function () {
            Route::get("/", "get");
            Route::post("create-brand", "store");
            Route::delete("delete-brand", "delete");
            Route::get("edit-brand", "edit");
            Route::post("update-brand", "update");
        });

        Route::controller(CategoryController::class)->prefix("category")->group(function () {
            Route::get("/", "get");
            Route::post("create-category", "store");
        });

        Route::controller(ProductController::class)->prefix("products")->group(function () {
            Route::post("create-product", "store");
        });
    });

});



