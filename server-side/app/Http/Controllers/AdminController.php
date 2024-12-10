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
        $machine->lattitude = $request->lattitude;
        $machine->longitude = $request->longitude;
        $machine->save();

        return response()->json([
            "message" => "machine added successfully",
            "machine" => $machine
        ]);
    }
}