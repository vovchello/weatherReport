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
use Illuminate\Support\Collection;

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
        $weather = $this->parseWeather($weather);
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

    private function parseWeather($data):Collection
    {
        $dataArray = $data->list;
        $city = $data->city->name;
        $weatherCollection = collect();
        foreach($dataArray as $item){
            $weather['temperature'] = $item->main->temp;
            $weather['max_temperature'] = $item->main->temp_max;
            $weather['min_temperature'] = $item->main->temp_min;
            $weather['weather'] = $item->weather[0]->main;
            $weather['wind_speed'] = $item->wind->speed;
            $weather['clouds'] = $item->clouds->all;
            $weather['snow'] = $item->snow;
            $weather['data'] = $item->dt_txt;
            $weather['city'] = $city;
            $weatherCollection->push($weather);
        }
        return $weatherCollection;
    }


}
