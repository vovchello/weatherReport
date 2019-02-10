<?php

namespace App\Servises\WeatherServise\CurrentWeatherService\Contracts;

interface CurrentWeatherServiceInterface
{
    public function getWeather($city);
}
