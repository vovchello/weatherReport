<?php

namespace App\Providers;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use App\Servises\FindCitiesService\Contract\FindCitiesServiceInterface;
use App\Servises\FindCitiesService\FindCitiesService;
use App\Servises\JsonService\Contracts\JsonSserviceInterface;
use App\Servises\JsonService\JsonService;
use App\Servises\DataBaseService\Contracts\CashServiceInterface;
use App\Servises\DataBaseService\CashService;
use App\Servises\ApiService\ApiService;
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
//        $this->app->bind(CashServiceInterface::class, CashService::class);
//        $this->app->bind(WeatherServiseInterface::class, WeatherForecastService::class);
//        $this->app->bind(CurrentWeatherServiceInterface::class, CurrentWeatherService::class);
    }
}
