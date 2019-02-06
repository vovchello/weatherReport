<?php

namespace App\Providers;

use App\Repositories\WetherReportRepository\Contact\WeatherReportRepositoryInterface;
use App\Repositories\WetherReportRepository\WeatherReportRepository;
use App\Servises\ApiService\Contacts\ApiServiceInterface;
use App\Servises\FindCitiesService\Contract\FindCitiesServiceInterface;
use App\Servises\FindCitiesService\FindCitiesService;
use App\Servises\JsonService\Contracts\JsonSserviceInterface;
use App\Servises\JsonService\JsonService;
use App\Servises\RedisRepository\Contracts\RedisRepositoryInterface;
use App\Servises\RedisRepository\RedisRepository;
use App\Servises\ApiService\ApiService;
use App\Servises\WeatherServise\Contracts\WeatherServiseInterface;
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
        $this->app->bind(WeatherReportRepositoryInterface::class, WeatherReportRepository::class);
        $this->app->bind(ApiServiceInterface::class, ApiService::class);
        $this->app->bind(JsonSserviceInterface::class, JsonService::class);
        $this->app->bind(FindCitiesServiceInterface::class, FindCitiesService::class);
        $this->app->bind(RedisRepositoryInterface::class, RedisRepository::class);
        $this->app->bind(WeatherServiseInterface::class, WeatherService::class);
    }
}
