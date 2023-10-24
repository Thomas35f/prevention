<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    /**
     * Store a newly created vehicle in storage.
     *
     * @param VehicleRequest $request
     * @return JsonResponse
     */
    public function store(VehicleRequest $request)
    {
        $userId = User::factory()->create()->getAttribute('id');

        $vehicle = new Vehicle();
        $vehicle->name = $request->name;
        $vehicle->brand = $request->brand;
        $vehicle->license_plate = $request->license_plate;
        $vehicle->type = $request->type;
        $vehicle->learner_id = $userId;
        $vehicle->save();

        return response()->json([
            'message' => "Le véhicule " . $vehicle->name . " a été créé avec succès.",
            'vehicle' => $vehicle
        ], 201);
    }
}
