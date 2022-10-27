<?php

namespace App\Http\Controllers\Api;

use App\Facades\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateCityRequest;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    public function createCity(CreateCityRequest $createCityRequest): JsonResponse
    {
        return response()->json([
            'success' => City::createCity($createCityRequest)
        ]);
    }
}
