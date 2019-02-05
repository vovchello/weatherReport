<?php

namespace App\Http\Controllers;

use App\Servises\CitiesService\Contract\CitiesServiceInterface;
use App\Servises\RedisRepository\RedisRepository;
use App\Servises\WeatherService\Contacts\WeatherServiceInterface;
use App\Validators\Request\SearchWeatherRequest;

/**
 * Class WeatherController
 * @package App\Http\Controllers
 */
class WeatherController
{
    private $message;

    /**
     * @var CitiesServiceInterface
     */
    private $city;

    /**
     * @var WeatherServiceInterface
     */
    private $weatherService;

    /**
     * @var RedisRepository
     */
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

    /**
     * @param $cities
     * @return mixed|null
     */
    private function getWeatherFromRedis($cities)
    {
        return $this->redisRepository->getCurrentWeather($cities);
    }

    /**
     * @param $name
     * @return mixed
     */
    private function getCities($name)
    {
        return $this->city->findCity($name);
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
        $weather = $this->weatherService->getCurrentWeather($city);
        $this->saveWeather('c'.$city['id'],$weather);
        $this->message = 'from Api';
        return $weather;
    }

    /**
     * @param $cities
     * @return \Illuminate\Support\Collection
     */
    private function getWeather($cities)
    {
        $weather = collect();
        foreach ($cities as $city){
            $weather->push($this->getWeatherFromRedis($city) ?? $this->getweatherFromApi($city));
        }
        return $weather;

    }


    /**
     * @param SearchWeatherRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(SearchWeatherRequest $request)
    {
        $validated = $request->validated();
        $cities = $this->getCities($validated['city']);
        $cityWeather = $this->getWeather($cities);
        dd($cityWeather);
        return view('base.weather',[
            'weatherList' => $cityWeather,
            'message' => $this->message
        ]);
    }
}
