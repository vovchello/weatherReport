<?php

namespace App\Servises\WeatherServise\WeatherForecastService;

use App\Servises\WeatherServise\WeatherForecastService\Contracts\WeatherServiseInterface;
use App\Servises\WeatherServise\WeatherService;

/**
 * Class WeatherForecastService
 * @package App\Servises\WeatherServise
 */
class WeatherForecastService extends WeatherService implements WeatherServiseInterface
{

    /**
     * @param string $cityName
     * @param string $units
     * @return string
     */
    protected function makeIdForSaving($city, string $units):string
    {
        return $units.$city->name.$city->code;
    }

    protected function getUriForRequiest(): string
    {
        return $this->config['forecast']['uri'];
    }

    protected function getParamsForRequiest(string $units, $city): array
    {
        $params = $this->config['params'];
        $params['query']['q'] = $city->name.','.$city->code;
        $params['query']['units'] = $units;
        return $params;
    }


}
