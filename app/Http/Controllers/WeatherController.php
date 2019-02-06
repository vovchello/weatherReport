<?php

namespace App\Http\Controllers;

use App\Servises\FindCitiesService\Contract\FindCitiesServiceInterface;
use App\Servises\WeatherServise\Contracts\WeatherServiseInterface;
use App\Validators\Request\SearchWeatherRequest;

/**
 * Class WeatherController
 * @package App\Http\Controllers
 */
class WeatherController
{
    private $message;

    /**
     * @var FindCitiesServiceInterface
     */
    private $findCity;

    /**
     * WeatherController constructor.
     * @param $city
     */
    public function __construct(FindCitiesServiceInterface $findCity, WeatherServiseInterface $weatherServise)
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
        $cityWeather = $this->weatherServise->getCurrentWeather($cities);
        return view('base.weather',[
            'weatherList' => $cityWeather['weather'],
            'message' => $cityWeather['message']
        ]);
    }
}
