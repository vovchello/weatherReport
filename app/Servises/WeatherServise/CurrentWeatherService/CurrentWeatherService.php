<?php

namespace App\Servises\WeatherServise\CurrentWeatherService;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use App\Servises\DataBaseService\DataBaseService;
use App\Servises\WeatherServise\CurrentWeatherService\Contracts\CurrentWeatherServiceInterface;

/**
 * Created by PhpStorm.
 * User: panda
 * Date: 07.02.19
 * Time: 21:10
 */

class CurrentWeatherService implements CurrentWeatherServiceInterface
{
    /**
     * @var apiServiceInterface
     */
    private $apiService;

    /**
     * @var DataBaseService
     */
    private $redisRepository;

    /**
     * @var
     */
    private $message;

    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    private $config;

    /**
     *
     */
    private const CONFIG_FILE_PATH = 'weatherReport.weatherservice';

    /**
     * WeatherService constructor.
     * @param ApiServiceInterface $apiService
     * @param DataBaseService $redisRepository
     */
    public function __construct(ApiServiceInterface $apiService, DataBaseService $redisRepository)
    {
        $this->apiService = $apiService;
        $this->redisRepository = $redisRepository;
        $this->config = config(self::CONFIG_FILE_PATH);
    }

    /**
     * This gets Current weather from redis
     *
     * @param $cities
     * @return mixed|null
     */
    private function getCurentWeatherFromRedis($id)
    {
        $this->message = 'Information from DB';
        return $this->redisRepository->getWeatherForecast($this->makeIdForDataBase($id,'m'));
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
        $this->saveWeather($this->makeIdForDataBase($city['id'],'m'),$weather);
        unset($this->message);
        return $weather;
    }

    /**
     * Generates ID for current weather using units
     *
     * @param string $cityId
     * @param string $units
     * @return string
     */
    private function makeIdForDataBase(string $cityId, string $units):string
    {
        return 'current'.$units.$cityId;
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
}
