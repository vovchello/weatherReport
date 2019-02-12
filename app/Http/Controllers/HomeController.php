<?php

namespace App\Http\Controllers;

use App\Servises\FindCitiesService\FindCitiesService;
use App\Servises\JsonService\Contracts\JsonSserviceInterface;
use App\Servises\ApiService\Contacts\WeatherServiceInterface;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('base.home');
    }
}
