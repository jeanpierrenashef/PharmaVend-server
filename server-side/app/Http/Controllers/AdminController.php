<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
// use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

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

    $title = 'Inventory Updated';
    $body = "{$request->add_quantity} units of {$request->product_id} were added to machine {$request->machine_id}.";

    // Send notification
    $this->sendNotification($title, $body);

    return response()->json([
        "message" => "Inventory updated successfully.",
        "inventory" => $updatedInventory,
    ], 200);
}

private function sendNotification($title, $body){

    $serviceAccountPath = storage_path('app/json/file.json');


    $factory = (new Factory)->withServiceAccount($serviceAccountPath);
    $messaging = $factory->createMessaging();
    $fcmToken = 'eu5yG-k8SDqzRka1fSGYpw:APA91bEuYM64y1GnUx_Uip6U1ld9ToA-bNaUDWB8L8VFK277qnkiio49z20rFrguApm8iJj_Bl6ZK_aNqVnAEItv7giw_NW0Cwde1eM_Txvp4-xRH7cn4Bo';


    $notification = Notification::create($title, $body);

    $message = CloudMessage::withTarget('token', $fcmToken)
        ->withNotification($notification);


    $messaging->send($message);
}


    public function getUsers(){
        $users = User::all();
        return response()->json(
            $users
        );
    }

    public function deleteUser($id){
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
    public function updateProduct(Request $request, $id){
        $product = Product::find($id);
        if (!$product){
            return response()->json([
                "message" => "error no product"
            ]);
        }
        $product->name = $request->name;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image_url = $request->image_url;

        $product->update();
        return response()->json([
            'message' => 'successful',
            'data' => $product]);
    }
    public function deleteProduct($id){
        $product = Product::find($id);

        if($product){
            $product -> delete();
            return response()->json([
                'message' => "successful"
            ],200);
        }else{
            return response()->json([
                'message' => "not found"
            ],404);
        }
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

    public function getInventory(){
        $inventory = Inventory::all();
        return response()->json(
            $inventory
        );
    }
    public function toggleMachineStatus($id) {
        $machine = Machine::findOrFail($id);
        $machine->status = $machine->status === 'active' ? 'inactive' : 'active';
        $machine->save();
    
        return response()->json(
            $machine);
    }
    
    // public function updateOrInsertInventory(Request $request){
    //     {
    //         $inventory = new Inventory;
        
    //         $inventory = Inventory::updateOrCreate([
    //                 'machine_id' => $request->machine_id,
    //                 'product_id' => $request->product_id,
    //             ],[
    //                 'quantity' => DB::raw("GREATEST(quantity + {$request->quantity}, 0)")
    //             ]
    //         );
    //         $inventory->save();
    //         return response()->json([
    //             "inventory" => $inventory,
    //         ]);
    //     }
    // }

    

}