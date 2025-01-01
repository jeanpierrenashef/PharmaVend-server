<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller{
    public function addMachine(Request $request){
        $machine = new Machine;
        $machine->location = $request->location;
        $machine->latitude = $request->latitude;
        $machine->longitude = $request->longitude;
        $machine->status = $request->status;
        $machine->save();

        return response()->json([
            "message" => "machine added successfully",
            "machine" => $machine
        ]);
    }

    public function addProduct(Request $request){
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->image_url = $request->image_url;

        $product->save();
        return response()->json([
            "message" => "product added successfully",
            "product" => $product
        ]);
    }
    public function updateInventory(Request $request){

    $inventory = Inventory::where('machine_id', $request->machine_id)
                            ->where('product_id', $request->product_id)
                            ->first();

    if ($inventory) {
        
        Inventory::where('machine_id', $request->machine_id)
                    ->where('product_id', $request->product_id)
                    ->update([
                        'quantity' => $inventory->quantity + $request->add_quantity,
                ]);
    } else {

        Inventory::create([
            'machine_id' => $request->machine_id,
            'product_id' => $request->product_id,
            'quantity' => $request->add_quantity,
        ]);
    }

    
    $updatedInventory = Inventory::where('machine_id', $request->machine_id)
                                ->where('product_id', $request->product_id)
                                ->first();

    return response()->json([
        "message" => "Inventory updated successfully.",
        "inventory" => $updatedInventory,
    ], 200);
}
    public function getUsers(){
        $users = User::all();
        return response()->json(
            $users
        );
    }

    public function deleteUser(){
        $user = User::find($id);

        if($user){
            $user -> delete();
            return response()->json([
                'message' => "successful"
            ],200);
        }else{
            return response()->json([
                'message' => "not found"
            ],404);
        }
    }

    public function getTransactions(){
        $transactions = Transaction::all();
        return response()->json(
            $transactions
        );
    }

    public function getProducts(){
        $products = Product::all();
        return response()->json(
            $products
        );
    }

    public function getMachines(){
        $machines = Machine::all();
        return response()->json(
            $machines
        );
    }

    public function deleteMachine($id){
        $machine = Machine::find($id);

        if($machine){
            $machine -> delete();
            return response()->json([
                'message' => "successful"
            ],200);
        }else{
            return response()->json([
                'message' => "not found"
            ],404);
        }
    }

    public function updateMachine(Request $request, $id){
        $machine = Machine::find($id);
        if (!$machine){
            return response()->json([
                "message" => "error no machine"
            ]);
        }
        $machine->location = $request->location;
        $machine->latitude = $request->latitude;
        $machine->longitude = $request->longitude;
        $machine->status = $request->status;

        $machine->update();
        return response()->json([
            'message' => 'successful',
            'data' => $machine]);
    }


}