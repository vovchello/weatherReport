<?php

namespace App\Servises\WeatherServise;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use App\Servises\DataBaseService\DataBaseService;

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
     * @var DataBaseService
     */
    protected $redisRepository;

    /**
     * @var
     */
    protected $message;

    /**
     * WeatherService constructor.
     * @param ApiServiceInterface $apiService
     * @param DataBaseService $redisRepository
     */
    public function __construct(ApiServiceInterface $apiService, DataBaseService $redisRepository)
    {
        $this->apiService = $apiService;
        $this->redisRepository = $redisRepository;
    }


    /**
     * @param $id
     * @param $weather
     */
    protected function saveWeather($id, $weather)
    {
        $this->redisRepository->save($id,$weather);
    }

    abstract protected function makeIdForDataBase(string $cityId, string $units):string;

    protected function getWeatherFromApi($city,$weatherMethod)
    {
        $weather = $this->apiService->getWeather($city,$weatherMethod);
        $this->saveWeather($this->makeIdForDataBase($city['id'],'m'),$weather);
        unset($this->message);
        return $weather;
    }

    protected function getWeatherFromRedis($id)
    {
        $this->message = 'Information from DB';
        return $this->redisRepository->getWeatherForecast($this->makeIdForDataBase($id,'m'));
    }

    /**
     * @param $city
     * @return array
     */
    abstract public function getWeather($city);
}
