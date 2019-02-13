<?php

namespace App\Servises\WeatherServise\CurrentWeatherService\Contracts;

/**
 * Interface CurrentWeatherServiceInterface
 * @package App\Servises\WeatherServise\CurrentWeatherService\Contracts
 */
interface CurrentWeatherServiceInterface
{
    /**
     * @param array $city
     * @param string $units
     * @return mixed
     */
    public function getWeather(array $city, string $units);
}
