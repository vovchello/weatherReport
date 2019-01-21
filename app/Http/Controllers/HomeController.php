<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class HomeController extends Controller
{
    private $guzzle;

    /**
     * HomeController constructor.
     * @param $guzzle
     */
    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }


    public function index()
    {
<<<<<<< Updated upstream
        $requiest = $this->guzzle->request('get','api.openweathermap.org/data/2.5/forecast',[
            'query' =>[
                'q' => 'Ottawa, ca',
                'appid' => '02c10ef435d6119a32450932ac127016'
            ]
        ]);
        $data = json_decode($requiest->getBody()->getContents());
        dd($data->list);
=======
        $data = $this->weatherService->getWeather('ca', 'Ottawa');
        dd($data);
>>>>>>> Stashed changes
    }
}
