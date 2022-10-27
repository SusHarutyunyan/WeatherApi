<?php

namespace App\Console\Commands;

use App\Facades\City;
use Illuminate\Console\Command;

class DispatchWeatherInformationUpdateJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dispatch:weather-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch batched jobs for update cities weather information';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        City::dispatchWeatherUpdateJobs();

        return Command::SUCCESS;
    }
}
