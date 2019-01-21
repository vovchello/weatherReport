<?php

namespace App\Servises\WeatherService;



use App\Servises\WeatherService\Contacts\WeatherServiceInterface;
use GuzzleHttp\Client;

/**
 * Class WeatherService
 * @package App\Servises\WeatherService
 */
class WeatherService implements WeatherServiceInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * WeatherService constructor.
     * @param $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $country
     * @param $city
     */
    public function getWeather($country, $city)
    {
        $weather = $this->getRequest($country,$city);
        $weather = $this->getFormatedWeather($weather->list);
        return $weather;
    }


    /**
     * @param $country
     * @param $city
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getRequest($country, $city)
    {
        $request = $this->client->request('get',$this->getURI(),[
            'query' =>[
                'q' => $city.','.$country,
                'appid' => $this->getAppId()
            ]
        ]);
        $request = $this->getDecodeRequest($request);
        return $request;
    }

    /**
     * @return string
     */
    private function getURI():string
    {
        return config('weatherReport.weatherservice.uri');
    }

    /**
     * @return string
     */
    private function getAppId():string
    {
        return config('weatherReport.weatherservice.appid');
    }

    /**
     * @param $request
     * @return mixed
     */
    private function getDecodeRequest($request)
    {
        return json_decode($request->getBody()->getContents());
    }


    private function getFormatedWeather($forecasts)
    {
        $collections =collect();
        foreach($forecasts as $forecast){
            $collection = collect([
                'temperature' =>$forecast->main->temp ,
                'max_temperature' => $forecast->main->temp_max,
                'min_temperature' => $forecast->main->temp_min,
                'weather' => $forecast->weather[0]->main,
                'wind_speed' => $forecast->wind->speed,
                'clouds' => $forecast->clouds->all,
                'precipitation_type' => $forecast,
                'precipitation_size' =>$forecast ,
                'data' => $forecast->dt_txt,
            ]);
            $collections->push($collection->all());
        }
        return $collections;
    }
}
