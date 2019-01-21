<?php

namespace App\Http\Controllers;

use App\Servises\WeatherService\Contacts\WeatherServiceInterface;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @var WeatherServiceInterface
     */
    private $weatherService;

    /**
     * HomeController constructor.
     * @param $guzzle
     */
    public function __construct(WeatherServiceInterface $weatherService)
    {
        $this->weatherService = $weatherService;
    }


    /**
     *
     */
    public function index()
    {
        $data = $this->weatherService->getWeather('ca', 'Ottawa');
        dd(config('weatherReport.city.list.json'));
        return view('base.home');
    }
}
