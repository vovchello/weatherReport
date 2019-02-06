<?php

namespace App\Servises\WeatherServise;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use App\Servises\DataBaseService\DataBaseService;
use App\Servises\WeatherServise\Contracts\WeatherServiseInterface;

class WeatherService implements WeatherServiseInterface
{

    /**
     * @var apiServiceInterface
     */
    private $apiService;

    /**
     * @var DataBaseService
     */
    private $redisRepository;

    public function __construct(ApiServiceInterface $apiService, DataBaseService $redisRepository)
    {
        $this->apiService = $apiService;
        $this->redisRepository = $redisRepository;
    }

    private function getWeatherFromRedis($cities)
    {
        return $this->redisRepository->getCurrentWeather($cities);
    }


    /**
     * @param $id
     * @param $weather
     */
    private function saveWeather($id, $weather)
    {
        $this->redisRepository->save($id,$weather);
    }

    /**
     * @param $city
     * @return mixed
     */
    private function getweatherFromApi($city)
    {
        $weather = $this->apiService->getCurrentWeather($city);
        $this->saveWeather('c'.$city['id'],$weather);
        $this->message = 'from Api';
        return $weather;
    }

    public function getWeather($cities)
    {
        $weather = collect();
        foreach ($cities as $city){
            $weather->push($this->getWeatherFromRedis($city) ?? $this->getweatherFromApi($city));
        }
        return $weather;
    }

}
