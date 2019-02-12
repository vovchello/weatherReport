<?php

namespace App\Servises\WeatherServise;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use App\Servises\CashService\CashService;


/**
 * Created by PhpStorm.
 * User: panda
 * Date: 09.02.19
 * Time: 0:39
 */

abstract class WeatherService
{

    /**
     * @var apiServiceInterface
     */
    protected $apiService;

    /**
     * @var CashService
     */
    protected $cashService;

    /**
     *
     */
    protected const CONFIG_FILE = 'api';

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    protected $config;

    /**
     * @var
     */
    protected $message;

    /**
     * WeatherForecastService constructor.
     * @param ApiServiceInterface $apiService
     * @param CashService $redisRepository
     */
    public function __construct(ApiServiceInterface $apiService, CashService $cashService)
    {
        $this->apiService = $apiService;
        $this->cashService = $cashService;
        $this->config = config(self::CONFIG_FILE);
    }

    /**
     * @param $id
     * @param $weather
     */
    protected function saveWeather(string $id, $weather)
    {
        $this->cashService->save($id,$weather);
    }

    /**
     * @param string $cityId
     * @param string $units
     * @return string
     */
    abstract protected function makeIdForSaving(array $city, string $units):string;

    /**
     * @param string $name
     * @param string $units
     * @return mixed
     */
    protected function getWeatherFromApi(array $city, string $units)
    {
        $weather = $this->apiService
                        ->getRequest($this->getUriForRequiest(), $this->getParamsForRequiest($units, $city));
        $this->saveWeather($this->makeIdForSaving($city,$units),$weather);
        unset($this->message);
        return $weather;
    }

    /**
     * @param string $cityName
     * @param string $units
     * @return mixed|null
     */
    protected function getWeatherFromCash(array $city, string $units)
    {
        return $this->cashService->getDataById($this->makeIdForSaving($city,$units));
    }

    /**
     * @param string $cityName
     * @param string $countryCode
     * @param string $units
     * @return array
     */
    abstract public function getWeather(array $city, string $units);

    /**
     * @return string
     */
    abstract protected function getUriForRequiest():string;

    /**
     * @param string $units
     * @return array
     */
    abstract protected function getParamsForRequiest(string $units,array $city):array;

}
