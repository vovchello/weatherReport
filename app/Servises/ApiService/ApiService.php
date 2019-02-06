<?php

namespace App\Servises\ApiService;

use App\Servises\ApiService\Contacts\ApiServiceInterface;
use GuzzleHttp\Client;

/**
 * Class ApiService
 * @package App\Servises\ApiService
 */
class ApiService implements ApiServiceInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ApiService constructor.
     * @param $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $city
     * @return \Illuminate\Support\Collection|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWeatherForecast($city)
    {
        return  $this->parseResponse($this->getWeatherByCity($city,$this->getUriForWeatherForecast()));
    }

    /**
     * @param $city
     * @return \Illuminate\Support\Collection|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCurrentWeather($city)
    {
        return $this->parseCurrentWeatherResponse($this->getWeatherByCity($city,$this->getUriForCurrentWeather()));
    }

    /**
     * @param $city
     * @param $url
     * @return \Illuminate\Support\Collection|mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getWeatherByCity($city, $url)
    {
        return $this->getRequest($city, $url);
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    private function getUriForWeatherForecast()
    {
        return config('weatherReport.weatherservice.forecast.uri');
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    private function getUriForCurrentWeather()
    {
        return config('weatherReport.weatherservice.current.uri');
    }

    private function getUnits()
    {
        return config('weatherReport.weatherservice.units');
    }

    /**
     * @param $country
     * @param $city
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getRequest($city, $url)
    {
        $request = $this->client->request('get',$url,[
            'query' =>[
//                'q' => $city['name'].','.$city['country'],
                'id' => $city['id'],
                'units' => $this->getUnits(),
                'appid' => $this->getAppId()
            ]
        ]);
        return $this->getDecodeRequest($request);
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

    /**
     * @param $city
     * @return \Illuminate\Support\Collection
     */
    private function parseCity($city)
    {
        return collect([
            'name' => $city['name'],
            'country' => $city['country'],
            'lat' => $city['coord']['lat'],
            'lon' => $city['coord']['lon']
        ]);
    }

    /**
     * @param $data
     * @return array
     */
    private function parseCityForCurrentWeather($data)
    {
        return [
            'id' => $data['id'],
            'name' => $data['name'],
            'coord' => $data['coord'],
            'country' => $data['sys']['country']
        ];
    }

    /**
     * @param $data
     * @return \Illuminate\Support\Collection
     */
    private function parseCurrentWeatherResponse($data)
    {
        return collect(['city' => $this->parseCityForCurrentWeather($data),'weather' => $data]);
    }

    /**
     * @param $data
     * @return \Illuminate\Support\Collection
     */
    private function parseResponse($data)
    {
        return collect(['city' => $this->parseCity($data['name']),'weather' => $data['list']]);
    }

}
