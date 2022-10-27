<?php

namespace App\Services;

use App\Http\Requests\Api\CreateCityRequest;
use App\Jobs\WeatherInfoUpdateJob;
use App\Models\City;
use Illuminate\Support\Carbon;

class CityService
{
    public function createCity(CreateCityRequest $cityRequest): bool
    {
        $validatedData = $cityRequest->validated();
        $city = new City();
        $city->name = $validatedData['name'];
        $city->latitude = $validatedData['latitude'];
        $city->longitude = $validatedData['longitude'];

        return $city->save();
    }

    public function dispatchWeatherUpdateJobs(): void
    {
        City::query()
            ->where('last_check', '<', Carbon::now()->subMinutes(2)->getTimestamp())
            ->select('id')
            ->chunk(100, function ($records) {
                /** @var City[] $records */
                foreach ($records as $record) {
                    WeatherInfoUpdateJob::dispatch($record->id)->onQueue(WeatherInfoUpdateJob::QUEUE_NAME);
                }
            });
    }

    public function updateCityLastCheck(City $city): bool
    {
        $city->last_check = Carbon::now()->getTimestamp();
        return $city->save();
    }
}
