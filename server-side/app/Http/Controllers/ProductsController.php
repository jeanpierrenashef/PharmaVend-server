<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inventory;
use App\Models\Machine;
use App\Models\Transaction;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class ProductsController extends Controller{

    public function getProductList($id){
        $inventoryRecords = Inventory::where("machine_id", $id)->get();

        $productIds = $inventoryRecords->pluck('product_id');
        $products = Product::whereIn('id', $productIds)->get();

        return response()->json([
            'machine_id' => $id,
            'products' => $products,
            'inventory' => $inventoryRecords
        ], 200);
    }
    public function purchaseProduct(Request $request){
        $inventory = Inventory::where('machine_id', $request->machine_id)
                                ->where('product_id', $request->product_id)
                                ->first();
        if(!$inventory){
            return response()->json([
                "message" => "This product doesnt exist in this table"
            ],404);
        }
        if($inventory->quantity < $request->quantity){
            return response()->json([
                "message" => "Insufficient stock"
            ],500);
        }

        
        $updated = Inventory::where('machine_id', $request->machine_id)
                        ->where('product_id', $request->product_id)
                        ->update([
                            'quantity' => $inventory->quantity - $request->quantity
                        ]);

        $user = JWTAuth::parseToken()->authenticate();
        $product = Product::find($request->product_id);
        $price = $product->price;

        $transaction = new Transaction;
        $transaction->quantity = $request->quantity;
        $transaction->total_price = ($request->quantity * $price);
        $transaction->user_id = $user->id;
        $transaction->machine_id = $request->machine_id;
        $transaction->product_id = $request->product_id;
        $transaction->save();
        
        return response()->json([
            "message" => "Purchase successful",
            "remaining_quantity" => ($inventory->quantity - $request->quantity)
        ],200);
    }
}