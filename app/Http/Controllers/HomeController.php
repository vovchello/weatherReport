<?php

namespace App\Http\Controllers;

use App\Servises\JsonService\Contracts\JsonSserviceInterface;
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

    private $jsonSservice;

    /**
     * HomeController constructor.
     * @param $guzzle
     */
    public function __construct(WeatherServiceInterface $weatherService, JsonSserviceInterface $jsonSservice)
    {
        $this->weatherService = $weatherService;
        $this->jsonSservice = $jsonSservice;
    }


    /**
     *
     */
    public function index()
    {
        return view('base.home');
    }
}
