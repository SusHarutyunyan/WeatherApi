<?php

namespace App\Http\Controllers\Api;

use App\Facades\WeatherInformation;
use App\Http\Controllers\Controller;
use App\Http\Resources\WeatherInformationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherInformationController extends Controller
{
    public function getWeatherInformation(Request $request): JsonResponse
    {
        $weatherInfo = WeatherInformation::searchWeatherInformationWithCity($request);

        return response()->json(WeatherInformationResource::collection($weatherInfo));
    }
}
