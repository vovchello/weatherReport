<?php

namespace App\Servises\WeatherServise\WeatherForecastService;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use App\Servises\DataBaseService\DataBaseService;
use App\Servises\WeatherServise\WeatherForecastService\Contracts\WeatherServiseInterface;

/**
 * Class WeatherService
 * @package App\Servises\WeatherServise
 */
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

    private $message;

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
     * This gets weather from redis
     *
     * @param $cities
     * @return mixed|null
     */
    private function getWeatherFromRedis($id)
    {
        $this->message = 'Information from DB';
        return $this->redisRepository->getWeatherForecast($id);
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
    private function getCurrentWeatherFromApi($city)
    {
        $weather = $this->apiService->getCurrentWeather($city);
        $this->saveWeather('c'.$city['id'],$weather);
        unset($this->message);
        return $weather;
    }

    /**
     * @param $city
     * @return mixed
     */
    private function getWeatherFromApi($city)
    {
        $weather = $this->apiService->getWeatherForecast($city);
        $this->saveWeather($city['id'],$weather);
        unset($this->message);
        return $weather;
    }

    /**
     * @param $cities
     * @return array
     */
    public function getCurrentWeather($cities)
    {
        $weather = collect();
        foreach ($cities as $city){
            $weather->push($this->getCurentWeatherFromRedis($city['id']) ?? $this->getCurrentWeatherFromApi($city));
        }
        return ['weather' => $weather, 'message' => $this->message ?? null];
    }

    /**
     * @param $city
     * @return array
     */
    public function getWeatherForecast($city)
    {
        return [
            'weather' => collect ($this->getWeatherFromRedis($city) ?? $this->getWeatherFromApi($city)),
            'message' => $this->message ?? null
        ];
    }

}
