<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inventory;
use App\Models\Machine;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class ProductsController extends Controller{ 

    public function getProductList($id){
        $inventoryRecords = Inventory::where("machine_id", $id)
                                    ->where("quantity", ">", 0)
                                    ->get();
    
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
                "message" => "Insufficient stock, Only 1 left"
            ],500);
        }

        
        $update = Inventory::where('machine_id', $request->machine_id)
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
        
        $updated = Inventory::where('machine_id', $request->machine_id)
                                ->where('product_id', $request->product_id)
                                ->first();

        return response()->json([
            "message" => "Purchase successful",
            "remaining_quantity" => ($inventory->quantity - $request->quantity),
            "product" => $updated
        ],200);
    }

    public function getHistoryOfPurchase(Request $request){
        $user = JWTAuth::parseToken()->authenticate();

        $transaction = Transaction::where("user_id", $user->id)->get();

        if($transaction->isEmpty()){
            return response()->json([   
                "message" => "no transaction for this user"
            ],400);
        }
        return response()->json([
            "transactions" => $transaction
        ]);

    }
    public function dispenseTransaction ($id) {
        $transaction = Transaction::find($id);
        //google/apiclient-services
        
        if (!$transaction) {
            return response()->json([
                "message" => "Transaction not found"
            ], 404);
        }
        $transaction->dispensed = 1;
        $transaction->save();

        $productId = $transaction->product_id;

        
        // $espResponse = Http::post('http://192.168.1.2/product_id', [
        //     'product_id' => $productId,
        // ]);

        return response()->json([
            "transaction" => $transaction
        ]);


    }

    public function getProduct($id){
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                "message" => "product not found"
            ], 404);
        }
        return response()->json([
            "product" => $product
        ]);

    }
}