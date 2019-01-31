<?php

namespace App\Http\Controllers;

use App\Servises\CitiesService\Contract\CitiesServiceInterface;
use App\Servises\RedisRepository\RedisRepository;
use App\Servises\WeatherService\Contacts\WeatherServiceInterface;
use App\Validators\Request\SearchWeatherRequest;

class WeatherController
{

    private $city;

    private $weatherService;

    private $redisRepository;

    /**
     * WeatherController constructor.
     * @param $city
     */
    public function __construct(CitiesServiceInterface $city, WeatherServiceInterface $weatherService, RedisRepository $redisRepository)
    {
        $this->city = $city;
        $this->weatherService = $weatherService;
        $this->redisRepository = $redisRepository;
    }

    private function getWeatherFromRedis($cities)
    {
     return $this->redisRepository->getWeather($cities);
    }

    private function getCities($name)
    {
        return $this->city->findCity($name);
    }



    public function index(SearchWeatherRequest $request)
    {
        $validated = $request->validated();
        $cities = $this->getCities($validated['city']);
        if ($cities->count > 1){
            return view('base.city',[
                'cities' => $cities,
            ]);
        }
        $cityWeather = $this->getWeatherFromRedis($cities) ?? null;
        if (is_null($cityWeather)){
            $cityWeather = $this->weatherService->getWeather($cities);
            $this->redisRepository->addWeather($cities->id,$cityWeather);
        }
        return view('base.city',[
            'cities' => $cityWeather,
        ]);
    }
}
