<?php

namespace App\Http\Controllers;

use App\Servises\ApiService\ApiService;
use App\Servises\FindCitiesService\Contract\FindCitiesServiceInterface;
use App\Servises\WeatherServise\CurrentWeatherService\Contracts\CurrentWeatherServiceInterface;
use App\Validators\Request\SearchWeatherRequest;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    private $findCity;

    private $weatherServise;

    /**
     * WeatherController constructor.
     * @param $city
     */
    public function __construct(FindCitiesServiceInterface $findCity, ApiService $weatherServise)
    {
        $this->findCity = $findCity;
        $this->weatherServise = $weatherServise;
    }

    public function index(Request $request)
    {
        $cities = $this->findCity->findCity($request->city);
        foreach ($cities as $city){
            $weather[] = $this->weatherServise->getRequest($city['id'],config('weatherReport.weatherservice.current.uri'));
        }
        return $weather;
    }
}
