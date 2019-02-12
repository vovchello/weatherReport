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
    public function getWeather(array $city,string $units)
    {
        $weather = collect();
        foreach ($city as $name){
            $weather->push($this->getWeatherFromCash($name, $units) ?? $this->getWeatherFromApi($name,$units));
        }
        return ['weather' => $weather, 'message' => $this->message ?? null];
    }

    protected function getUriForRequiest(): string
    {
        return $this->config->weather->current->uri;
    }

    protected function getParamsForRequiest(string $units,array $city): array
    {
        $params = $this->config->weather->params;
        $params['q'] = $city['name'].','.$city['countryCode'];
        $params['units'] = $units;
        return $params;
    }
}
