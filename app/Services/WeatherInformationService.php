<?php

namespace App\Services;

use App\Facades\OpenWeather;
use App\Models\City;
use App\Models\WeatherInformation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class WeatherInformationService
{
    public function saveWeatherInformation(City $city): bool
    {
        $weatherData = OpenWeather::getWeatherDataByCoordinates($city->latitude, $city->longitude);
        if ($weatherData['success']) {
            $weatherData = $weatherData['result'];

            $exists = WeatherInformation::query()
                ->where('city_id', $city)
                ->where('time', $weatherData['dt'])
                ->exists();
            if ($exists) {
                return true;
            }
            $weatherInformation = new WeatherInformation();
            $weatherInformation->time = $weatherData['dt'];
            $weatherInformation->min = $weatherData['main']['temp_min'];
            $weatherInformation->max = $weatherData['main']['temp_max'];
            $weatherInformation->temperature = $weatherData['main']['temp'];
            $weatherInformation->pressure = $weatherData['main']['pressure'];
            $weatherInformation->humidity = $weatherData['main']['humidity'];
            $weatherInformation->city_id = $city->id;

            return $weatherInformation->save() && \App\Facades\City::updateCityLastCheck($city);
        }

        return false;
    }

    public function searchWeatherInformationWithCity(Request $request): Collection
    {
        $query = WeatherInformation::query()
            ->with('city')
            ->orderBy('id', 'DESC');

        if ($request->has('cityName') && !empty($request->get('cityName'))) {
            $query->whereHas('city', function ($relationQuery) use ($request) {
               $relationQuery->where('name', $request->get('cityName'));
            });
        }

        return $query->get();
    }
}
