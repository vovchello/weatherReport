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



    public function index(SearchWeatherRequest $request)
    {
        $validated = $request->validated();
        $cities = $this->city->findCity($validated['city']);
        $cityWeather = $this->redisRepository->getWeather($cities);
        $state = 'from Redis';
        if($cityWeather === null){
            $cityWeather = $this->weatherService->getWeather($cities);
            $this->redisRepository->addWeather($cityWeather);
            $state = 'from api';
        }
        dd($state);
        return view('base.city',[
            'cities' => $cityWeather,
            'state' => $state
        ]);
    }
}
