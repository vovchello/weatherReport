<?php

namespace App\Providers;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use App\Servises\ApiService\ApiService;
use App\Servises\WeatherServise\CurrentWeatherService\Contracts\CurrentWeatherServiceInterface;
use App\Servises\WeatherServise\CurrentWeatherService\CurrentWeatherService;
use App\Servises\WeatherServise\WeatherForecastService\Contracts\WeatherServiseInterface;
use App\Servises\WeatherServise\WeatherForecastService\WeatherForecastService;
use CitySearchService;
use CitySearchServiceInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
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
        $this->app->bind(CitySearchServiceInterface::class, CitySearchService::class);
        $this->app->bind(WeatherServiseInterface::class, WeatherForecastService::class);
        $this->app->bind(CurrentWeatherServiceInterface::class, CurrentWeatherService::class);
    }
}
