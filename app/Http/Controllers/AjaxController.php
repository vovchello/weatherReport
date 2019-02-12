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
    public function __construct(CitySearchService $citySearchService)
    {
        $this->citySearchService = $citySearchService;
//        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        $cities = $this->citySearchService->search($request->city);
        dd($cities);
    }
}
