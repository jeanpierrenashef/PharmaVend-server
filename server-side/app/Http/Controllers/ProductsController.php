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
}