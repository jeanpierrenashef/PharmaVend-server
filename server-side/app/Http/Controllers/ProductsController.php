<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inventory;
use App\Models\Machine;

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
    public function purchaseProduct(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'machine_id' => 'required|exists:machines,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
    
        // Retrieve the inventory record for the given machine and product
        $inventory = Inventory::where('machine_id', $validated['machine_id'])
                              ->where('product_id', $validated['product_id'])
                              ->first();
    
        if (!$inventory) {
            return response()->json([
                "message" => "This product doesn't exist in this machine."
            ], 404);
        }
    
        if ($inventory->quantity < $validated['quantity']) {
            return response()->json([
                "message" => "Insufficient stock"
            ], 400);
        }
    
        // Decrement the inventory quantity
        $inventory->quantity -= $validated['quantity'];
        $inventory->save();
    
        return response()->json([
            "message" => "Purchase successful",
            "remaining_quantity" => $inventory->quantity
        ], 200);
    }
    
}