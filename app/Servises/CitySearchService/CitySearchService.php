<?php

namespace App\Servises\CitySearchService;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use App\Servises\CitySearchService\Contracts\CitySearchServiceInterface;

class CitySearchService implements CitySearchServiceInterface
{
    /**
     * @var
     */
    private $api;

    private const CONFIG_FILE = 'api.city';

    private $config;

    /**
     * CitySearchService constructor.
     * @param $api
     */
    public function __construct(ApiServiceInterface $api)
    {
        $this->api = $api;
        $this->config = config(self::CONFIG_FILE);
    }

    /**
     * @param $cityName
     * @return mixed
     */
    public function search(string $cityName):array
    {
        return $this->parseResponse(
            json_decode($this->api->getRequest(
                $this->getUri(),$this->getParams($cityName))
            ),
            $cityName
        );
    }

    private function getParams(string $cityName)
    {
        $params = $this->config['params'];
        $params['query']['city'] = $cityName;
        return $params;
    }

    private function getUri()
    {
        return $this->config['uri'];
    }

    private function parseResponse(array $cityList, string $cityName)
    {
        foreach ($cityList as $city){
            $city->name = $cityName;
        }
        return $cityList;
    }





}
