<?php

namespace App\Facades;

use App\Services\OpenWeatherService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getWeatherDataByCoordinates(float $latitude, float $longitude, string $units = 'metric')
 *
 * @see OpenWeatherService
 */
class OpenWeather extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return OpenWeatherService::class;
    }
}
