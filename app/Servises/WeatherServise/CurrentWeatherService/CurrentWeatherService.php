<?php

namespace App\Servises\WeatherServise\CurrentWeatherService;

use App\Servises\WeatherServise\CurrentWeatherService\Contracts\CurrentWeatherServiceInterface;
use App\Servises\WeatherServise\WeatherService;

/**
 * Created by PhpStorm.
 * User: panda
 * Date: 07.02.19
 * Time: 21:10
 */

class CurrentWeatherService extends WeatherService implements CurrentWeatherServiceInterface
{
    /**
     * Generates ID for current weather using units
     *
     * @param string $cityId
     * @param string $units
     * @return string
     */
    protected function makeIdForDataBase(string $cityId, string $units):string
    {
        return 'current'.$units.$cityId;
    }

    /**
     * @param $cities
     * @return array
     */
    public function getWeather($cities)
    {
        $weather = collect();
        foreach ($cities as $city){
            $weather->push($this->getWeatherFromRedis($city['id']) ?? $this->getWeatherFromApi($city,'current'));
        }
        return ['weather' => $weather, 'message' => $this->message ?? null];
    }
}
