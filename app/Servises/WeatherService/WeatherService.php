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
        return json_decode($request->getBody()->getContents());
    }

    private function parseCity($city)
    {
        return collect([
            'name' => $city->name,
            'country' => $city->country,
            'lat' => $city->coord->lat,
            'lon' => $city->coord->lon
        ]);
    }

    private function parseResponse($data)
    {
        $result['city'] =collect($this->parseCity($data->city));
        $result['weather'] = $this->parseWeather($data->list);
        $result = collect($result);
        dd($result);
        return $result;
    }

    private function parseWeather($data)
    {
        foreach($data as $item){
            $weather['temperature'] = $item->main->temp;
            $weather['max_temperature'] = $item->main->temp_max;
            $weather['min_temperature'] = $item->main->temp_min;
            $weather['weather'] = $item->weather[0]->main;
            $weather['wind_speed'] = isset($item->wind->speed) ? $item->wind->speed : null;
            $weather['wind_deg'] = isset($item->wind->deg) ? $item->wind->deg : null;
            $weather['clouds'] =  isset($item->clouds->all) ? $item->clouds->all : null;
            $weather['snow'] = isset($item->snow) ? $item->snow : null;
            $weather['rain'] = isset($item->rain) ? $item->rain : null;
            $weather['data'] = $item->dt_txt;
            $result[]= collect($weather);
        }
        return $result;
    }


}
