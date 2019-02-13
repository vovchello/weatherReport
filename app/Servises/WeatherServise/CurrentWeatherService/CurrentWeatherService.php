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
    protected function makeIdForSaving($city, string $units):string
    {
        return 'current'.$units.$city->name.$city->code;
    }



    protected function getUriForRequiest(): string
    {
        return $this->config['current']['uri'];
    }

    protected function getParamsForRequiest(string $units,$city): array
    {
        $params = $this->config['params'];
        $params['query']['q'] = $city->name.','.$city->code;
        $params['query']['units'] = $units;
        return $params;
    }
}
