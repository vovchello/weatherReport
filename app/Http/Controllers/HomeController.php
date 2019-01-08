<?php

namespace App\Http\Controllers;

use App\Servises\WeatherService\WeatherService;


class HomeController extends Controller
{
    private $request;

    /**
     * HomeController constructor.
     * @param $guzzle
     */
    public function __construct(WeatherService $request)
    {
        $this->request = $request;
    }


    public function index()
    {

        $this->request->getWeather('ca','Ottawa');
}
