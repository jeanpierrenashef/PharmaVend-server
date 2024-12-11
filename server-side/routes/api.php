<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AdminController;

use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\isAdmin;

Route::post("/register", [JWTAuthController::class, "register"]);
Route::post("/login", [JWTAuthController::class, "login"]);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::post('/set_location', [LocationController::class, 'setUserLocation']);
    Route::post('/set_machine', [LocationController::class, 'setUserMachine']);
    Route::get('/history', [ProductsController::class, 'getHistoryOfPurchase']);

    Route::prefix('machine')->group(function () {
        Route::get('/{id}', [ProductsController::class, 'getProductList']);
        Route::post('/purchase', [ProductsController::class, 'purchaseProduct']);
    });
    
    Route::prefix("admin")->middleware(isAdmin::class)->group(function (){
        Route::post("/add_machine",[AdminController::class,"addMachine"]);
        Route::post("/add_product",[AdminController::class,"addProduct"]);
        Route::post("/update_inventory", [AdminController::class, "updateInventory"]);

    });
});