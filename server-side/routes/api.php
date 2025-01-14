<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AdminController;

use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\IsAdmin;

Route::post("/register", [JWTAuthController::class, "register"]);
Route::post("/login", [JWTAuthController::class, "login"]);
Route::post("/check_user", [JWTAuthController::class, "checkUser"]);
Route::post("/register_google", [JWTAuthController::class, "registerGoogleUser"]);
Route::get("/display_machines", [AdminController::class, "getMachines"]);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/map', [LocationController::class , 'getMachines']);
    Route::get('/{id}', [ProductsController::class, 'getProductList']);
    Route::post('/history', [ProductsController::class, 'getHistoryOfPurchase']);
    Route::post('/purchase', [ProductsController::class, 'purchaseProduct']);
    Route::put('/dispense/{id}', [ProductsController::class, 'dispenseTransaction']);
    Route::get("/product/{id}", [ProductsController::class, 'getProduct']);
    // Route::post('/set_location', [LocationController::class, 'setUserLocation']);
    // Route::post('/set_machine', [LocationController::class, 'setDifferentMachine']);

    Route::prefix("admin")->middleware([IsAdmin::class])->group(function (){
        //Route::prefix("admin")->group(function (){
        Route::post("/add_product",[AdminController::class,"addProduct"]);
        Route::get("/products", [AdminController::class, "getProducts"]);
        Route::delete("/products/{id}", [AdminController::class, "deleteProduct"]);
        Route::put('/products/{id}', [AdminController::class, 'updateProduct']);
    
        Route::get("/inventory", [AdminController::class, "getInventory"]);
        Route::post("/update_inventory", [AdminController::class, "updateInventory"]);
    
        Route::get("/users", [AdminController::class, "getUsers"]); 
        Route::delete("/users/{id}", [AdminController::class, "deleteUser"]);
    
        Route::get("/transactions", [AdminController::class, "getTransactions"]);
    
        Route::post("/add_machine",[AdminController::class,"addMachine"]);
        Route::get("/machines", [AdminController::class, "getMachines"]);
        Route::delete("/machines/{id}", [AdminController::class, "deleteMachine"]);
        Route::put('/machines/{id}', [AdminController::class, 'updateMachine']);
    
        
        Route::post("/machines/toggle_status/{id}", [AdminController::class, "toggleMachineStatus"]);
    
        });
    

    Route::prefix('machine')->group(function () {
        
        
    });
    

});