<?php
/**
 * Created by PhpStorm.
 * User: panda
 * Date: 08.01.19
 * Time: 13:30
 */

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


}
