<?php

namespace App\Jobs;

use App\Facades\WeatherInformation;
use App\Models\City;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WeatherInfoUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public const QUEUE_NAME = 'WeatherInfoUpdate';

    /**
     * The city id.
     */
    public int $cityId;

    public function __construct(int $cityId)
    {
        $this->cityId = $cityId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $city = City::query()->find($this->cityId);
        WeatherInformation::saveWeatherInformation($city);
    }
}
