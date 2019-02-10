<?php

namespace App\Servises\WeatherServise\WeatherForecastService;

use App\Servises\WeatherServise\WeatherForecastService\Contracts\WeatherServiseInterface;

/**
 * Class WeatherService
 * @package App\Servises\WeatherServise
 */
class WeatherService extends \App\Servises\WeatherServise\WeatherService implements WeatherServiseInterface
{

    protected function makeIdForDataBase(string $cityId, string $units):string
    {
        return $units.$cityId;
    }

    /**
     * @param $cities
     * @return array
     */
    public function getWeather($city)
    {
        return [
            'weather' => collect ($this->getWeatherFromRedis($city['id']) ?? $this->getWeatherFromApi($city,'forecast')),
            'message' => $this->message ?? null
        ];
    }



}
