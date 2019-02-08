<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 06.02.19
 * Time: 9:26
 */

namespace App\Servises\WeatherServise\WeatherForecastService\Contracts;


interface WeatherServiseInterface
{
    public function getCurrentWeather($cities);

    public function getWeatherForecast($id);
}
