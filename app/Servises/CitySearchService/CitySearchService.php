<?php

use App\Servises\ApiService\Contacts\ApiServiceInterface;

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
     * @return mixed|void
     */
    public function search(string $cityName)
    {
        return json_decode($this->api->getRequest($this->getUri(),$this->getParams($cityName)));
    }

    private function getParams(string $cityName)
    {
        $params = $this->config->params;
        $params['q'] = $cityName;
        return $params;
    }

    private function getUri()
    {
        return $this->config->uri;
    }




}
