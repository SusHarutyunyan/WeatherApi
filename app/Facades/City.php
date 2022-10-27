<?php

namespace App\Facades;

use App\Http\Requests\Api\CreateCityRequest;
use App\Services\CityService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void dispatchWeatherUpdateJobs()
 * @method static bool createCity(CreateCityRequest $createCityRequest)
 * @method static bool updateCityLastCheck(\App\Models\City $city)
 *
 * @see CityService
 */
class City extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CityService::class;
    }
}
