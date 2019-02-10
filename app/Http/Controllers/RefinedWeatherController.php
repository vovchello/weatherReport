<?php

namespace App\Http\Controllers;

use App\Servises\FindCitiesService\Contract\FindCitiesServiceInterface;
use App\Servises\WeatherServise\WeatherForecastService\Contracts\WeatherServiseInterface;

/**
 * Class RefinedWeatherController
 * @package App\Http\Controllers
 */
class RefinedWeatherController
{
    /**
     * @var WeatherServiseInterface
     */
    private $weatherService;

    /**
     * @var FindCitiesServiceInterface
     */
    private $findCity;

    /**
     * RefinedWeatherController constructor.
     * @param $weatherService
     */
    public function __construct(WeatherServiseInterface $weatherService,FindCitiesServiceInterface $findCity)
    {
        $this->weatherService = $weatherService;
        $this->findCity = $findCity;
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $city = $this->findCity->getCityById($id);
        $weatherList = $this->weatherService->getWeather($city);
//        dd($weatherList);
        return view('base.refinedReport',[
            'weatherList' => $weatherList['weather'],
            'message' => $weatherList['message']
        ]);
    }
}
