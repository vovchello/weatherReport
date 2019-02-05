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
    public function getWeather($city)
    {
        return $this->getWeatherByCity($city['country'],$city['name']);
    }

    private function getWeatherByCity($country,$city)
    {
        $weather = $this->getRequest($country,$city);
        $weather = $this->parseResponse($weather);
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
        return json_decode($request->getBody()->getContents(),true);
    }

    private function parseCity($city)
    {
        return collect([
            'name' => $city['name'],
            'country' => $city['country'],
            'lat' => $city['coord']['lat'],
            'lon' => $city['coord']['lon']
        ]);
    }

    private function parseResponse($data)
    {
        return collect(['city' => $this->parseCity($data['city']),'weather' => $data['list']]);
    }

}
