<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Machine;
use Illuminate\Support\Facades\Http;

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

        $machines = Machine::select('id', 'lattitude', 'longitude')->get();

        $destinations = $machines->map(function ($machine){
            return "{$machine->lattitude},{$machine->longitude}";
        })->implode('|');

        $apiKey = "AIzaSyD3EiOtcu7hbFzjSOBIMlFbnU7pXSCq4cw";
        //$apiKey = env("GOOGLE_API_KEY");
        $URL = $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=
                        {$request->lattitude},{$request->longitude}&destinations={$destinations}&mode={$request->mode}&key={$apiKey}";

        $response = Http::get($url); 
        $data = $response->json();

        if ($data['status'] !== 'OK') {
            return response()->json(['message' => 'Error fetching distances from Google API'], 500);
        }


        $distances = $data['rows'][0]['elements'];
        $machineDistances = [];

        foreach ($distances as $index => $distance) {
            $machineDistances[] = [
                'machine_id' => $machines[$index]->id,
                'distance_text' => $distance['distance']['text'], 
                'distance_value' => $distance['distance']['value'], 
                'duration_text' => $distance['duration']['text'], 
                'duration_value' => $distance['duration']['value'], 
            ];
        }

        return response()->json([
            'distances' => $machineDistances
        ], 200);
    }

    public function setUserMachine (Request $request){
        
    }


}