<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductsController;

use App\Http\Middleware\JwtMiddleware;

Route::post("/register", [JWTAuthController::class, "register"]);
Route::post("/login", [JWTAuthController::class, "login"]);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::post('set_location', [LocationController::class, 'setUserLocation']);

    Route::prefix('machine')->group(function () {
        Route::get('/{id}', [ProductsController::class, 'getProductList']);
        Route::post('/purchase', [ProductsController::class, 'purchaseProduct']);
    });

    Route::get('/history', [ProductsController::class, 'getHistoryOfPurchase']);
    Route::prefix("admin")->middleware(AdminMiddleware::class)->group(function (){
        Route::post("/add_machine",[AdminController::class,"addMachine"]);

    });
});