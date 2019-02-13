<?php

namespace App\Servises\CitySearchService;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use App\Servises\CashService\CashService;
use App\Servises\CashService\Contracts\CashServiceInterface;
use App\Servises\CitySearchService\Contracts\CitySearchServiceInterface;

/**
 * Class CitySearchService
 * @package App\Servises\CitySearchService
 */
class CitySearchService implements CitySearchServiceInterface
{
    /**
     * @var
     */
    private $api;

    /**
     *
     */
    private const CONFIG_FILE = 'api.city';

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    private $config;

    /**
     * @var CashService
     */
    private $cashService;

    /**
     * CitySearchService constructor.
     * @param $api
     */
    public function __construct(ApiServiceInterface $api, CashService $cashService)
    {
        $this->api = $api;
        $this->config = config(self::CONFIG_FILE);
        $this->cashService = $cashService;
    }

    /**
     * @param $cityName
     * @return array
     */
    private function getCityFromApi($cityName)
    {
        $data =  $this->parseResponse(
            json_decode($this->api->getRequest($this->getUri(),$this->getParams($cityName))),
            $cityName
        );
        $this->cashService->save($this->getCityIdForCash($cityName),json_encode($data));
        return $data;
    }

    /**
     * @param $cityName
     * @return mixed
     */
    private function getCityFromCash($cityName)
    {
        return json_decode($this->cashService->getDataById($this->getCityIdForCash($cityName)));
    }

    /**
     * @param $cityName
     * @return string
     */
    private function getCityIdForCash($cityName)
    {
        return 'city'.$cityName;
    }

    /**
     * @param $cityName
     * @return mixed
     */
    public function search(string $cityName):array
    {
        return $this->getCityFromCash($cityName) ?? $this->getCityFromApi($cityName);
    }

    /**
     * @param string $cityName
     * @return mixed
     */
    private function getParams(string $cityName)
    {
        $params = $this->config['params'];
        $params['query']['city'] = $cityName;
        return $params;
    }

    /**
     * @return mixed
     */
    private function getUri()
    {
        return $this->config['uri'];
    }

    /**
     * @param array $cityList
     * @param string $cityName
     * @return array
     */
    private function parseResponse(array $cityList, string $cityName)
    {
        foreach ($cityList as $city){
            $city->name = $cityName;
        }
        return $cityList;
    }





}
