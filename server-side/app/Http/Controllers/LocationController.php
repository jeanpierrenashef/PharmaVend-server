<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LocationController extends Controller{

    public function setUserLocation(Request $request){

        $user = JWTAuth::parseToken()->authenticate();
        if(!$user){
            return response()->json([
                "error" => "No user"
            ],400);
        }
        $user->lattitude = $request->lattitude;
        $user->longitude = $request->longitude;
        $user->save();

        return response()->json([
            "user" => $user
        ],200);
    }
}