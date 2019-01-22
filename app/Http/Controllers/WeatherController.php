<?php

namespace App\Http\Controllers;

use App\Servises\CitiesService\Contract\CitiesServiceInterface;
use App\Servises\WeatherService\Contacts\WeatherServiceInterface;
use App\Validators\Request\SearchWeatherRequest;
use Illuminate\Support\Collection;

class WeatherController
{

    private $city;

    private $weatherService;

    /**
     * WeatherController constructor.
     * @param $city
     */
    public function __construct(CitiesServiceInterface $city, WeatherServiceInterface $weatherService)
    {
        $this->city = $city;
        $this->weatherService = $weatherService;
    }

    public function index(SearchWeatherRequest $request)
    {
        $validated = $request->validated();
        $cities = $this->city->findCity($validated['city']);
        $cityWeather = collect();
        foreach($cities as $city) {
            $weather = $this->weatherService->getWeather($city['country'],$city['name']);
            $cityWeather->push($weather);
        }
        return view('base.city',[
            'cities' => $cityWeather
        ]);
    }
}