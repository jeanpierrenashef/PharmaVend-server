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
Route::get('/map', [LocationController::class , 'getMachines']);
Route::get('/{id}', [ProductsController::class, 'getProductList']);
Route::post('/history', [ProductsController::class, 'getHistoryOfPurchase']);
Route::post('/purchase', [ProductsController::class, 'purchaseProduct']);
Route::put('/dispense/{id}', [ProductsController::class, 'dispenseTransaction']);
Route::get("/product/{id}", [ProductsController::class, 'getProduct']);
Route::prefix("admin")->group(function (){
    Route::post("/add_machine",[AdminController::class,"addMachine"]);
    Route::post("/add_product",[AdminController::class,"addProduct"]);
    Route::post("/update_inventory", [AdminController::class, "updateInventory"]);
    Route::get("/users", [AdminController::class, "getUsers"]);
});

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::post('/set_location', [LocationController::class, 'setUserLocation']);
    Route::post('/set_machine', [LocationController::class, 'setDifferentMachine']);
    
    

    Route::prefix('machine')->group(function () {
        
        
    });
    

});