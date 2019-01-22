<?php

namespace App\Http\Controllers;

use App\Servises\CitiesService\Contract\CitiesServiceInterface;
use App\Validators\Request\SearchWeatherRequest;
use Illuminate\Support\Collection;

class WeatherController
{

    private $city;

    /**
     * WeatherController constructor.
     * @param $city
     */
    public function __construct(CitiesServiceInterface $city)
    {
        $this->city = $city;
    }

    public function index(SearchWeatherRequest $request)
    {
        $validated = $request->validated();
        $city = $this->city->findCity($validated['city']);
        if ($city->count() === 1){
            return redirect();
        } else{
            return redirect('');
        }
        dd($city);
    }

}
