<?php

namespace App\Providers;

use App\Repositories\WetherReportRepository\Contact\WeatherReportRepositoryInterface;
use App\Repositories\WetherReportRepository\WeatherReportRepository;
use App\Servises\CitiesService\CitiesService;
use App\Servises\CitiesService\Contract\CitiesServiceInterface;
use App\Servises\JsonService\Contracts\JsonSserviceInterface;
use App\Servises\JsonService\JsonService;
use App\Servises\WeatherService\Contacts\WeatherServiceInterface;
use App\Servises\WeatherService\WeatherService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WeatherReportRepositoryInterface::class, WeatherReportRepository::class);
        $this->app->bind(WeatherServiceInterface::class, WeatherService::class);
        $this->app->bind(JsonSserviceInterface::class, JsonService::class);
        $this->app->bind(CitiesServiceInterface::class, CitiesService::class);
    }
}
