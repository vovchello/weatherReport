<?php

namespace App\Http\Controllers;

use App\Servises\CitySearchService\CitySearchService;
use App\Servises\CitySearchService\Contracts\CitySearchServiceInterface;
use App\Servises\WeatherServise\CurrentWeatherService\Contracts\CurrentWeatherServiceInterface;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    private $citySearchService;

    private $weatherService;

    /**
     * WeatherController constructor.
     * @param CitySearchServiceInterface $citySearchService
     * @param CurrentWeatherServiceInterface $weatherServise
     */
    public function __construct(CitySearchService $citySearchService,CurrentWeatherServiceInterface $weatherService)
    {
        $this->citySearchService = $citySearchService;
        $this->weatherService = $weatherService;
    }

    public function currentWeather(Request $request)
    {
        $cities = $this->citySearchService->search($request->city);
//        dd($cities);
        $weather = $this->weatherService->getWeather($cities,'metric');
        return $weather;
    }
}
