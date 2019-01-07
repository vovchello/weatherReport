<?php

namespace App\Providers;

use App\Repositories\WetherReportRepository\Contact\WeatherReportRepositoryInterface;
use App\Repositories\WetherReportRepository\WeatherReportRepository;
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
    }
}
