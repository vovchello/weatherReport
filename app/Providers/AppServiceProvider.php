<?php

namespace App\Providers;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use App\Servises\FindCitiesService\Contract\FindCitiesServiceInterface;
use App\Servises\FindCitiesService\FindCitiesService;
use App\Servises\JsonService\Contracts\JsonSserviceInterface;
use App\Servises\JsonService\JsonService;
use App\Servises\DataBaseService\Contracts\DataBaseServiceInterface;
use App\Servises\DataBaseService\DataBaseService;
use App\Servises\ApiService\ApiService;
use App\Servises\WeatherServise\Contracts\WeatherServiseInterface;
use App\Servises\WeatherServise\CurrentWeatherService\Contracts\CurrentWeatherServiceInterface;
use App\Servises\WeatherServise\CurrentWeatherService\CurrentWeatherService;
use App\Servises\WeatherServise\WeatherService;
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
        $this->app->bind(ApiServiceInterface::class, ApiService::class);
        $this->app->bind(JsonSserviceInterface::class, JsonService::class);
        $this->app->bind(FindCitiesServiceInterface::class, FindCitiesService::class);
        $this->app->bind(DataBaseServiceInterface::class, DataBaseService::class);
        $this->app->bind(WeatherServiseInterface::class, WeatherService::class);
        $this->app->bind(CurrentWeatherServiceInterface::class, CurrentWeatherService::class);
    }
}
