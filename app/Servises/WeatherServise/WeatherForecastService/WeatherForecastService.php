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
    protected function makeIdForSaving(array $city, string $units):string
    {
        return $units.$city['name'].$city['countryCode'];
    }

    /**
     * @param $cities
     * @return array
     */
    public function getWeather(array $city, string $units)
    {
        return $this->getWeatherFromCash($city,$units) ??
               $this->getWeatherFromApi($city,$units);
    }

    protected function getUriForRequiest(): string
    {
        return $this->config->weather->forecast->uri;
    }

    protected function getParamsForRequiest(string $units,array $cityName): array
    {
        $params = $this->config->weather->params;
        $params['q'] = $cityName.','.$countryCode;
        $params['units'] = $units;
        return $params;
    }


}
