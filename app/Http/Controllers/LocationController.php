<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Machine;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LocationController extends Controller{

    public function getMachines (){
        $machines = Machine::all();
        return response()->json([
            'machines' => $machines
        ]);
    }


}