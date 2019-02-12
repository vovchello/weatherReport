<?php

namespace App\Http\Controllers;

use App\Servises\FindCitiesService\Contract\FindCitiesServiceInterface;
use App\Servises\WeatherServise\CurrentWeatherService\Contracts\CurrentWeatherServiceInterface;
use App\Validators\Request\SearchWeatherRequest;

/**
 * Class WeatherController
 * @package App\Http\Controllers
 */
class WeatherController
{

    /**
     * @var FindCitiesServiceInterface
     */
    private $findCity;

    private $weatherServise;

    /**
     * WeatherController constructor.
     * @param $city
     */
    public function __construct(FindCitiesServiceInterface $findCity, CurrentWeatherServiceInterface $weatherServise)
    {
        $this->findCity = $findCity;
        $this->weatherServise = $weatherServise;
    }

    /**
     * @param SearchWeatherRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(SearchWeatherRequest $request)
    {
        $validated = $request->validated();
        $cities = $this->findCity->findCity($validated['city']);
        $cityWeather = $this->weatherServise->getWeather($cities);
        return view('base.weather',[
            'weatherList' => $cityWeather['weather'],
            'message' => $cityWeather['message']
        ]);
    }
}
