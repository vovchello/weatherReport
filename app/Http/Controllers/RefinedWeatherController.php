<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 06.02.19
 * Time: 10:23
 */

namespace App\Http\Controllers;

use App\Servises\FindCitiesService\Contract\FindCitiesServiceInterface;
use App\Servises\WeatherServise\Contracts\WeatherServiseInterface;

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
        $weatherList = $this->weatherService->getWeatherForecast($city);
        return view('base.refinedReport',[
            'weatherList' => $weatherList['weather'],
            'message' => $weatherList['message']
        ]);
    }
}
