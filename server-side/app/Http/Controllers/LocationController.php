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

        $machines = Machine::select('id', 'latitude', 'longitude')->get();

        $destinations = $machines->map(function ($machine){
            return "{$machine->latitude},{$machine->longitude}";
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
        $minDistance = null;
        $closestMachineId = null;

        foreach ($distances as $index => $distance) {
            $distanceValue = $distance['distance']['value'];
            $machineDistances[] = [
                'machine_id' => $machines[$index]->id,
                'distance_text' => $distance['distance']['text'], 
                'distance_value' => $distanceValue, 
                'duration_text' => $distance['duration']['text'], 
                'duration_value' => $distance['duration']['value'], 
            ];
            if (is_null($minDistance) || $distanceValue < $minDistance) {
                $minDistance = $distanceValue;
                $closestMachineId = $machines[$index]->id;
            }
        }

        $user->machine_id = $closestMachineId;
        $user->save();

        return response()->json([
            'distances' => $machineDistances,
            'closest_machine_id' => $closestMachineId
        ], 200);
    }

    public function setDifferentMachine (Request $request){
        $user = JWTAuth::parseToken()->authenticate();

        $user->update(["machine_id" => $request->machine_id]);

        return response()->json([
            "message" => "Machine id updated successfully"
        ],200);
    }

    public function getMachines (){
        $machines = Machine::where;
        return response()->json([
            'machines' => $machines
        ]);
    }


}