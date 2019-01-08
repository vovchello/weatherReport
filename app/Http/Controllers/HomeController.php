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
//        $requiest = $this->guzzle->request('get','api.openweathermap.org/data/2.5/forecast',[
//            'query' =>[
//                'q' => 'Ottawa, ca',
//                'appid' => '02c10ef435d6119a32450932ac127016'
//            ]
//        ]);
//        $data = json_decode($requiest->getBody()->getContents());
//        dd($data->list);
    }
}
